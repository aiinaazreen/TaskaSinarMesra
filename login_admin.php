<?php
// Start the session if not already started
session_start();

// Include the database connection file
require('../mysqli_connect.php'); // Connect to the db.
include('login_admin.html');

// Initialize error message variable
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the submitted form data
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Validate the input data (you might want to add more validation)
    if (empty($username) || empty($password)) {
        $error_message = "Username and password are required!";
    } else {
        // Prepare the SQL statement to prevent SQL injection
        $sql = "SELECT * FROM admin WHERE email = ? LIMIT 1"; // Limit 1 because username should be unique
        $stmt = mysqli_prepare($dbc, $sql);
        
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "s", $username);
        
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        
        // Store the result
        $result = mysqli_stmt_get_result($stmt);

        // Check if there is a match for the username
        if (mysqli_num_rows($result) == 1) {
            // Fetch the row
            $row = mysqli_fetch_assoc($result);
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Redirect to the admin dashboard
                header("Location: dashboard_admin.php");
                exit();
            } else {
                // Incorrect password
                $error_message = "Incorrect password";
            }
        } else {
            // Incorrect username
            $error_message = "Incorrect username";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <form id="login" action="" method="post"> <!-- Update action to stay on the same page -->
        <h2>Admin Login</h2>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
        <p><?php echo $error_message; ?></p>
        <p>Don't have an account? <a href="admin_registration.php">Register</a></p>
    </form>
</body>
</html>
