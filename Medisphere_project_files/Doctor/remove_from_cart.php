<?php
session_start();

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

if (isset($_GET['item_id']) && isset($_GET['item_type'])) {
    $item_id = $_GET['item_id'];
    $item_type = $_GET['item_type'];

    // Get the cart_id (user_id) from the session
    if (isset($_SESSION['user_id'])) {
        $cart_id = $_SESSION['user_id'];

        // Ensure $_SESSION['cart'] exists and is an array
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = []; // Initialize as an empty array
        }

        // Handle removal based on item type
        if ($item_type === 'medicine') {
            // Remove medication from session
            foreach ($_SESSION['cart'] as $key => $item) {
                if (isset($item['medication_id']) && $item['medication_id'] == $item_id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array

            // Remove medication from database
            $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = :cart_id AND medication_id = :medication_id");
            $stmt->bindParam(':cart_id', $cart_id);
            $stmt->bindParam(':medication_id', $item_id);
            $stmt->execute();
        } elseif ($item_type === 'supplement') {
            // Remove supplement from session
            foreach ($_SESSION['cart'] as $key => $item) {
                if (isset($item['name']) && $item['name'] == $item_id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array

            // Uncomment below if supplements are stored in the database
            /*
            $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = :cart_id AND supplement_name = :supplement_name");
            $stmt->bindParam(':cart_id', $cart_id);
            $stmt->bindParam(':supplement_name', $item_id);
            $stmt->execute();
            */
        }
    }
}

// Redirect to cart page
header("Location: cart.php");
exit();
