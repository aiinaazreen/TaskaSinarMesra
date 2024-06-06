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

        .navbar {
            background-color: #ca1a5e;
            overflow: hidden;
            text-align: center;
        }

        .navbar a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #e52e77;
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

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ca1a5e;
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

        .on-time {
            color: green;
        }

        .search-container {
            margin-top: 20px;
            text-align: center;
        }

        .search-container input[type=text] {
            padding: 10px;
            margin: 5px;
            width: 30%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-container button {
            padding: 10px 20px;
            background-color: #ca1a5e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #e52e77;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="home.php">Logout</a>
    </div>
    <h1>Admin Dashboard</h1>
        <div class="search-container">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for employee names..">
    </div>
    <div class="attendance-table">
        <table id="attendanceTable">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Date</th>
                    <th>Time In</th>
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
                        echo "<td class='attendance-status ";
                        if ($attendanceStatus == 'Late') {
                            echo "late";
                        } else {
                            echo "on-time";
                        }
                        echo "'>" . $attendanceStatus . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No attendance records found</td></tr>";
                }

                // Close the database connection
                mysqli_close($dbc);

                function calculateAttendanceStatus($timeIn)
                {
                    // Get the hour part from the time
                    $hour = date('H', strtotime($timeIn));
                    // Get the minute part from the time
                    $minute = date('i', strtotime($timeIn));

                    // Check if the hour is greater than 10 (10:00 AM) or if it's exactly 10:00 AM
                    if ($hour > 10 || ($hour == 10 && $minute > 0)) {
                        return 'Late';
                    } else {
                        return 'On Time';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("attendanceTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>
