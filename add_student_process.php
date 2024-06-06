<?php
// Retrieve form data
$studentName = $_POST['studentName'];
$studentAge = $_POST['studentAge'];
$parentName = $_POST['parentName'];
$phoneNumber = $_POST['phoneNumber'];
$emergencyNumber = $_POST['emergencyNumber'];
$email = $_POST['email'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$dateOfBirth = $_POST['dateOfBirth'];
$notes = $_POST['notes'];

// Connect to the database (replace dbname, username, password with your actual database credentials)
$mysqli = new mysqli("localhost", "root", "", "taska2023");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare SQL statement to insert data into the students table
$sql = "INSERT INTO students (studentName, studentAge, parentName, phoneNumber, emergencyNumber, email, address, gender, dateOfBirth, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sissssssss", $studentName, $studentAge, $parentName, $phoneNumber, $emergencyNumber, $email, $address, $gender, $dateOfBirth, $notes);

// Execute the statement
$stmt->execute();

// Close statement and database connection
$stmt->close();
$mysqli->close();

// Redirect to view_students.php
header("Location: view_students.php");
exit();
?>
