<?php
// Start the session if not already started
session_start();

// Include the database connection file
require('../mysqli_connect.php'); // Connect to the db.

// Initialize error message and success message variables
$error_message = '';
$success_message = '';

// Check if the token is provided in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the submitted form data
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate the input data
        if (empty($password) || empty($confirm_password)) {
            $error_message = "All fields are required!";
        } elseif ($password !== $confirm_password) {
            $error_message = "Passwords do not match!";
        } else {
            // Prepare the SQL statement to prevent SQL injection
            $sql = "SELECT * FROM admin WHERE reset_token = ? AND token_expiration > NOW() LIMIT 1"; // Limit 1 because token should be unique
            $stmt = mysqli_prepare($dbc, $sql);
            
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "s", $token);
            
            // Execute the prepared statement
            mysqli_stmt_execute($stmt);
            
            // Store the result
            $result = mysqli_stmt_get_result($stmt);

            // Check if there is a match for the token
            if (mysqli_num_rows($result) == 1) {
                // Hash the new password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Update the password in the database
                $sql = "UPDATE admin SET password = ?, reset_token = NULL, token_expiration = NULL WHERE reset_token = ?";
                $stmt = mysqli_prepare($dbc, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $token);
                if (mysqli_stmt_execute($stmt)) {
                    $success_message = "Your password has been successfully reset. You can now <a href='login_admin.php'>login</a>.";
                } else {
                    $error_message = "Failed to reset the password. Please try again.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                $error_message = "Invalid or expired token.";
            }
        }
    }
} else {
    $error_message = "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #2ecc71;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }

        p {
            text-align: center;
            color: #333;
        }

        a {
            color: #2ecc71;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            color: #e74c3c;
        }

        .success {
            color: #2ecc71;
        }
    </style>
</head>
<body>
    <form id="reset_password" action="" method="post">
        <h2>Reset Password</h2>

        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" value="Reset Password">
        <?php
        if (!empty($error_message)) {
            echo '<p class="message">' . $error_message . '</p>';
        } elseif (!empty($success_message)) {
            echo '<p class="message success">' . $success_message . '</p>';
        }
        ?>
    </form>
</body>
</html>
