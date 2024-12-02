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

// Get category and query parameters
$category = isset($_GET['category']) ? $_GET['category'] : '';
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Validate inputs
if (empty($category) || empty($query)) {
    echo "<p>Please provide a valid category and query.</p>";
    exit;
}

// Prepare SQL query based on the selected category
$sql = "";
$params = [];
if ($category === 'conditions') {
    $sql = "
        SELECT Medications.medication_id, Medications.medication_name, Medications.brand, Medications.price, 
               Medications.description, Medications.side_effects, Medications.dosage, 
               Medications.medicine_picture
        FROM Medications
        JOIN Symptom_Condition_Medication ON Medications.medication_id = Symptom_Condition_Medication.medication_id
        JOIN Conditions ON Conditions.condition_id = Symptom_Condition_Medication.condition_id
        WHERE Conditions.condition_name LIKE :query
    ";
    $params[':query'] = "%" . $query . "%";
} elseif ($category === 'symptoms') {
    $sql = "
        SELECT Medications.medication_id, Medications.medication_name, Medications.brand, Medications.price, 
               Medications.description, Medications.side_effects, Medications.dosage, 
               Medications.medicine_picture
        FROM Medications
        JOIN Symptom_Condition_Medication ON Medications.medication_id = Symptom_Condition_Medication.medication_id
        JOIN Symptoms ON Symptoms.symptom_id = Symptom_Condition_Medication.symptom_id
        WHERE Symptoms.symptom_name LIKE :query
    ";
    $params[':query'] = "%" . $query . "%";
} else {
    echo "<p>Invalid category selected.</p>";
    exit;
}

// Execute the query
$stmt = $conn->prepare($sql);
$stmt->execute($params);
$medications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($query) ?> in <?= htmlspecialchars($category) ?> : Medication Choices</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        .medicine-item img {
            width: 200px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
        .medicine-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 250px;
            text-align: center;
            background-color: #f9f9f9;
        }
        .medicine-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }
        .medicine-section h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Include navbar from the external PHP file -->
    <?php include 'navbar.php'; ?>

    <div class="medicine-section">
        <h1>Search Results for <?= htmlspecialchars($query) ?> in <?= htmlspecialchars($category) ?></h1>
        
        <div class="medicine-list">
            <?php if ($medications): ?>
                <?php foreach ($medications as $medicine): ?>
                    <div class="medicine-item">
                        <a href="medicine_detail.php?medication_id=<?= htmlspecialchars($medicine['medication_id']) ?>">
                            <img src="<?= htmlspecialchars($medicine['medicine_picture']) ?>" alt="<?= htmlspecialchars($medicine['medication_name']) ?>">
                            <p><strong><?= htmlspecialchars($medicine['medication_name']) ?></strong></p>
                            <p>Brand: <?= htmlspecialchars($medicine['brand']) ?></p>
                            <p>Price: ₹<?= htmlspecialchars($medicine['price']) ?></p>
                        </a>
                        <button>Add to Cart</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No medicines found for your search query: <?= htmlspecialchars($query) ?>.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Your Website</p>
    </footer>
</body>
</html>
