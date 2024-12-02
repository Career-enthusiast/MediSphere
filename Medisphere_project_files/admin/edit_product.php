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

// Fetch medication details based on ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $medication_id = $_GET['id'];

    $query = "SELECT * FROM medications WHERE medication_id = :medication_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':medication_id', $medication_id);
    $stmt->execute();
    $medication = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$medication) {
        die("Medication not found.");
    }
} else {
    die("Invalid request.");
}

// Handle form submission to update medication details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $price = $_POST['price'] ?? '';

    // Validate inputs
    if (empty($name) || empty($brand) || !is_numeric($price)) {
        $error = "Please provide valid inputs.";
    } else {
        // Update the medication in the database
        $updateQuery = "UPDATE medications SET medication_name = :name, brand = :brand, price = :price WHERE medication_id = :medication_id";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bindParam(':name', $name);
        $updateStmt->bindParam(':brand', $brand);
        $updateStmt->bindParam(':price', $price);
        $updateStmt->bindParam(':medication_id', $medication_id);

        if ($updateStmt->execute()) {
            header("Location: manage_products.php");
            exit();
        } else {
            $error = "Failed to update the medication.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medication</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div class="content">
        <h1>Edit Medication</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($medication['medication_name']) ?>" required>
            </div>
            <div>
                <label for="brand">Brand:</label>
                <input type="text" id="brand" name="brand" value="<?= htmlspecialchars($medication['brand']) ?>" required>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="<?= htmlspecialchars($medication['price']) ?>" step="0.01" required>
            </div>
            <div>
                <button type="submit">Update</button>
                <a href="manage_products.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
