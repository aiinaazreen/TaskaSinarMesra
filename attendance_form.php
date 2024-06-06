<?php
// Include the database connection file
require('../mysqli_connect.php'); // Adjust the path based on your file structure

// Initialize variables
$successMessage = $errorMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $employeeName = $_POST['employeeName'];
    $date = $_POST['date'];
    $timeIn = $_POST['timeIn'];
    $timeOut = $_POST['timeOut'];

    // Validate and process the form data as needed
    // For example, you can perform validation and database insertion here

    // For demonstration purposes, let's assume the data is inserted successfully
    $successMessage = "Attendance recorded successfully!";
} else {
    // Optional: You can provide default values for the form fields
    $employeeName = $date = $timeIn = $timeOut = '';
}

// Close the database connection (You might not need to close it here depending on your application flow)
$dbc->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Form</title>

    <!-- Include any necessary stylesheets or scripts -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px; /* Adjust this maximum width as needed */
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 4px;
        }

        .success-message {
            background-color: #4CAF50;
            color: #fff;
        }

        .error-message {
            background-color: #D00A0A;
            color: #fff;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #45a049;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .navbar {
            width: 100%;
            background-color: #333;
            padding: 10px 0;
            text-align: center;
            color: #fff;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="#">Home</a>
        <a href="dashboard_teacher.php">Dashboard</a>
        <!-- Add more links as needed -->
    </div>
    <div class="container">
        <h2>Attendance Form</h2>

        <!-- Display success or error messages -->
        <?php if ($successMessage): ?>
            <div class="message success-message"><?php echo $successMessage; ?></div>
        <?php elseif ($errorMessage): ?>
            <div class="message error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form action="attendance_functions.php" method="post">
            <label for="employeeName">Employee Name:</label>
            <input type="text" id="employeeName" name="employeeName" value="<?php echo htmlspecialchars($employeeName); ?>" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required>

            <label for="timeIn">Time In:</label>
            <input type="time" id="timeIn" name="timeIn" value="<?php echo htmlspecialchars($timeIn); ?>" required>

            <label for="timeOut">Time Out:</label>
            <input type="time" id="timeOut" name="timeOut" value="<?php echo htmlspecialchars($timeOut); ?>" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>
