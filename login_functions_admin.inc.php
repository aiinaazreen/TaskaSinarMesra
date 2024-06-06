<?php

// Function to check admin login credentials
function check_login_admin($dbc, $email, $password) {
    $errors = array(); // Initialize an error array.

    // Validate and sanitize the user input
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($dbc, "SELECT admin_id, first_name FROM admins WHERE email=? AND password=SHA1(?)");

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Store the result
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 1) { // Successful login!
        // Fetch the user data:
        $data = array();
        mysqli_stmt_bind_result($stmt, $data['admin_id'], $data['first_name']);
        mysqli_stmt_fetch($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);

        // Return the user data
        return array(true, $data);
    } else { // Unsuccessful login!
        // Return an error message
        return array(false, 'Invalid email address or password. Please try again.');
    }
}

// Function to redirect the admin user
function redirect_admin($page) {
    // Redirect to the specified page:
    header('Location: home.php ' . $page);
    exit();
}
