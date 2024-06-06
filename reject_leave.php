<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taska2023";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' parameter is provided via GET request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update leave application status to 'rejected'
    $sql = "UPDATE leave_applications SET status = 'rejected' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Leave application rejected successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
