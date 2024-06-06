<?php
// Include the database connection file
require('../mysqli_connect.php'); // Adjust the path based on your file structure

// Initialize variables for form submission feedback
$successMessage = $errorMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $employeeName = $_POST['employeeName'];
    $date = $_POST['date'];
    $timeIn = $_POST['timeIn'];
    $timeOut = $_POST['timeOut'];

    // Use prepared statement to prevent SQL injection
    $stmt = $dbc->prepare("INSERT INTO attendance(employee_name, date, time_in, time_out) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $employeeName, $date, $timeIn, $timeOut);

    // Execute the statement
    if ($stmt->execute()) {
        $successMessage = "Record inserted successfully";

        // Use SweetAlert2 for a more appealing notification
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Your attendance has been recorded successfully.",
                });
             </script>';
    } else {
        $errorMessage = "Error inserting record: " . $stmt->error;
        error_log($errorMessage); // Log the error for debugging

        // Use SweetAlert2 for error notification
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "' . $errorMessage . '",
                });
             </script>';
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$dbc->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your meta tags and stylesheets here -->
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="top-bar">
        <a href="" class="back-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="container">
        <h2>Attendance Response</h2>

        <?php if (!empty($successMessage)) : ?>
            <div class="alert alert-success">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($errorMessage)) : ?>
            <div class="alert alert-error">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
