<?php
// Start the session if not already started
session_start();

// Include the database connection file
require('../mysqli_connect.php'); // Connect to the db.

// Initialize error message and success message variables
$error_message = '';
$success_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the submitted form data
    $email = $_POST['email'];

    // Validate the input data (you might want to add more validation)
    if (empty($email)) {
        $error_message = "Email is required!";
    } else {
        // Prepare the SQL statement to prevent SQL injection
        $sql = "SELECT * FROM admin WHERE email = ? LIMIT 1"; // Limit 1 because email should be unique
        $stmt = mysqli_prepare($dbc, $sql);
        
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "s", $email);
        
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        
        // Store the result
        $result = mysqli_stmt_get_result($stmt);

        // Check if there is a match for the email
        if (mysqli_num_rows($result) == 1) {
            // Generate a unique password reset token
            $token = bin2hex(random_bytes(50));
            // Set token expiration date (e.g., 1 hour from now)
            $token_expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            // Insert the reset token into the database
            $sql = "UPDATE admin SET reset_token = ?, token_expiration = ? WHERE email = ?";
            $stmt = mysqli_prepare($dbc, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $token, $token_expiration, $email);
            mysqli_stmt_execute($stmt);

            // Prepare the password reset link
            $reset_link = "http://yourdomain.com/reset_password.php?token=" . $token;

            // Send the password reset link to the user's email
            $to = $email;
            $subject = "Password Reset Request";
            $message = "Click the link below to reset your password:\n\n" . $reset_link;
            $headers = "From: noreply@yourdomain.com";

            if (mail($to, $subject, $message, $headers)) {
                $success_message = "A password reset link has been sent to your email address.";
            } else {
                $error_message = "Failed to send the password reset email.";
            }
        } else {
            // Email not found
            $error_message = "No account found with that email address.";
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
    <title>Forgot Password</title>
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

        input[type="email"] {
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
    <form id="forgot_password" action="" method="post">
        <h2>Forgot Password</h2>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Submit">
        <?php
        if (!empty($error_message)) {
            echo '<p class="message">' . $error_message . '</p>';
        } elseif (!empty($success_message)) {
            echo '<p class="message success">' . $success_message . '</p>';
        }
        ?>
        <p>Remembered your password? <a href="login_admin.php">Login</a></p>
    </form>
</body>
</html>
