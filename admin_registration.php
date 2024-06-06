<?php
require('../mysqli_connect.php'); // Connect to the db.

$page_title = 'Admin Registration';

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    // Check for a first name:
    if (empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $fn = trim($_POST['first_name']);
    }

    // Check for a username:
    if (empty($_POST['username'])) {
        $errors[] = 'You forgot to enter your username.';
    } else {
        $username = trim($_POST['username']);
    }

    // Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = trim($_POST['email']);
    }

    // Check for a password and match against the confirmed password:
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Your password did not match the confirmed password.';
        } else {
            $p = trim($_POST['pass1']);
        }
    } else {
        $errors[] = 'You forgot to enter your password.';
    }

    if (empty($errors)) { // If everything's OK.

        // Check if the username or email already exists:
        $check_query = "SELECT admin_id FROM admin WHERE username = '$username' OR email = '$e'";
        $check_result = @mysqli_query($dbc, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // If a user with the same username or email already exists, show an error message.
            echo '<h1>Error!</h1>
                <p class="error">A user with the same username or email already exists. Please choose a different username or email.</p>';
        } else {
            // Hash the password using the password_hash function:
            $hashed_password = password_hash($p, PASSWORD_DEFAULT);

            // Make the query:
            $insert_query = "INSERT INTO admin (first_name, username, email, password, registration_date) 
                  VALUES ('$fn', '$username', '$e', '$hashed_password', NOW() )";
            $insert_result = @mysqli_query($dbc, $insert_query); // Run the query.

            if ($insert_result) { // If it ran OK.
                // Redirect to dashboard_admin.php or any other desired page
                header("Location: login_admin.php");
                exit();
            } else { // If it did not run OK.
                // Public message:
                echo '<h1>System Error</h1>
                    <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
                // Debugging message:
                echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $insert_query . '</p>';
            }

            mysqli_close($dbc); // Close the database connection.
        }
    } else { // Report the errors.
        // Display error messages to the user...
        echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
</head>
<body>
    <style> 
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>

    <div class="container">
        <h1>Admin Register</h1>
        <form id="register" action="admin_registration.php" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" maxlength="20" required
                value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">

            <label for="username">Username:</label>
            <input type="text" name="username" id="username" maxlength="60" required
                value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" maxlength="60" required
                value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">

            <label for="pass1">Password:</label>
            <input type="password" name="pass1" id="pass1" maxlength="60" required>

            <label for="pass2">Confirm Password:</label>
            <input type="password" name="pass2" id="pass2" maxlength="20" required>

            <button type="submit" name="submit" value="register">Register</button>

            <p>Already have an account? <a href="login_admin.php">Log In</a></p>
        </form>
    </div>
</body>
</html>
