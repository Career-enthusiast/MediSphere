<?php
// Start session to manage cart data
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

// Check if medication ID is provided in the URL
if (!isset($_GET['medication_id']) || empty($_GET['medication_id'])) {
    die("No medication ID provided.");
}

$medication_id = $_GET['medication_id'];

// Fetch medication details from the database
$stmt = $conn->prepare("SELECT * FROM Medications WHERE medication_id = :medication_id");
$stmt->bindParam(':medication_id', $medication_id, PDO::PARAM_INT);
$stmt->execute();

// Check if medication exists
if ($stmt->rowCount() === 0) {
    die("Medication not found.");
}
$medication = $stmt->fetch(PDO::FETCH_ASSOC);


// Handle "Add to Cart" functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $medication_id = $_POST['medication_id'];
    $quantity = $_POST['quantity'];

    // Use session's user ID as the cart_id
    $cart_id = $_SESSION['user_id']; // Assuming user is logged in and session contains user_id

    // Check if the medication is already in the cart
    $stmt = $conn->prepare("SELECT * FROM cart WHERE cart_id = :cart_id AND medication_id = :medication_id");
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->bindParam(':medication_id', $medication_id);
    $stmt->execute();
    
    // If the medication already exists in the cart, update the quantity
    if ($stmt->rowCount() > 0) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + :quantity WHERE cart_id = :cart_id AND medication_id = :medication_id");
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->bindParam(':medication_id', $medication_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
    } else {
        // Otherwise, insert a new entry for the medication
        $stmt = $conn->prepare("INSERT INTO cart (cart_id, medication_id, quantity) VALUES (:cart_id, :medication_id, :quantity)");
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->bindParam(':medication_id', $medication_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
    }

    // Redirect to the cart page after adding
    header("Location: cart.php");
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ortho Oil Product</title>
    <link rel="stylesheet" href="var_css.css"> <!-- Ortho Oil specific CSS -->
    <link rel="stylesheet" href="style2.css"> <!-- Include the navigation bar CSS -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        // Include dropdown functionality
        document.addEventListener('DOMContentLoaded', function () {
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('mouseenter', function () {
                    this.querySelector('.dropdown-content').style.display = 'block';
                });

                dropdown.addEventListener('mouseleave', function () {
                    this.querySelector('.dropdown-content').style.display = 'none';
                });
            });
        });
    </script>
</head>

<body>
    <!-- Include navbar from the external PHP file -->
    <?php include 'navbar.php'; ?>

    <div class="medicine-detail-section">
        <?php
        // Check if medication_id is passed in the URL
        if (isset($_GET['medication_id'])) {
            $medication_id = $_GET['medication_id'];

            // Query to fetch medication details
            $query = "SELECT * FROM Medications WHERE medication_id = :medication_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':medication_id', $medication_id);
            $stmt->execute();

            $medicine = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if medication was found
            if ($medicine) {
                // Display medication details
                echo "<div class='header-container'>";
                echo "<img src='" . htmlspecialchars($medicine['medicine_picture']) . "' alt='" . htmlspecialchars($medicine['medication_name']) . "' class='product-image'>";
                echo "<div class='product-info'>";
                echo "<h1>" . htmlspecialchars($medicine['medication_name']) . "</h1>";
                echo "<div class='product-details'>";
                echo "<h2 class='price'>Price: ₹" . htmlspecialchars($medicine['price']) . "</h2>";
                echo "<h3>Quantity: " . htmlspecialchars($medicine['dosage']) . "</h3>";
                echo "<h3>Brand: " . htmlspecialchars($medicine['brand']) . "</h3>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // Add to Cart form
                echo "<form method='POST' action=''>"; // Submit to the same page
                echo "<input type='hidden' name='medication_id' value='" . htmlspecialchars($medicine['medication_id']) . "'>";
                echo "<input type='hidden' name='medication_name' value='" . htmlspecialchars($medicine['medication_name']) . "'>";
                echo "<input type='hidden' name='price' value='" . htmlspecialchars($medicine['price']) . "'>";
                echo "<input type='hidden' name='medicine_picture' value='" . htmlspecialchars($medicine['medicine_picture']) . "'>";
                echo "<label for='quantity'>Qty:</label>";
                echo "<input type='number' name='quantity' id='quantity' value='1' min='1'>";
                echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";

                // Details toggle section
                echo "<div class='details-header' onclick='toggleDetails()'>";
                echo "<h3>Product Details</h3>";
                echo "<span class='arrow'>↓</span>";
                echo "</div>";

                echo "<div class='details' id='product-details' style='display: none;'>";
                echo "<h4>Description:</h4>";
                echo "<p>" . nl2br(htmlspecialchars($medicine['description'])) . "</p>";

                echo "<h4>Side effects:</h4>";
                echo "<ul>";
                $side_effects = explode(';', $medicine['side_effects']); // Assuming side effects are stored as a semicolon-separated list
                foreach ($side_effects as $side_effect) {
                    echo "<li>" . htmlspecialchars(trim($side_effect)) . "</li>";
                }
                echo "</ul>";

                echo "<h4>Directions for Use:</h4>";
                echo "<p>" . nl2br(htmlspecialchars($medicine['dosage'])) . "</p>";
                echo "</div>";

                echo "<div class='button-container'>";
                echo "<button onclick='window.history.back()'>Go Back</button>";
                echo "</div>";
            } else {
                // Display a message if no medication is found
                echo "<p>Medication not found. Please check the ID and try again.</p>";
            }
        } else {
            echo "<p>No medication ID provided.</p>";
        }
        ?>
    
    <div class="customer-reviews-section">
            <h2>Customer Reviews</h2>
            <div class="rating-summary">
                <span class="average-rating">4.5</span>
                <span class="stars">★★★★☆</span>
                <span class="total-reviews">(120 reviews)</span>
            </div>

            <div class="reviews-list">
                <div class="review">
                    <div class="review-rating">★★★★☆</div>
                    <p class="review-text">"Great product! Really helped with my symptoms."</p>
                    <p class="review-author">- John D.</p>
                </div>
                <div class="review">
                    <div class="review-rating">★★★★★</div>
                    <p class="review-text">"Excellent quality and fast delivery."</p>
                    <p class="review-author">- Sarah W.</p>
                </div>
                <div class="review">
                    <div class="review-rating">★★★★☆</div>
                    <p class="review-text">"Good product but could be improved in packaging."</p>
                    <p class="review-author">- Michael T.</p>
                </div>
                <div class="review">
                    <div class="review-rating">★★★☆☆</div>
                    <p class="review-text">"Effective but slightly expensive."</p>
                    <p class="review-author">- Priya K.</p>
                </div>
            </div>
            <button class="write-review-button">Write a Review</button>
        </div>
    </div>

            
            <div class="button-container">
                <button onclick="window.location.href='Cart.html'">Add to Cart</button>
                <button onclick="window.history.back()">Go Back</button>
            </div>
        </div>
    </div>
        <script>
        function toggleDetails() {
            var details = document.getElementById('product-details');
            var arrow = document.querySelector('.arrow');

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
