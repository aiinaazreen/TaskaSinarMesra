<?php

$page_title = 'Registration';

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    // Check for a first name:
    if (empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $fn = trim($_POST['first_name']);
    }

    // Check for a last name:
    if (empty($_POST['last_name'])) {
        $errors[] = 'You forgot to enter your last name.';
    } else {
        $ln = trim($_POST['last_name']);
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

        // Register the user in the database...
        require('../mysqli_connect.php'); // Connect to the db.

        // Hash the password using the password_hash function:
        $hashed_password = password_hash($p, PASSWORD_DEFAULT);

        // Make the query:
        $q = "INSERT INTO users (first_name, last_name, username, email, password, registration_date) 
              VALUES ('$fn', '$ln', '$username', '$e', '$hashed_password', NOW() )";
        $r = @mysqli_query($dbc, $q); // Run the query.

        if ($r) { // If it ran OK.
            // Print a message:
            echo '<h1>Thank you!</h1>
            <p>You are now registered.</p><p><br /></p>';
        } else { // If it did not run OK.
            // Public message:
            echo '<h1>System Error</h1>
                <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
        }

        mysqli_close($dbc); // Close the database connection.

        // Include the footer and quit the script:
        include('include/footer.html');
        exit();
    } else { // Report the errors.
        echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
    } // End of if (empty($errors)) IF.

} // End of the main Submit conditional.

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
</head>
<body>

    <div class="container">
        <h1>Register</h1>
        <form id="register" action="registration.php" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" maxlength="20" required
                value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" maxlength="40" required
                value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">

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

            <p>Already have an account? <a href="login.php">Log in</a></p>
        </form>
    </div>

</body>
</html>
