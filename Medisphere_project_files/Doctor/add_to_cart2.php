<?php
session_start();

// Check if the form is submitted
if (isset($_POST['supplement_name'])) {
    $supplement_name = $_POST['supplement_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Create an array for the supplement item
    $cartItem = [
        'name' => $supplement_name,
        'price' => $price,
        'quantity' => $quantity,
        'type' => 'supplement' // To distinguish between medicines and supplements
    ];

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the item already exists in the cart
    $itemExists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $supplement_name && $item['type'] === 'supplement') {
            $item['quantity'] += $quantity; // Update quantity
            $itemExists = true;
            break;
        }
    }

    // Add the new item if it doesn't exist
    if (!$itemExists) {
        $_SESSION['cart'][] = $cartItem;
    }

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
} else {
    echo "No supplement selected.";
}
?>
