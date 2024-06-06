<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        /* Navbar styles */
        .navbar {
            background-color: #ca1a5e;
            display: flex;
            justify-content: center;
            padding: 10px;
            width: 100%;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #555;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ca1a5e;
            color: #fff;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Button styles */
        .approve-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .reject-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .approve-btn:hover,
        .reject-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="http://localhost/Taska2023/home.php">Home</a>
        <a href="http://localhost/Taska2023/dashboard_admin.php">Dashboard Admin</a>
        <a href="http://localhost/Taska2023/admin_profile.php">Profile</a>

    </div>

    <!-- Content Section -->
    <div class="content">
        <h2>Pending Leave Applications</h2>
        <table border="1">
            <tr>
                <th>Employee Number</th>
                <th>Employee Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Type of Leave</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
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

            // Retrieve and display pending leave applications
            $sql = "SELECT * FROM leave_applications WHERE status = 'pending'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['employeeNum'] . "</td>";
                    echo "<td>" . $row['employeeName'] . "</td>";
                    echo "<td>" . $row['startDate'] . "</td>";
                    echo "<td>" . $row['endDate'] . "</td>";
                    echo "<td>" . $row['leaveType'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>";
                    echo "<button class='approve-btn' onclick='approveLeave(" . $row['id'] . ")'>Approve</button>";
                    echo "<button class='reject-btn' onclick='rejectLeave(" . $row['id'] . ")'>Reject</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No pending leave applications.</td></tr>";
            }

            // Close database connection
            $conn->close();
            ?>
        </table>
    </div>

    <!-- Include SweetAlert library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // Function to handle approval
        function approveLeave(id) {
            swal({
                title: "Are you sure?",
                text: "Once approved, this action cannot be undone!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willApprove) => {
                if (willApprove) {
                    // AJAX request to update leave application status
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var response = xhr.responseText;
                            if (response.includes("successfully")) {
                                // If request is successful, show success message
                                swal("Success", response, "success");
                                // Update the status in the table without refreshing the page
                                document.getElementById("status_" + id).innerHTML = "approved";
                            } else {
                                // If request fails, show error message
                                swal("Error", response, "error");
                            }
                        }
                    };
                    xhr.open("GET", "approve_leave.php?id=" + id, true);
                    xhr.send();
                }
            });
        }

        // Function to handle rejection
        function rejectLeave(id) {
            swal({
                title: "Are you sure?",
                text: "Once reject, this action cannot be undone!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willApprove) => {
                if (willApprove) {
                    // AJAX request to update leave application status
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var response = xhr.responseText;
                            if (response.includes("successfully")) {
                                // If request is successful, show success message
                                swal("Success", response, "success");
                                // Update the status in the table without refreshing the page
                                document.getElementById("status_" + id).innerHTML = "approved";
                            } else {
                                // If request fails, show error message
                                swal("Error", response, "error");
                            }
                        }
                    };
                    xhr.open("GET", "reject_leave.php?id=" + id, true);
                    xhr.send();
                }
            });
        }
    </script>
</body>

</html>
