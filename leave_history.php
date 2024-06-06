<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave History</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        padding: 20px;
    }

    /* Navbar styles */
    .navbar {
        background-color: #ca1a5e; /* Changed color */
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

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #ca1a5e; /* Changed color */
        color: #fff;
        text-transform: uppercase;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    a {
        text-decoration: none;
        color: #ca1a5e; /* Changed color */
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Define status background colors */
    .status-approved {
        background-color: green;
        color: #fff;
    }

    .status-rejected {
        background-color: red;
        color: #fff;
    }

    .status-pending {
        background-color: yellow;
        color: #333; /* Adjust text color for visibility */
    }
</style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="http://localhost/Taska2023/home.php">Home</a>
        <a href="http://localhost/Taska2023/dashboard_admin.php">Dashboard</a>
        <a href="http://localhost/Taska2023/admin_profile.php">Profile</a>
    </div>

    <!-- Content Section -->
    <div class="content">
        <h2>Leave History</h2>
        <table border="1">
            <tr>
                <th>Employee Number</th>
                <th>Employee Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Type of Leave</th>
                <th>Status</th>
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

            // Retrieve all leave applications
            $sql = "SELECT * FROM leave_applications";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Determine status class based on status value
                    $statusClass = '';
                    switch ($row['status']) {
                        case 'approved':
                            $statusClass = 'status-approved';
                            break;
                        case 'rejected':
                            $statusClass = 'status-rejected';
                            break;
                        case 'pending':
                            $statusClass = 'status-pending';
                            break;
                        default:
                            $statusClass = '';
                    }

                    echo "<tr>";
                    echo "<td>" . $row['employeeNum'] . "</td>";
                    echo "<td>" . $row['employeeName'] . "</td>";
                    echo "<td>" . $row['startDate'] . "</td>";
                    echo "<td>" . $row['endDate'] . "</td>";
                    echo "<td>" . $row['leaveType'] . "</td>";
                    echo "<td class='" . $statusClass . "'>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No leave applications found.</td></tr>";
            }

            // Close database connection
            $conn->close();
            ?>
        </table>
    </div>

</body>

</html>
