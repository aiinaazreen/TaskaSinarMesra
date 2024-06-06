<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kindergarten Billing System - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 1000px;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .status {
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 12px;
            border-radius: 4px;
        }

        .verified {
            color: green;
            background-color: #d1f7d1;
        }

        .pending {
            color: orange;
            background-color: #fff3cd;
        }

        .no-data {
            font-style: italic;
            color: #888;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .verify-button {
            background-color: green;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .reject-button {
            background-color: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .verify-button:hover {
            background-color: darkgreen;
        }

        .reject-button:hover {
            background-color: darkred;
        }

        .navbar {
            width: 100%;
            background-color: #ca1a5e;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
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
<div class="container">
    <h1>Kindergarten Billing System - Admin Panel</h1>

    <!-- Navbar -->
    <div class="navbar">
        <a href="http://localhost/Taska2023/home.php">Home</a>
        <a href="http://localhost/Taska2023/dashboard_admin.php">Dashboard</a>
        <a href="http://localhost/Taska2023/admin_profile.php">Profile</a>
    </div>

    <h2>All Billing Records</h2>
    <table>
        <tr>
            <th>Parent Name</th>
            <th>Phone</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Document</th>
            <th>Action</th>
        </tr>
        <?php
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

        // Retrieve all billing records from the database
        $sql = "SELECT * FROM billing";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["parent_name"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["amount"] . "</td>";
                echo "<td>" . $row["payment_method"] . "</td>";
                echo "<td>" . $row["comment"] . "</td>";
                echo "<td class='status'>";
                // Display status based on the 'status' column value
                if ($row["status"] == "pending") {
                    echo "Pending";
                } elseif ($row["status"] == "verify") {
                    echo "Verified";
                } elseif ($row["status"] == "rejected") {
                    echo "Rejected";
                }
                echo "</td>";
                echo "<td>";
                // Display document link if available
                if ($row["document_path"]) {
                    echo "<a href='" . $row["document_path"] . "' target='_blank'>View Document</a>";
                } else {
                    echo "No document uploaded";
                }
                echo "</td>";
                echo "<td class='action-buttons'>";
                // Action buttons for verifying or rejecting the billing record
                echo "<a href='verify_admin.php?id=" . $row["id"] . "&action=verify' class='verify-button'>Verify</a>";
                echo "<a href='verify_admin.php?id=" . $row["id"] . "&action=reject' class='reject-button'>Reject</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='no-data'>No billing records found.</td></tr>";
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

</body>
</html>
