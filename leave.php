<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .navbar {
            background-color: #ca1a5e;
            overflow: hidden;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .navbar li {
            float: left;
        }

        .navbar li a {
        display: list-item;
        color: white;
        text-align: center; /* Center the text */
        padding: 9px 20px; /* Adjusted padding */
        text-decoration: none;
}

        .navbar li a:hover {
            background-color: #ddd;
            color: #ca1a5e;
}
        /* Dropdown styles */
        .dropdown {
            display: flex;
        }

        .dropdown-content {
            display: flex;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            display: flex;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ca1a5e;
            color: #fff;
        }

        .footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #ca1a5e;
            width: 100%;
            color: #fff;
            text-align: center;
        }

        .month-filter {
            margin-top: 20px;
        }

        #leaveTable {
            margin-top: 20px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
        }

        .approve-btn {
            background-color: #22A734; /* Green color for the "Approve" button */
            color: #fff;
            border: none;
            padding: 8px 12px;
            margin: 0 5px;
            cursor: pointer;
            border-radius: 4px;
        }

        .reject-btn {
            background-color: #ED0A07;
            color: #fff;
            border: none;
            padding: 8px 12px;
            margin: 0 5px;
            cursor: pointer;
            border-radius: 4px;
        }

        .approve-btn:hover {
            background-color: #128E2C; /* Darker green on hover */
        }

        .reject-btn:hover {
            background-color: #E70E0B;
        }

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

    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="http://localhost/Taska2023/home.php">Home</a>
        <a href="http://localhost/Taska2023/admin_profile.php">Profile</a>

    </div>


    <!-- Month Filter -->
    <div class="container">
        <div class="month-filter">
            <label for="month">Select Month:</label>
            <select id="month" name="month">
                <option value="all">All</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
                <!-- Add more months as needed -->
            </select>
            <button id="filterBtn">Filter</button>
        </div>

        <!-- Table for Leave details -->
        <div class="leave-actions">
            <table id="leaveTable">
                <thead>
                    <tr>
                        <th>Employee Number</th>
                        <th>Employee Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Duration Leave</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Leave details will be dynamically added here -->
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        &copy; 2023 Tadika Sinar Mesra System. All rights reserved.
    </footer>

    <!-- Include your scripts at the end of the body or in a separate file -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            var sampleData = [
                { empNumber: "001", empName: "John Doe", startDate: "2024-01-10", endDate: "2024-01-15", duration: "6 days", status: "Pending" },
                { empNumber: "002", empName: "Joyah", startDate: "2024-01-28", endDate: "2024-02-21", duration: "15 days", status: "Pending" },
                { empNumber: "003", empName: "Aina", startDate: "2024-02-28", endDate: "2024-02-31", duration: "6 days", status: "Pending" },
                // Add more rows as needed
            ];

            function populateTable(data) {
                $("#leaveTable tbody").empty(); // Clear existing rows
                $.each(data, function (index, item) {
                    var approveButton = '<button class="approve-btn" data-index="' + index + '">Approve</button>';
                    var rejectButton = '<button class="reject-btn" data-index="' + index + '">Reject</button>';
                    $("#leaveTable tbody").append("<tr><td>" + item.empNumber + "</td><td>" + item.empName + "</td><td>" + item.startDate + "</td><td>" + item.endDate + "</td><td>" + item.duration + "</td><td>" + item.status + "</td><td class='action-buttons'>" + approveButton + " " + rejectButton + "</td></tr>");
                });
            }

            // Initial data population
            populateTable(sampleData);

            // Attach click events for approve and reject buttons
            $(".approve-btn").click(function () {
                var isConfirmed = confirm('Are you sure you want to approve this leave?');
                if (isConfirmed) {
                    var index = $(this).data("index");
                    alert("Approve button clicked for index " + index);
                }
            });

            $(".reject-btn").click(function () {
                window.location.href = "leave_management.php";
            });

            // Filter data based on selected month
            $("#filterBtn").click(function () {
                var selectedMonth = $("#month").val();
                var filteredData;

                if (selectedMonth === 'all') {
                    filteredData = sampleData;
                } else {
                    filteredData = sampleData.filter(function (item) {
                        return item.startDate.startsWith("2024-" + selectedMonth);
                    });
                }

                populateTable(filteredData);
            });
        });
    </script>
</body>

</html>