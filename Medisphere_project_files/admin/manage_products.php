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

// Fetch medications with category and symptom
$medications = [];
try {
    $query = "
        SELECT 
            m.medication_id,
            m.medication_name,
            m.brand,
            m.price,
            GROUP_CONCAT(DISTINCT c.condition_name SEPARATOR ', ') AS category,
            GROUP_CONCAT(DISTINCT s.symptom_name SEPARATOR ', ') AS symptom
        FROM medications m
        LEFT JOIN symptom_condition_medication scm ON m.medication_id = scm.medication_id
        LEFT JOIN conditions c ON scm.condition_id = c.condition_id
        LEFT JOIN symptoms s ON scm.symptom_id = s.symptom_id
        GROUP BY m.medication_id
    ";
    $stmt = $conn->query($query);
    $medications = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching medications: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="Admin.css">
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
        <h1>Manage Products</h1>
        <a href="add_product.php" class="btn">Add New Product</a>

        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Symptom</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($medications)): ?>
                    <?php foreach ($medications as $medication): ?>
                        <tr>
                            <td><?= htmlspecialchars($medication['medication_id']) ?></td>
                            <td><?= htmlspecialchars($medication['medication_name']) ?></td>
                            <td><?= htmlspecialchars($medication['category']) ?></td>
                            <td><?= htmlspecialchars($medication['symptom']) ?></td>
                            <td><?= htmlspecialchars($medication['brand']) ?></td>
                            <td>&#8377;<?= htmlspecialchars(number_format($medication['price'], 2)) ?></td>
                            <td>
                            <a href="../medicine_detail.php?medication_id=<?= htmlspecialchars($medication['medication_id']) ?>">View</a> |
                            <a href="edit_product.php?id=<?= htmlspecialchars($medication['medication_id']) ?>">Edit</a> | 
                            <a href="delete_product.php?id=<?= htmlspecialchars($medication['medication_id']) ?>" 
                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No products found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
