<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taska2023";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeNum = $_POST['employeeNum'];
    $employeeName = $_POST['employeeName'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $leaveType = $_POST['leaveType'];

    // Prepare and execute SQL statement to insert leave application into database
    $sql = "INSERT INTO leave_applications (employeeNum, employeeName, startDate, endDate, leaveType)
            VALUES ('$employeeNum', '$employeeName', '$startDate', '$endDate', '$leaveType')";

    if ($conn->query($sql) === TRUE) {
        // Success response will be handled by JavaScript
        http_response_code(200); // Set HTTP status code to 200
    } else {
        // Error response will be handled by JavaScript
        http_response_code(500); // Set HTTP status code to 500 (Internal Server Error)
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Assuming teacher_id is retrieved from session or form data
$teacherId = 1; // Example: Change this to the actual teacher_id

// Deduct leave days (e.g., deduct 1 day for annual leave)
$leaveType = $_POST['leaveType'];
if ($leaveType == 'Annual') {
    // Assuming leave days are deducted based on leave type
    $daysToDeduct = 1; // Deduct 1 day for annual leave
    
    // Update remaining_leave_days in the database
    $sqlUpdateLeaveDays = "UPDATE teacher_leave_balance SET remaining_leave_days = remaining_leave_days - $daysToDeduct WHERE teacher_id = $teacherId";
    $conn->query($sqlUpdateLeaveDays);
}
// Close database connection
$conn->close();
?>
