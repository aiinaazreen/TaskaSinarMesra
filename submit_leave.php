<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $teacherName = $_POST['teacherName'];
    $leaveType = $_POST['leaveType'];
    $leaveDate = $_POST['leaveDate'];

// Include the database connection file
require('../mysqli_connect.php'); // Adjust the path based on your file structure

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert the leave application data into a table
    $sql = "INSERT INTO leave_applications (teacher_name, leave_type, leave_date) 
            VALUES ('$teacherName', '$leaveType', '$leaveDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Leave application submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
