<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taska2023";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch student data from the database
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

// Check if there are any students in the database
if ($result && mysqli_num_rows($result) > 0) {
    echo "<div class='container'>";
    echo "<h2>Registered Students</h2>";
    echo "<ul>";

    // Output each student's data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>Name: " . $row['studentName'] . ", Age: " . $row['studentAge'] . "</li>";
    }

    echo "</ul>";
    echo "</div>";
} else {
    echo "No students found.";
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Registered Students</h2>
    </div>
</body>

</html>
