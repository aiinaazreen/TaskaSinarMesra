<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Leave Application</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="leave.php" method="post" class="leave-form">
        <h2>Teacher Leave Application Form</h2>

        <!-- Personal Information -->
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required>

        <label for="employeeID">Employee ID:</label>
        <input type="text" id="employeeID" name="employeeID" required>

        <label for="department">Department/Subject:</label>
        <input type="text" id="department" name="department" required>

        <!-- Leave Details -->
        <label for="startDate">Leave Start Date:</label>
        <input type="date" id="startDate" name="startDate" required>

        <label for="endDate">Leave End Date:</label>
        <input type="date" id="endDate" name="endDate" required>

        <label for="leaveType">Type of Leave:</label>
        <select id="leaveType" name="leaveType" required>
            <option value="sick">Sick Leave</option>
            <option value="personal">Personal Leave</option>
            <!-- Add more options as needed -->
        </select>

        <label for="reason">Reason for Leave:</label>
        <textarea id="reason" name="reason" rows="4" required></textarea>

        <!-- Contact Information -->
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>

        <!-- Submit Button -->
        <button type="submit">Submit</button>
    </form>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.leave-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
}

label {
    display: block;
    margin-bottom: 8px;
}

input, select, textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%; /* Make the button full width */
}

button:hover {
    background-color: #45a049;
}

/* Responsive Styles */
@media screen and (max-width: 600px) {
    .leave-form {
        max-width: 100%;
    }
}

<style>


</body>
</html>
  