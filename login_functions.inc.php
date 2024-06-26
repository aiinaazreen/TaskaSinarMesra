<?php
// This page defines two functions used by the login/logout process.

/* This function determines an absolute URL and redirects the user there.
 * The function takes one argument: the page to be redirected to.
 * The argument defaults to index.php.
 */
function redirect_user($page = 'Home.php') {
    // Start defining the URL...
    // URL is http:// plus the host name plus the current directory:
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

    // Remove any trailing slashes:
    $url = rtrim($url, '/\\');

    // Add the page:
    $url .= '/' . $page;

    // Redirect the user:
    header("Location: $url");
    exit(); // Quit the script.
}

/* This function validates the form data (the email address and password).
 * If both are present, the database is queried.
 * The function requires a database connection.
 * The function returns an array of information, including:
 * - a TRUE/FALSE variable indicating success
 * - an array of either errors or the database result
 */
function check_login_user($dbc, $email = '', $pass = '') {
    $errors = array(); // Initialize error array.

    // Validate the email address:
    if (empty($email)) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = mysqli_real_escape_string($dbc, trim($email));
    }

    // Validate the password:
    if (empty($pass)) {
        $errors[] = 'You forgot to enter your password.';
    } else {
        $p = mysqli_real_escape_string($dbc, trim($pass));
    }

    if (empty($errors)) { // If everything's OK.

        // Retrieve the user_id and first_name for that email/password combination:
        $q = "SELECT user_id, first_name FROM users WHERE email='$e' AND password=SHA1('$p')";
        $r = @mysqli_query($dbc, $q); // Run the query.

        // Check the result:
        if (mysqli_num_rows($r) == 1) {

            // Fetch the record:
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

            // Return true and the record:
            return array(true, $row);

        } else { // Not a match!
            $errors[] = 'The email address and password entered do not match those on file.';
        }
    } // End of empty($errors) IF.

    // Return false and the errors:
    return array(false, $errors);
}

// Function to check admin login credentials
function check_login_admin($dbc, $email, $password) {
    // ... (Your existing admin login function code goes here)
}

// Function to redirect the admin user
function redirect_admin($page) {
    // ... (Your existing admin redirection function code goes here)
}
