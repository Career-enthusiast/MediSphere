<?php
session_start(); // Start session to manage cart data

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

// Consolidate cart items from session and database
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Fetch cart items stored in the database for logged-in users
if (isset($_SESSION['user_id'])) {
    $cart_id = $_SESSION['user_id']; // Use user ID as the cart identifier
    $query = "SELECT c.medication_id, c.quantity, m.medication_name, m.price, m.medicine_picture 
              FROM cart c
              JOIN Medications m ON c.medication_id = m.medication_id
              WHERE c.cart_id = :cart_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->execute();

    // Merge database items with session cart
    while ($db_item = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $db_item['type'] = 'medicine'; // Tag items from the database as medicines
        $cart_items[] = $db_item;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="cart.css"> <!-- Cart page specific CSS -->
    <link rel="stylesheet" href="style2.css"> <!-- Include the navigation bar CSS -->
    <style>
        .cart-table img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="cart-container">
        <h2>Your Cart</h2>

        <?php if (empty($cart_items)) { ?>
            <p>Your cart is empty. Please add some items.</p>
        <?php } else { ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_amount = 0;

                    foreach ($cart_items as $item) {
                        // Safely retrieve keys and provide defaults if they are missing
                        $name = isset($item['medication_name']) ? $item['medication_name'] : (isset($item['name']) ? $item['name'] : 'Unknown Product');
                        $price = isset($item['price']) ? $item['price'] : 0;
                        $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
                        $image = isset($item['medicine_picture']) ? $item['medicine_picture'] : 'default_supplement_image.jpg'; // Default image

                        $item_total = $price * $quantity;
                        $total_amount += $item_total;
                    ?>
                        <tr>
                            <td>
                                <div class="product-item">
                                    <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($name); ?>">
                                    <p><?php echo htmlspecialchars($name); ?></p>
                                </div>
                            </td>
                            <td>₹<?php echo htmlspecialchars($price); ?></td>
                            <td>
                                <form method="POST" action="update_cart.php">
                                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                                    <input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>" min="1" required>
                                    <button type="submit" name="update_quantity">Update</button>
                                </form>
                            </td>
                            <td>₹<?php echo htmlspecialchars($item_total); ?></td>
                            <td>
    <?php if (isset($item['medication_id'])) { ?>
        <!-- Remove button for medicines -->
        <a href="remove_from_cart.php?item_id=<?php echo urlencode($item['medication_id']); ?>&item_type=medicine" class="remove-item">Remove</a>
    <?php } elseif (isset($item['name'])) { ?>
        <!-- Remove button for supplements -->
        <a href="remove_from_cart.php?item_id=<?php echo urlencode($item['name']); ?>&item_type=supplement" class="remove-item">Remove</a>
    <?php } ?>
</td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="cart-summary">
                <h3>Total Amount: ₹<?php echo htmlspecialchars($total_amount); ?></h3>
                <a href="payment.php" class="checkout-btn">Proceed to Checkout</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
