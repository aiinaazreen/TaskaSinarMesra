<?php
// Start the session
session_start();

// Destroy all session variables
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Logout</title>
</head>

<body>

<div class="container">
    <h1>You are now logged out (Admin)</h1>
    <p><a href="login_admin.php">Log in again</a></p>
</div>

</body>
</html>

<?php
// Redirect to the admin login page or any other page you prefer
// (Note: header() must be called before any actual output is sent)
header("refresh:3;url=login_admin.php"); // Redirect after 3 seconds, adjust as needed
exit();
?>
