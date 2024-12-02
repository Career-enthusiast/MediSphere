<?php
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $medication_name = $_POST['medication_name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $side_effects = $_POST['side_effects'];
    $dosage = $_POST['dosage'];
    
    // Assume there is an image upload (optional)
    $medicine_picture = 'default.jpg'; // Replace this with actual upload handling if needed.

    // Insert the new product into the database
    $stmt = $conn->prepare("INSERT INTO Medications (medication_name, brand, price, description, side_effects, dosage, medicine_picture) 
                            VALUES (:medication_name, :brand, :price, :description, :side_effects, :dosage, :medicine_picture)");
    $stmt->bindParam(':medication_name', $medication_name);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':side_effects', $side_effects);
    $stmt->bindParam(':dosage', $dosage);
    $stmt->bindParam(':medicine_picture', $medicine_picture);
    
    if ($stmt->execute()) {
        // Redirect to manage products page after successful insertion
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error adding product!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div class="form-container">
        <h1>Add New Product</h1>
        <form method="POST" action="add_product.php">
            <div class="form-group">
                <label for="medication_name">Medication Name</label>
                <input type="text" id="medication_name" name="medication_name" required>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" id="brand" name="brand" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="side_effects">Side Effects</label>
                <textarea id="side_effects" name="side_effects" required></textarea>
            </div>

            <div class="form-group">
                <label for="dosage">Dosage</label>
                <input type="text" id="dosage" name="dosage" required>
            </div>

            <!-- Optional: Add file upload for image -->
            <!-- <div class="form-group">
                <label for="medicine_picture">Medicine Picture</label>
                <input type="file" id="medicine_picture" name="medicine_picture">
            </div> -->

            <div class="form-group">
                <button type="submit" name="submit">Add Product</button>
            </div>
        </form>
    </div>
</body>
</html>
