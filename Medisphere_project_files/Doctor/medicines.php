<?php
// Start the session at the top of the file
session_start(); // Ensure session is started to manage the cart

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

// Handle "Add to Cart" functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $medication_id = $_POST['medication_id'];
    $quantity = $_POST['quantity'];

    // Use session's user ID as the cart_id
    $cart_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : session_id(); // Fallback to session ID for guest users

    // Check if the medication is already in the cart
    $stmt = $conn->prepare("SELECT * FROM cart WHERE cart_id = :cart_id AND medication_id = :medication_id");
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->bindParam(':medication_id', $medication_id);
    $stmt->execute();

    // Update quantity if medication is already in the cart
    if ($stmt->rowCount() > 0) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + :quantity WHERE cart_id = :cart_id AND medication_id = :medication_id");
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->bindParam(':medication_id', $medication_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
    } else {
        // Insert a new entry into the cart
        $stmt = $conn->prepare("INSERT INTO cart (cart_id, medication_id, quantity) VALUES (:cart_id, :medication_id, :quantity)");
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->bindParam(':medication_id', $medication_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
    }

    // Redirect back to the same page to avoid form resubmission
    // Redirect to cart.php after adding to cart
header("Location: cart.php");
exit();

}

// Retrieve condition and symptom names from the query parameters
$condition_name = isset($_GET['condition']) ? $_GET['condition'] : '';
$symptom_name = isset($_GET['symptom']) ? $_GET['symptom'] : '';

// Modify the query based on whether a symptom is selected or not
if (!empty($symptom_name)) {
    // Fetch medications based on condition and symptom
    $query = "
        SELECT Medications.medication_id, Medications.medication_name, Medications.brand, Medications.price, 
               Medications.description, Medications.side_effects, Medications.dosage, 
               Medications.medicine_picture
        FROM Medications
        JOIN Symptom_Condition_Medication ON Medications.medication_id = Symptom_Condition_Medication.medication_id
        JOIN Conditions ON Conditions.condition_id = Symptom_Condition_Medication.condition_id
        JOIN Symptoms ON Symptoms.symptom_id = Symptom_Condition_Medication.symptom_id
        WHERE Conditions.condition_name = :condition_name AND Symptoms.symptom_name = :symptom_name
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':condition_name', $condition_name);
    $stmt->bindParam(':symptom_name', $symptom_name);
} else {
    // Fetch all medications for the selected condition
    $query = "
        SELECT Medications.medication_id, Medications.medication_name, Medications.brand, Medications.price, 
               Medications.description, Medications.side_effects, Medications.dosage, 
               Medications.medicine_picture
        FROM Medications
        JOIN Symptom_Condition_Medication ON Medications.medication_id = Symptom_Condition_Medication.medication_id
        JOIN Conditions ON Conditions.condition_id = Symptom_Condition_Medication.condition_id
        WHERE Conditions.condition_name = :condition_name
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':condition_name', $condition_name);
}

$stmt->execute();

$medications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($condition_name) ?> with <?= htmlspecialchars($symptom_name) ?: 'No Specific Symptom' ?> : Medication Choices</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        .medicine-item img {
            width: 200px;
            height: auto;
        }
        .medicine-item {
            margin-bottom: 20px;
        }
        .medicine-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
    </style>
</head>
<body>
    <!-- Include navbar from the external PHP file -->
    <?php include 'navbar.php'; ?>

    <div class="medicine-section">
        <h1><?= htmlspecialchars($condition_name) ?> with <?= htmlspecialchars($symptom_name) ?: 'No Specific Symptom' ?> : Medication Choices</h1>
        
        <div class="medicine-list">
            <?php if ($medications): ?>
                <?php foreach ($medications as $medicine): ?>
                    <div class="medicine-item">
    <a href="medicine_detail.php?medication_id=<?= htmlspecialchars($medicine['medication_id']) ?>">
        <img src="<?= htmlspecialchars($medicine['medicine_picture']) ?>" alt="<?= htmlspecialchars($medicine['medication_name']) ?>">
        <p><?= htmlspecialchars($medicine['medication_name']) ?>, <?= htmlspecialchars($medicine['brand']) ?> - ₹<?= htmlspecialchars($medicine['price']) ?></p>
    </a>
    <form method="POST" action="medicines.php">
        <input type="hidden" name="medication_id" value="<?= htmlspecialchars($medicine['medication_id']) ?>">
        <input type="hidden" name="quantity" value="1"> <!-- Default quantity to 1 -->
        <button type="submit" name="add_to_cart">Add to Cart</button>
    </form>
</div>

                <?php endforeach; ?>
            <?php else: ?>
                <p>No medicines found for <?= htmlspecialchars($symptom_name) ?: 'the selected condition' ?>.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
