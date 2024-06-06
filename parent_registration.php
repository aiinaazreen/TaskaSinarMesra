<link rel="stylesheet" href="styles.css">
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$page_title = 'Parent Registration';

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); // Initialize an error array.

    // Check for a name:
    if (empty($_POST['name'])) {
        $errors[] = 'You forgot to enter your name.';
    } else {
        $name = trim($_POST['name']);
    }

    // Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = trim($_POST['email']);
    }

    // Check for a password and match against the confirmed password:
    if (!empty($_POST['password'])) {
        if ($_POST['password'] != $_POST['confirm_password']) {
            $errors[] = 'Your password did not match the confirmed password.';
        } else {
            $p = trim($_POST['password']);
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
$q = "INSERT INTO parent (name, email, password, registration_date) 
      VALUES ('$name', '$e', '$hashed_password', NOW() )";
        $r = mysqli_query($dbc, $q); // Run the query.

if ($r) { // If it ran OK.
    // Redirect to login_teacher.php
    header("Location: login_parent.php");
    exit();
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
    <link rel="stylesheet" href="style.css">
    <title>Parent Registration</title>
</head>

<body>
    <div class="container">
        <h1>Parent Registration</h1>
        <form id="register" action="parent_registration.php" method="post">
            <!-- Use htmlspecialchars to prevent XSS attacks -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Register</button>

            <p>Already have an account? <a href="login_parent.php">Log in</a></p>
        </form>
    </div>
</body>

</html>
