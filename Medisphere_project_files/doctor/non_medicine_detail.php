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

// Check if Medicine_ID is provided in the URL
if (!isset($_GET['medicine_id']) || empty($_GET['medicine_id'])) {
    die("No medicine ID provided.");
}

$medicine_id = intval($_GET['medicine_id']);

// Fetch medicine details from the Medicines table
$query = "SELECT * FROM Medicines WHERE Medicine_ID = :medicine_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':medicine_id', $medicine_id, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() === 0) {
    die("Medicine not found.");
}

$medicine = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($medicine['Medicine_Name']) ?></title>
    <link rel="stylesheet" href="style3.css">
    <style>
        .medicine-detail-section {
            padding: 20px;
        }

        .header-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .product-image {
            max-width: 200px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .product-info h1 {
            margin: 0;
            font-size: 1.8em;
        }

        .product-details h2, .product-details h3 {
            margin: 5px 0;
        }

        .details-header {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            background: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            margin-top: 20px;
            border-radius: 5px;
        }

        .details-header:hover {
            background: #eee;
        }

        .details {
            border: 1px solid #ddd;
            border-top: none;
            padding: 15px;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Include navbar from the external PHP file -->
    <?php include 'navbar.php'; ?>

    <div class="medicine-detail-section">
        <div class="header-container">
            <img src="<?= htmlspecialchars($medicine['Medicine_Picture']) ?>" alt="<?= htmlspecialchars($medicine['Medicine_Name']) ?>" class="product-image">
            <div class="product-info">
                <h1><?= htmlspecialchars($medicine['Medicine_Name']) ?></h1>
                <div class="product-details">
                    <h2 class="price">Price: ₹<?= htmlspecialchars($medicine['Price']) ?></h2>
                    <h3>Brand: <?= htmlspecialchars($medicine['Brand_Name']) ?></h3>
                    <h3>Dosage: <?= htmlspecialchars($medicine['Dosage']) ?></h3>
                    <h3>Prescription Required: <?= $medicine['Prescription_Required'] ? 'Yes' : 'No' ?></h3>
                </div>
            </div>
        </div>

        <!-- Add to Cart form -->
        <form method="POST" action="cart.php">
            <input type="hidden" name="medicine_id" value="<?= htmlspecialchars($medicine['Medicine_ID']) ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1">
            <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>

        <!-- Product Details -->
        <div class="details-header" onclick="toggleDetails()">
            <h3>Product Details</h3>
            <span class="arrow">↓</span>
        </div>
        <div class="details" id="product-details" style="display: none;">
            <h4>Description:</h4>
            <p><?= nl2br(htmlspecialchars($medicine['Description'])) ?></p>
            <h4>Side Effects:</h4>
            <ul>
                <?php foreach (explode(';', $medicine['Side_Effects']) as $side_effect): ?>
                    <li><?= htmlspecialchars(trim($side_effect)) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="button-container">
            <button onclick="window.history.back()">Go Back</button>
        </div>
    </div>

    <script>
        function toggleDetails() {
            const details = document.getElementById('product-details');
            const arrow = document.querySelector('.arrow');

            if (details.style.display === 'none') {
                details.style.display = 'block';
                arrow.textContent = '↑';
            } else {
                details.style.display = 'none';
                arrow.textContent = '↓';
            }
        }
    </script>
</body>
</html>
