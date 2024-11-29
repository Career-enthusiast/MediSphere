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

// Get today's date
$today = date('Y-m-d');

// Fetch orders due for refill reminders
$sql = "SELECT user_orders.user_id, user_orders.order_id, Users.email, user_orders.refill_date
        FROM user_orders
        JOIN Users ON user_orders.user_id = Users.user_id
        WHERE user_orders.refill_date = '$today' AND user_orders.refill_reminder_sent = FALSE";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_email = $row['email'];
        $order_id = $row['order_id'];
        $refill_date = $row['refill_date'];

        $subject = "Refill Reminder - Order #$order_id";
        $message = "Dear Customer,\n\nThis is a reminder to refill your prescription.\nYour refill date was scheduled for $refill_date.\n\nRegards,\nMediSphere";
        $headers = "From: fameventremainder@gmail.com";

        if (mail($user_email, $subject, $message, $headers)) {
            echo "Refill reminder sent to $user_email\n";

            // Mark reminder as sent
            $update_sql = "UPDATE user_orders SET refill_reminder_sent = TRUE WHERE order_id = '$order_id'";
            $conn->query($update_sql);
        } else {
            echo "Failed to send reminder to $user_email\n";
        }
    }
} else {
    echo "No refills scheduled for today.";
}

$conn->close();
?>
