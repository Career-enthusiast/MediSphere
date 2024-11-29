<?php
// Database connection
$host = 'localhost';
$dbname = 'medisphere';
$username = 'root';
$password = '';
$port = 3307;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch medications for the selected category
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

$query = "
    SELECT Medicine_Name, Brand_Name, Price, Medicine_Picture, Medicine_ID
    FROM Medicines
    WHERE Category_ID = :category_id
";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
$stmt->execute();
$medications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines for Category <?= htmlspecialchars($category_id) ?></title>
    <link rel="stylesheet" href="style3.css">
    <style>
        .medicine-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .medicine-box {
            width: 250px;
            padding: 15px;
            text-align: center;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .medicine-box img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        .medicine-box h2 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .medicine-box p {
            font-size: 1em;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Medicines</h1>
        <div class="medicine-list">
        <?php if ($medications): ?>
            <?php foreach ($medications as $medicine): ?>
                <div class="medicine-box">
                    <a href="non_medicine_detail.php?medicine_id=<?php echo htmlspecialchars($medicine['Medicine_ID']); ?>">
                        <img src="<?= htmlspecialchars($medicine['Medicine_Picture']) ?>" alt="<?= htmlspecialchars($medicine['Medicine_Name']) ?>">
                        <h2><?= htmlspecialchars($medicine['Medicine_Name']) ?></h2>
                        <p>Brand: <?= htmlspecialchars($medicine['Brand_Name']) ?></p>
                        <p>Price: ₹<?= htmlspecialchars($medicine['Price']) ?></p>
                    </a>
                    <form action="add_to_cart3.php" method="POST">
    <input type="hidden" name="medicine_id" value="<?= htmlspecialchars($medicine['Medicine_ID']) ?>">
    <input type="hidden" name="medicine_name" value="<?= htmlspecialchars($medicine['Medicine_Name']) ?>">
    <input type="hidden" name="brand_name" value="<?= htmlspecialchars($medicine['Brand_Name']) ?>">
    <input type="hidden" name="price" value="<?= htmlspecialchars($medicine['Price']) ?>">
    <input type="hidden" name="medicine_picture" value="<?= htmlspecialchars($medicine['Medicine_Picture']) ?>">
    <input type="number" name="quantity" value="1" min="1" required>
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No medicines found for this category.</p>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>
