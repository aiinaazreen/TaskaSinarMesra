<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .attendance-table {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .attendance-status {
            font-weight: bold;
        }

        .late {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Admin Dashboard</h1>
    <div class="attendance-table">
        <table>
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Attendance Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

        // Database connection settings
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "taska2023";

        // Create connection
        $dbc = mysqli_connect($servername, $username, $password, $dbname);

                // Fetch attendance records from the database
                $sql = "SELECT * FROM attendance";
                $result = mysqli_query($dbc, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Calculate attendance status based on timestamps (e.g., late, on time, present)
                        $attendanceStatus = calculateAttendanceStatus($row['time_in']);
                        echo "<tr>";
                        echo "<td>" . $row['employee_name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['time_in'] . "</td>";
                        echo "<td>" . $row['time_out'] . "</td>";
                        echo "<td class='attendance-status " . $attendanceStatus . "'>" . $attendanceStatus . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No attendance records found</td></tr>";
                }

                // Close the database connection
                mysqli_close($dbc);

                // Function to calculate attendance status
                function calculateAttendanceStatus($timeIn)
                {
                    // Get the hour part from the time
                    $hour = date('H', strtotime($timeIn));

                    // Check if the hour is greater than 10 (10:00 AM)
                    if ($hour > 10) {
                        return 'Late';
                    } else {
                        return 'On Time';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
