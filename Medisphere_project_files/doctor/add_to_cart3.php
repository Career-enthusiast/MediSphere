<?php
session_start();

// Check if the form is submitted
if (isset($_POST['medicine_id']) && isset($_POST['medicine_name'])) {
    $medicine_id = intval($_POST['medicine_id']);
    $medicine_name = $_POST['medicine_name'];
    $brand_name = $_POST['brand_name'] ?? 'Unknown Brand';
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $image = $_POST['medicine_picture'] ?? 'default_image.jpg'; // Use default if no image is provided

    // Create an array for the medicine item
    $cartItem = [
        'id' => $medicine_id,
        'name' => $medicine_name,
        'brand' => $brand_name,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $image,
        'type' => 'medicine' // To distinguish between medicines and other items
    ];

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the item already exists in the cart
    $itemExists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $medicine_id && $item['type'] === 'medicine') {
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
    echo "No medicine selected or invalid data provided.";
}
