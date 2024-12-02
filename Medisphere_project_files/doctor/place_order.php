<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MediSphere";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch order details (Replace with actual form data)
$user_id = $_POST['user_id'];
$total_amount = $_POST['total_amount'];
$order_date = date('Y-m-d');
$refill_date = date('Y-m-d', strtotime('+30 days'));

// Debug the $refill_date
echo "Refill Date: " . $refill_date . "<br>";

// Insert order into database
$sql = "INSERT INTO user_orders (user_id, total_amount, order_date, refill_date, refill_reminder_sent)
        VALUES ('$user_id', '$total_amount', '$order_date', '$refill_date', 1)"; // Set refill_reminder_sent = 1 explicitly

if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
    $order_id = $conn->insert_id; // Get the generated order ID

    // Send the order confirmation email
    sendOrderEmail($user_id, $order_id, $order_date, $refill_date);

    // Send the refill reminder email immediately
    sendRefillReminderEmail($user_id, $order_id, $refill_date);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Function to send an order confirmation email
function sendOrderEmail($user_id, $order_id, $order_date, $refill_date) {
    global $conn;

    // Fetch user email
    $result = $conn->query("SELECT email FROM Users WHERE user_id = '$user_id'");
    $user = $result->fetch_assoc();
    $user_email = $user['email'];

    $subject = "Order Confirmation - Order #$order_id";
    $message = "Dear Customer,\n\nThank you for placing your order on $order_date.\nYour next refill date is scheduled for $refill_date.\n\nRegards,\nMediSphere";
    $headers = "From: fameventremainder@gmail.com";

    if (mail($user_email, $subject, $message, $headers)) {
        echo "Confirmation email sent to $user_email<br>";
    } else {
        echo "Failed to send confirmation email.<br>";
    }
}

// Function to send a refill reminder email
function sendRefillReminderEmail($user_id, $order_id, $refill_date) {
    global $conn;

    // Fetch user email
    $result = $conn->query("SELECT email FROM Users WHERE user_id = '$user_id'");
    $user = $result->fetch_assoc();
    $user_email = $user['email'];

    $subject = "Refill Reminder - Order #$order_id";
    $message = "Dear Customer,\n\nThis is a reminder to refill your prescription.\nYour refill date is scheduled for $refill_date.\n\nRegards,\nMediSphere";
    $headers = "From: fameventremainder@gmail.com";

    if (mail($user_email, $subject, $message, $headers)) {
        echo "Refill reminder email sent to $user_email<br>";
    } else {
        echo "Failed to send refill reminder email.<br>";
    }
}

$conn->close();
?>
