<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Leave</title>
</head>

<body>
    <h2>Apply for Leave</h2>
    <form action="process_leave.php" method="post">
        <label for="employeeNum">Employee Number:</label>
        <input type="text" id="employeeNum" name="employeeNum" required><br><br>
        <label for="employeeName">Employee Name:</label>
        <input type="text" id="employeeName" name="employeeName" required><br><br>
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" required><br><br>
        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" required><br><br>
        <label for="leaveType">Type of Leave:</label>
        <select id="leaveType" name="leaveType" required>
            <option value="" disabled selected>Select leave type</option>
            <option value="Annual">Annual Leave</option>
            <option value="Sick">Sick Leave</option>
            <option value="Personal">Personal Leave</option>
        </select><br><br>
        <button type="submit">Submit Leave Application</button>
    </form>
</body>

</html>
