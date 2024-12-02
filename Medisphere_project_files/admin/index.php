<?php
// Start session to manage admin authentication and session data
session_start();

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

// Query to get the total number of customers (users)
$userQuery = "SELECT COUNT(*) AS total_customers FROM users";
$userStmt = $conn->prepare($userQuery);
$userStmt->execute();
$userResult = $userStmt->fetch(PDO::FETCH_ASSOC);
$total_customers = $userResult['total_customers']; // Total number of customers

// Query to get the total number of medicines
$medicineQuery = "SELECT COUNT(*) AS total_medicines FROM medications";
$medicineStmt = $conn->prepare($medicineQuery);
$medicineStmt->execute();
$medicineResult = $medicineStmt->fetch(PDO::FETCH_ASSOC);
$total_medicines = $medicineResult['total_medicines']; // Total number of medicines
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="sidebar">
        <div class="profile">
            <div class="profile-picture"></div>
            <h3>Admin</h3>
        </div>
        <ul>
            <li><a href="index.html">Dashboard</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Customers</a>
                <ul class="dropdown-content">
                    <li><a href="manage_patients.php">Patients</a></li>
                    <li><a href="manage_doctors.php">Doctors</a></li>
                </ul>
            </li>
            <li><a href="manage_products.php">Medicines</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="customer_request.php">Customer Requests</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Dashboard</h1>
        <div class="stats">
            <div class="stat-box">Total Customers <span><?php echo htmlspecialchars($total_customers); ?></span></div>
            <div class="stat-box">Total Medicines <span><?php echo htmlspecialchars($total_medicines); ?></span></div>
      </div>

    </div>
</body>
</html>
