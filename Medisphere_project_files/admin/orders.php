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

// Query to fetch data from order_details, user_orders, Users, and payment_methods tables
$sql = "
    SELECT u.user_id, 
           uo.order_id, 
           od.medication_id, 
           od.price AS amount_paid, 
           uo.order_date, 
           pm.payment_type 
    FROM order_details od
    JOIN user_orders uo ON od.order_id = uo.order_id
    JOIN Users u ON uo.user_id = u.user_id
    LEFT JOIN payment_methods pm ON uo.order_id = pm.order_id
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
            <li><a href="manage_products.php">Medicine</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="customer_request.php">Customer Request</a></li>
        </ul>
    </div>
    
    <h2>Orders</h2>
    <div class="content">
        <div class="search-bar">
            <label for="search-customer">Search:</label>
            <input type="text" id="search-customer" placeholder="Search Customer">
        </div>

        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Order ID</th>
                    <th>Medication ID</th>
                    <th>Amount Paid</th>
                    <th>Order Date</th>
                    <th>Payment Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['medication_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['amount_paid']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['payment_type']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No orders found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
