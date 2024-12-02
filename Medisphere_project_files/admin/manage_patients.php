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

// Query to fetch data for users with the role 'Patient'
$sql = "SELECT u.user_id, u.first_name, u.last_name, u.email, u.password, 
               p.age, p.location 
        FROM Users u 
        JOIN User_Profile p ON u.user_id = p.user_id 
        WHERE u.role = 'Patient'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Patients</title>
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
   
    <div class="content">
        <!-- <div class="search-bar">
            <label for="search-customer">Search:</label>
            <input type="text" id="search-customer" placeholder="Search Customer">
        </div> -->

        <table>
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $sl = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $sl++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                        echo "<td><a href='customer_details.php?id=" . urlencode($row['user_id']) . "'>View</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No patients found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
