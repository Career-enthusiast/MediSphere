<?php
// Database connection
$host = 'localhost';
$dbname = 'medisphere';
$username = 'root';
$password = '';
$port=3307;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch medicine categories
$query = "SELECT Category_ID, Category_Name, Description FROM Medicine_Categories";
$stmt = $pdo->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non-Generic Medicines</title>
    <link rel="stylesheet" href="non_generic.css">
</head>
<body>
    <div class="container">
        <h1>Non-Generic Medicines</h1>
        <div class="medicine-grid">
            <?php foreach ($categories as $category): ?>
                <div class="medicine-box">
                    <h2>
                        <a href="non_medicines.php?category_id=<?= htmlspecialchars($category['Category_ID']) ?>">
                            <?= htmlspecialchars($category['Category_Name']) ?>
                        </a>
                    </h2>
                    <p><?= htmlspecialchars($category['Description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
