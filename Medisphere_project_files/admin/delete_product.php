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

// Check if the product ID is passed in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $medication_id = $_GET['id'];

    // Prepare and execute the DELETE query
    $stmt = $conn->prepare("DELETE FROM Medications WHERE medication_id = :medication_id");
    $stmt->bindParam(':medication_id', $medication_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect to the manage products page after successful deletion
        header("Location: manage_products.php?message=Product+deleted+successfully");
        exit();
    } else {
        echo "Error: Could not delete the product.";
    }
} else {
    echo "Error: No medication ID provided.";
}
