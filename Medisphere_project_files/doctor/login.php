<?php
session_start();

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

$error_message = ""; // Variable to store error messages

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $selected_role = $_POST['role']; // Assuming role is submitted from the form

    // Check if the user exists
    $sql = "SELECT user_id, password, role FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($password === $user['password']) {
        // Check if role matches the role in the database
        
        if ($user['role'] === 'doctor' || $user['role'] === 'doctor_app') {
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: doctor/home.php"); // Redirect to doctor's home.php
            exit();
        } elseif ($user['role'] === 'doctor_rej') {
            $error_message = "<p style='color: red; font-weight: bold;'>Your document has been rejected. <a href='registration.php' style='color: yellow;'>Register again</a></p>";
         } else {
            if (strtolower($selected_role) === strtolower($user['role'])) {
            // Redirect for other roles
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: home.php"); // Redirect to default home.php for other roles
            exit();
            } else {
                $error_message = "Incorrect role.";
        }
            
        }
    } else {
        $error_message = "Incorrect password.";
    }
} else {
    $error_message = "User not found.";
}


    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN FORM</title>
    <link rel="stylesheet" href="style_login_register.css">
</head>

<body>
    <section>
        <div class="login-box">
            <form action="login.php" method="post"> <!-- Ensure the form posts to this same page -->
                <h2>Login</h2>

                <?php
                // Display an error message if it exists
                if (!empty($error_message)) {
                    echo "<p style='color: red;'>$error_message</p>";
                }
                ?>

                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" name="email" required>
                    <label for="email">Email</label>
                </div>

                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label for="password">Password</label>
                </div>

                <!-- User Role Selection -->
                <div class="user-role">
                    <label><input type="radio" name="role" value="doctor" required> Doctor</label>
                    <label><input type="radio" name="role" value="admin" required> Admin</label>
                    <label><input type="radio" name="role" value="Patient" required> Patient</label>
                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit">Login</button>

                <div class="register-link">
                    <p>Don't have an account? <a href="registration.php">Register</a></p>
                </div>
            </form>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
