<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MediSphere";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the user_id from the URL
$user_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$user_id) {
    die("Invalid user ID.");
}

// Fetch user details (optional, to display user information if needed)
// $user_sql = "SELECT * FROM Users WHERE user_id = ?";
// $stmt = $conn->prepare($user_sql);
// $stmt->bind_param("i", $user_id);
// $stmt->execute();
// $user_result = $stmt->get_result();
// $user_data = $user_result->fetch_assoc();

// Fetch user orders and their details
$sql = "SELECT uo.order_id, uo.order_date, od.medication_id, od.price
        FROM user_orders uo
        JOIN order_details od ON uo.order_id = od.order_id
        WHERE uo.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link rel="stylesheet" href="Admin2.css">
</head>
<body>
    <div class="sidebar">
        <div class="profile">
            <div class="profile-picture"></div>
            <h3>Admin</h3>
        </div>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Customer</a>
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
    <div class="customer-profile">
        <div class="profile-picture">
            <!-- Profile image here -->
            <img src="profile.jpg" alt="Customer Profile Picture">
        </div>
        <h2>Orders</h2>
    <div class="content"> <div class="search-bar"> <label for="search-customer">Search:</label> <input type="text" id="search-customer" placeholder="Search Customer">

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Medication ID</th>
                    <th>Amount Paid</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['medication_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No orders found for this customer.</td></tr>";
                }

                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
