<?php
// Include the database connection file
require('../mysqli_connect.php'); // Adjust the path based on your file structure

// Check if the delete parameter is set
if (isset($_POST['delete'])) {
    $employeeId = $_POST['delete'];

    // Use prepared statement to prevent SQL injection
    $stmt = $dbc->prepare("DELETE FROM attendance WHERE id = ?");
    $stmt->bind_param("s", $employeeId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>

    <!-- Include any necessary stylesheets or scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        /* Your existing styles here */
    </style>
</head>

<body>
    <script>
        function redirectToAttendanceForm() {
            // Redirect to attendance_form.php
            window.location.href = 'attendance_form.php';
        }

        function editAttendance(employeeId) {
            // Implement your edit functionality here
            alert('Edit employee with ID ' + employeeId);
        }

        function deleteAttendance(employeeId) {
            // Show a confirmation dialog
            if (confirm("Are you sure you want to delete this record?")) {
                // Use AJAX to send a request to delete_attendance.php
                $.ajax({
                    type: "POST",
                    url: "delete_attendance.php",
                    data: { delete: employeeId },
                    success: function (response) {
                        // Update the UI based on the response
                        alert(response); // You can replace this with a more user-friendly notification
                        // Reload the page or update the table
                        location.reload(); // Reload the page to reflect the changes
                    },
                    error: function (error) {
                        console.error("Error deleting record: ", error);
                        // Handle error as needed
                    }
                });
            }
        }
    </script>

    <div class="container">
        <button class="add-btn" onclick="redirectToAttendanceForm()">Add</button>
        <h2>Attendance</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendanceData as $entry): ?>
                    <tr>
                        <td><?php echo $entry['id']; ?></td>
                        <td><?php echo $entry['name']; ?></td>
                        <td><?php echo $entry['date']; ?></td>
                        <td><?php echo $entry['status']; ?></td>
                        <td class="action-buttons">
                            <button class="edit-btn" onclick="editAttendance('<?php echo $entry['id']; ?>')">Edit</button>
                            <button class="delete-btn" onclick="deleteAttendance('<?php echo $entry['id']; ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        &copy; 2023 Tadika Sinar Mesra System. All rights reserved.
    </footer>
</body>

</html>
