<?php
// Include the database connection file
require('../mysqli_connect.php'); // Adjust the path based on your file structure

// Create a connection
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Could not connect to MySQL: ' . mysqli_connect_error());


// Add these lines to print out form data for debugging
echo "Employee Name: " . $employeeName . "<br>";
echo "Date: " . $date . "<br>";
echo "Time In: " . $timeIn . "<br>";
echo "Time Out: " . $timeOut . "<br>";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $employeeName = $_POST['employeeName'];
    $date = $_POST['date'];
    $timeIn = $_POST['timeIn'];
    $timeOut = $_POST['timeOut'];

    // Use prepared statement to prevent SQL injection
    $stmt = $dbc->prepare("INSERT INTO attendance (employee_name, date, time_in, time_out) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $employeeName, $date, $timeIn, $timeOut);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
// Close the database connection
$dbc->close();
?>
