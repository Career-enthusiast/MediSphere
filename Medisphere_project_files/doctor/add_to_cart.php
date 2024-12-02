<?php
session_start();

// Check if the form is submitted
if (isset($_POST['medication_id'])) {
    $medication_id = $_POST['medication_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    // Create an array for the item
    $cartItem = [
        'medication_id' => $medication_id,
        'name' => $name,
        'price' => $price,
        'qty' => $qty
    ];

    // If the cart is not initialized, initialize it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the item to the cart
    $_SESSION['cart'][] = $cartItem;

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
} else {
    echo "No medication selected.";
}
?>
