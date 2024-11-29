<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MediSphere";
$port = 3307;
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch user data
    $sql = "SELECT Users.first_name, Users.last_name, Users.email, User_Profile.age, User_Profile.gender, User_Profile.location, User_Profile.medical_history, User_Profile.profile_pic, Users.role
            FROM Users
            INNER JOIN User_Profile ON Users.user_id = User_Profile.user_id
            WHERE Users.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $location = $_POST['location'];
        $medical_history = $_POST['medical_history'];

        // Handle profile picture upload
        // Handle profile picture upload
if (!empty($_FILES['profile_pic']['name'])) {
    $target_dir = "uploads/";  // Save the file in the uploads directory
    $target_file = $target_dir . basename($_FILES['profile_pic']['name']);
    
    // Move the uploaded file to the target directory
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file);
    $profile_pic = $target_file;  // Save the path to the database
} else {
    $profile_pic = $user['profile_pic']; // Keep the existing picture if not updated
}

// Update user profile in the database
$update_sql = "UPDATE User_Profile SET age = ?, gender = ?, location = ?, medical_history = ?, profile_pic = ? WHERE user_id = ?";
$update_stmt = $conn->prepare($update_sql);

// Bind parameters: Add $user_id to match all placeholders in the query
$update_stmt->bind_param("sssssi", $age, $gender, $location, $medical_history, $profile_pic, $user_id);
$update_stmt->execute();



        // Flag to display success message
        $profileUpdated = true;

        // Refresh the page to display updated info
        header("Location: profile.php?updated=true");
        exit();
    }
} else {
    echo "User not logged in.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dashboard</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
      <!-- Include navbar from the external PHP file -->
      <?php include 'navbar.php'; ?>
      
    <main class="content">
        <header class="header">
            <h1>Profile Dashboard</h1>
            <div><p>Welcome to our Medi Sphere</p></div>
            <div class="user-info">
                <span>Hello, <?php echo htmlspecialchars($user['first_name']); ?></span>
                <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="User Profile Picture" width="100">
            </div>
        </header>

        <section class="profile-section">
        <div class="profile-card">
            <!-- Profile picture section -->
            <div class="profile-picture">
                <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="User Profile Picture" width="200">
            </div>
                <div class="profile-info">
                    <!-- Initial display -->
                    <p>Name: Dr.<span><?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?></span></p>
                    <p>Role: <span><?php echo htmlspecialchars($user['role']); ?></span></p>
                    <p>Email: <span><?php echo htmlspecialchars($user['email']); ?></span></p>
                    <button id="update-btn" class="edit-btn" onclick="showUpdateFields()">Update Profile</button>
                    
                    <!-- Hidden section for updating -->
                    <div id="update-section" style="display: none;">
                        <form action="profile.php" method="POST" enctype="multipart/form-data">
                            <p>Profile Picture: <input type="file" name="profile_pic" accept="image/*"></p>
                            <p>Age: <input type="number" name="age" value="<?php echo htmlspecialchars($user['age']); ?>"></p>
                            <p>Gender: <input type="text" name="gender" value="<?php echo htmlspecialchars($user['gender']); ?>"></p>
                            <p>Location: <input type="text" name="location" value="<?php echo htmlspecialchars($user['location']); ?>"></p>
                            <p>Medical History: <textarea name="medical_history"><?php echo htmlspecialchars($user['medical_history']); ?></textarea></p>
                            <input type="submit" value="Save Profile">
                        </form>
                    </div>

                    <!-- Section to display after saving -->
                    <div id="saved-info" style="display: none;">
                        <p>Age: <span id="age"><?php echo htmlspecialchars($user['age']); ?></span></p>
                        <p>Gender: <span id="gender"><?php echo htmlspecialchars($user['gender']); ?></span></p>
                        <p>Location: <span id="location"><?php echo htmlspecialchars($user['location']); ?></span></p>
                        <p>Medical History: <span id="medical_history"><?php echo htmlspecialchars($user['medical_history']); ?></span></p>
                        
                    </div>

                    <!-- Success message -->
                    <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true') : ?>
                        <div id="success-message" style="color: green; margin-top: 10px;">
                            Profile updated successfully!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <script>
            function showUpdateFields() {
                document.getElementById('update-section').style.display = 'block';
                document.getElementById('update-btn').style.display = 'none';
            }

            // This function displays the saved profile info and success message
            function showSavedInfo() {
                document.getElementById('saved-info').style.display = 'block';
                document.getElementById('success-message').style.display = 'block';
                document.getElementById('update-section').style.display = 'none';
                document.getElementById('update-btn').style.display = 'inline-block';

                // Triggering alert after saving
                alert('Profile updated successfully!');
            }

            // Show saved info if the form was submitted
            <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true') : ?>
                document.addEventListener('DOMContentLoaded', function() {
                    showSavedInfo();
                });
            <?php endif; ?>
        </script>
    </main>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
