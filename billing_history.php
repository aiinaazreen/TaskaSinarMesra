<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
        }

        .content {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-container input {
            padding: 10px;
            width: 80%;
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .document-link {
            color: blue;
            text-decoration: none;
        }

        .document-link:hover {
            text-decoration: underline;
        }

        .status-approved {
            color: green;
        }

        .status-rejected {
            color: red;
        }

        .status-pending {
            color: orange;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="dashboard_parent.php">Dashboard</a>
        <a href="profile_parents.php">Profile</a>
    </div>

    <!-- Content Section -->
    <div class="content">
        <h2>Finance History</h2>
        <!-- Search container -->
        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search for parent names..">
        </div>
        <!-- Finance history table -->
        <table id="financeTable">
            <tr>
                <th>Parent Name</th>
                <th>Phone</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Document</th>
            </tr>
            <!-- PHP code to fetch and display finance history -->
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

            // Retrieve finance history with status verify or rejected
            $sql = "SELECT * FROM billing WHERE status IN ('verify', 'rejected')";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Determine status class based on status value
                    $statusClass = '';
                    switch ($row['status']) {
                        case 'verify':
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
                    echo "<td>" . $row['parent_name'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "<td>" . $row['payment_method'] . "</td>";
                    echo "<td>" . $row['comment'] . "</td>";
                    echo "<td class='" . $statusClass . "'>" . $row['status'] . "</td>";
                    echo "<td>";
                    // Display document link if available
                    if ($row["document_path"]) {
                        echo "<a href='" . $row["document_path"] . "' class='document-link' target='_blank'>View Document</a>";
                    } else {
                        echo "No document uploaded";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No finance history found.</td></tr>";
            }
            // Close database connection
            $conn->close();
            ?>
        </table>
    </div>

    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("financeTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</htm