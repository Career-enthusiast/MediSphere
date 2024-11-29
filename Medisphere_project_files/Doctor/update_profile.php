<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];
$age = $_POST['age'];
$gender = $_POST['gender'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MediSphere";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update user profile information
$sql = "UPDATE User_Profile SET age = ?, gender = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $age, $gender, $user_id);

if ($stmt->execute()) {
    echo "<p>Profile updated successfully. <a href='profile.php'>Back to Profile</a></p>";
} else {
    echo "Error updating profile: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
