<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Leave</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            margin: 0;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
        }

        .leave-form-container {
            max-width: 500px;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        select {
            height: 40px;
            /* Match input height */
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="dashboard_teacher.php">Dashboard</a>
        <a href="teacher_profile.php">Profile</a>
    </div>

    <div class="leave-form-container">
        <h2>Apply for Leave</h2>
        <form id="leaveForm" action="process_leave.php" method="post">
            <label for="employeeNum">Employee Number:</label>
            <input type="text" id="employeeNum" name="employeeNum" required>
            <label for="employeeName">Employee Name:</label>
            <input type="text" id="employeeName" name="employeeName" required>
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required>
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required>
            <label for="leaveType">Type of Leave:</label>
            <select id="leaveType" name="leaveType" required>
                <option value="" disabled selected>Select leave type</option>
                <option value="Annual">Annual Leave</option>
                <option value="Sick">Sick Leave</option>
                <option value="Maternity">Maternity Leave</option>
                <option value="Unpaid">Unpaid Leave</option>
                <option value="Other">Other</option>
            </select>
            <button type="button" onclick="submitForm()">Submit Leave Application</button>
        </form>
    </div>

    <script>
        function submitForm() {
            // Perform form validation if needed
            // Example: Check if required fields are filled

            // Submit the form using AJAX
            var form = document.getElementById('leaveForm');
            var formData = new FormData(form);

            // Send form data to process_leave.php using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'process_leave.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert("Leave application submitted successfully.");
                    // Redirect to dashboard or homepage
                    window.location.href = "http://localhost/Taska2023/dashboard_teacher.php"; // Change to appropriate URL
                } else {
                    alert('Error occurred while submitting leave application.');
                }
            };
            xhr.send(formData);
        }
    </script>
</body>

</html>
