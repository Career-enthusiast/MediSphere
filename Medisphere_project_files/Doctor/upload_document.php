<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Document</title>
    <link rel="stylesheet" href="style_login_register.css">
</head>
<body>
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['proof'])) {
    $user_id = $_POST["user_id"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["proof"]["name"]);
    $upload_ok = 1;

    // Validate file type (e.g., PDF, JPEG)
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($file_type != "pdf" && $file_type != "jpg" && $file_type != "jpeg" && $file_type != "png") {
        echo "<p>Only PDF, JPG, JPEG, and PNG files are allowed.</p>";
        $upload_ok = 0;
    }

    if ($upload_ok && move_uploaded_file($_FILES["proof"]["tmp_name"], $target_file)) {
        // Insert the document proof into the database
        $sql = "UPDATE Users SET document_proof = ?, role = 'pending' WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $target_file, $user_id);
        if ($stmt->execute()) {
            echo "<div class='message-container'>";
            echo "<h1>Submitted document is now under verification</h1>";
            echo "<p>Your account will be activated within 3 days if you are verified as a doctor.</p>";
            echo "</div>";
        } else {
            echo "<p>Error saving document information to the database.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error uploading file. Please try again.</p>";
    }
}

$conn->close();
?>

<section>
    <div class="login-box2">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Upload Document Proof</h1>
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($_GET['user_id']) ?>">
            <input type="file" name="proof" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</section>

<style>
    .message-container {
        text-align: center;
        margin-top: 20px;
    }
    .message-container h1 {
        font-size: 2rem;
        color: #4caf50;
    }
    .message-container p {
        font-size: 1.2rem;
    }
</style>
</body>
</html>
