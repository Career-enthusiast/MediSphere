<?php
// db_connect.php
$host = "localhost";
$user = "root";      // replace with your MySQL username
$password = "";      // replace with your MySQL password
$database = "MediSphere";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}
else
echo 'connection established';
?>
