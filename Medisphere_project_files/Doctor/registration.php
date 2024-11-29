<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style_login_register.css">
</head>
<body>
    <?php
        // Database configuration
        $host = "localhost";
        $username = "root";
        $password = ""; // Update with your actual database password if needed
        $database = "medisphere";
        $port = 3307;
        // Create connection
        $conn = new mysqli($host, $username, $password, $database, $port);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $role = $_POST["role"];

            // SQL query to insert data into Users table
            $sql_users = "INSERT INTO Users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
            $stmt_users = $conn->prepare($sql_users);
            $stmt_users->bind_param("sssss", $first_name, $last_name, $email, $password, $role);

            // Execute Users table insertion
            if ($stmt_users->execute()) {
                // Get the user_id of the newly inserted user
                $user_id = $stmt_users->insert_id;

                // SQL query to insert data into User_Profile table
                $sql_profile = "INSERT INTO User_Profile (user_id, age, gender) VALUES (?, NULL, NULL)";
                $stmt_profile = $conn->prepare($sql_profile);
                $stmt_profile->bind_param("i", $user_id);
                
                 // If the role is "doctor", redirect to document upload
                 if ($role === "doctor") {
                    header("Location: upload_document.php?user_id=$user_id");
                    exit();
                } else {
                    // For other roles, redirect to login
                    echo "<p>Registration successful. <a href='login.php'>Login here</a>.</p>";
                    header("Location: login.php");
                    exit();
                }
                
                // Execute User_Profile table insertion
                if ($stmt_profile->execute()) {
                    echo "<p>Registration successful. <a href='login.html'>Login here</a>.</p>";
                    // Redirect to login page after successful registration
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<p>Error updating profile: " . $conn->error . "</p>";
                }

                // Close User_Profile statement
                $stmt_profile->close();
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }

            // Close Users statement and connection
            $stmt_users->close();
            $conn->close();
        }
    ?>

    <section>
        <div class="login-box2">
            <form action="" method="post">
                <h1>Registration</h1>
                <div class="row">
                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="person-circle"></ion-icon>
                        </span>
                        <input type="text" name="first_name" required>
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="input-box">
                        <span class="icon">
                            <ion-icon name="person-circle"></ion-icon>
                        </span>
                        <input type="text" name="last_name" required>
                        <label for="last_name">Last Name</label>
                    </div>
                </div>

                <div class="row">
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
                </div>

                <div class="user-role">
                    <label><input type="radio" name="role" value="doctor" required> Doctor</label>
                    <label><input type="radio" name="role" value="admin" required> Admin</label>
                    <label><input type="radio" name="role" value="patient" required> Patient</label>
                </div>

                <button type="submit">Sign Up</button>
                <div class="register-link"> 
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
