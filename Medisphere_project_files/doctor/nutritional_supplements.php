<?php
session_start(); // Start the session at the top of the file

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MediSphere";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutritional Supplements</title>
    <link rel="stylesheet" href="ns.css">
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
    <?php include 'navbar.php'; ?>

    <div class="medicine-section">
        <h1>Nutritional Supplements</h1>
        <div class="medicine-list">
            <?php
            // Retrieve supplements from the database
            $sql = "SELECT SupplementName, Price, ns_qty, Dosage, Picture, Description FROM NutritionalSupplements";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="medicine-item">';
                    echo '<form method="POST" action="add_to_cart2.php">';
                    echo '<a href="#">'; // Modify to link to a specific product page
                    echo '<img src="' . htmlspecialchars($row['Picture']) . '" alt="' . htmlspecialchars($row['SupplementName']) . '">';
                    echo '<p>' . htmlspecialchars($row['SupplementName']) . '</p>';
                    echo '<p>' . htmlspecialchars($row['ns_qty']) . ' - ₹' . htmlspecialchars($row['Price']) . '</p>';
                    echo '</a>';
                    echo '<input type="hidden" name="supplement_name" value="' . htmlspecialchars($row['SupplementName']) . '">';
                    echo '<input type="hidden" name="price" value="' . htmlspecialchars($row['Price']) . '">';
                    echo '<input type="number" name="quantity" value="1" min="1" required>';
                    echo '<button type="submit" name="add_to_cart2">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "<p>No nutritional supplements found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
