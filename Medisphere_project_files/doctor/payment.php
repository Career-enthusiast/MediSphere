<?php
session_start(); // Start session to access session variables

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Database connection
$host = 'localhost';
$dbname = 'medisphere';
$username = 'root';
$password = '';
$port = 3307;

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to proceed with the payment.";
    exit();
}

  // Get the user_id from session
  $user_id = $_SESSION['user_id'];

  // Prepare SQL query using PDO
  $sql = "SELECT email FROM Users WHERE user_id = :user_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind user_id to the prepared statement

  // Execute the statement
  $stmt->execute();

  // Fetch the result
  if ($stmt->rowCount() > 0) {
      // Fetch the user's email
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      $user_email = $user['email'];
     
  } else {
      echo "User not found!";
  }

// Debugging: Check if total amount is set
if (isset($_SESSION['total_amount'])) {
    $total_amount = $_SESSION['total_amount'];
} else {
    echo "Total amount not found. Please return to your cart.";
    exit();  // Exit script if total amount is not found
}

// Handle form submission when the "CONFIRM" button is clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_payment'])) {
    $order_date = date('Y-m-d'); // Get the current date
    $payment_type = $_POST['payment_type'] ?? null;
    $card_number = $_POST['card_number'] ?? null;

    // Insert order details into user_orders table
    $insertOrderQuery = "INSERT INTO user_orders (user_id, total_amount, order_date) VALUES (:user_id, :total_amount, :order_date)";
    $stmt = $conn->prepare($insertOrderQuery);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':total_amount', $total_amount);
    $stmt->bindParam(':order_date', $order_date);

    if ($stmt->execute()) {
        $order_id = $conn->lastInsertId(); // Get the order_id of the inserted order
    
        // Fetch the cart items for the user
        $cartQuery = "SELECT c.medication_id, c.quantity, m.price 
                      FROM cart c
                      JOIN Medications m ON c.medication_id = m.medication_id
                      WHERE c.cart_id = :cart_id";
        $cartStmt = $conn->prepare($cartQuery);
        $cartStmt->bindParam(':cart_id', $user_id);
        $cartStmt->execute();
        $cart_items = $cartStmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Insert each cart item into the order_details table
        $insertOrderDetailsQuery = "INSERT INTO order_details (order_id, medication_id, quantity, price) 
                                    VALUES (:order_id, :medication_id, :quantity, :price)";
        $orderDetailsStmt = $conn->prepare($insertOrderDetailsQuery);
    
        foreach ($cart_items as $item) {
            $total_price = $item['quantity'] * $item['price']; // Calculate the price (quantity * price)
    
            // Insert into order_details table
            $orderDetailsStmt->bindParam(':order_id', $order_id);
            $orderDetailsStmt->bindParam(':medication_id', $item['medication_id']);
            $orderDetailsStmt->bindParam(':quantity', $item['quantity']);
            $orderDetailsStmt->bindParam(':price', $total_price);
    
            $orderDetailsStmt->execute(); // Insert the order details
        }
    
        // Insert the payment method into the payment_methods table
        $insertPaymentQuery = "INSERT INTO payment_methods (order_id, payment_type, card_number) 
        VALUES (:order_id, :payment_type, :card_number)";
        $paymentStmt = $conn->prepare($insertPaymentQuery);
        $paymentStmt->bindParam(':order_id', $order_id); // Use order_id instead of user_id
        $paymentStmt->bindParam(':payment_type', $payment_type);
        $paymentStmt->bindParam(':card_number', $card_number);
        $paymentStmt->execute();
    
       // Send order confirmation email using PHPMailer
    //    $user_email = $_SESSION['email']; // Assuming user email is stored in session
       $refill_date = date('Y-m-d', strtotime($order_date . ' + 30 days')); // Example refill date logic

       // Create PHPMailer instance
       $mail = new PHPMailer(true);
       try {
           // Server settings
           $mail->isSMTP();
           $mail->Host = 'smtp.gmail.com';
           $mail->SMTPAuth = true;
           $mail->Username = 'fameventremainder@gmail.com'; // Your Gmail email
           $mail->Password = 'sdwa meeo clmp gcpl'; // Your Gmail app password
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
           $mail->Port = 587;

           // Recipients
           $mail->setFrom('fameventremainder@gmail.com', 'Medisphere');
           $mail->addAddress($user_email,'Poojitha'); // Send to user email
           $mail->addReplyTo('fameventremainder@gmail.com', 'Medisphere');
           
           // Content
           $mail->isHTML(true);
           $mail->Subject = "Order Confirmation - Order #$order_id";
           $mail->Body = "Dear Customer,<br><br>Thank you for placing your order on $order_date.<br>Your next refill date is scheduled for $refill_date.<br><br>Regards,<br>Medisphere";
           $mail->AltBody = "Dear Customer,\n\nThank you for placing your order on $order_date.\nYour next refill date is scheduled for $refill_date.\n\n<b>Regards,\nMedisphere</b>";

           // Send the email
           $mail->send();
           echo "Order confirmation email sent!";
       } catch (Exception $e) {
           echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
       }
   
       // Redirect to the success page
       header("Location: payment_successful.php");
       exit();
   } else {
       echo "Failed to process the order. Please try again.";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Address Form</title>
    <link rel="stylesheet" href="payment.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="POST" action="">
            <div class="address-container">
                <h1>1. Delivery Address</h1>
                <label for="address">Enter your address:</label>
                <textarea id="address" rows="6" placeholder="Type your full address here..."></textarea>
                <button class="use-address-button">Use this address</button>
            </div>

            <div class="payment-container">
                <h1>2. Payment method</h1>
                <div class="payment-option">
                    <input type="radio" id="credit-card" name="payment" value="credit_card" checked>
                    <label for="credit-card">Credit or debit card</label>
                    <div class="card-icons">
                        <img src="visa.png" alt="Visa">
                        <img src="master_card.jpg" alt="MasterCard">
                        <img src="amex.png" alt="Amex">
                        <img src="maestro.png" alt="Maestro">
                    </div>
                    <input type="text" id="card-number" placeholder="Enter your card number">
                </div>
                <div class="payment-option">
                    <input type="radio" id="cash" name="payment" value="cash">
                    <label for="cash">Cash on Delivery/Pay on Delivery</label>
                    <p>Scan and pay at delivery with our Medisphere and win rewards up to Rs.100.</p>
                </div>
                <button type="button" class="use-payment-button">Use this payment method</button>
                <p id="payment-message" style="color: green;"></p>
            </div>

            <input type="hidden" name="payment_type" id="payment-type">
            <input type="hidden" name="card_number" id="hidden-card-number">

            <button type="submit" name="confirm_payment" class="confirm-button">CONFIRM</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('.use-payment-button').click(function () {
                const paymentType = $('input[name="payment"]:checked').val();
                const cardNumber = paymentType === 'credit_card' ? $('#card-number').val() : null;

                // Update hidden inputs
                $('#payment-type').val(paymentType);
                $('#hidden-card-number').val(cardNumber);

                $('#payment-message').text('Saved payment method successfully!');
            });
        });
    </script>
</body>
</html>
