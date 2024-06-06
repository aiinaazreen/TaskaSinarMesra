<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <!-- Include Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            display: flex;
            justify-content: space-around;
            background-color: #444;
            padding: 10px 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
        }

        .navbar a:hover {
            background-color: #555;
        }

        /* Style for the action-box container */
        .action-box {
            max-width: 500px;
            margin: 50px auto; /* Center the form with some margin from the top */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        /* Style for the action-form */
        .action-form {
            margin-bottom: 20px;
        }

        /* Style for form labels */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        /* Style for form input fields and textarea */
        input[type="text"],
        input[type="number"],
        input[type="tel"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Ensures padding and border are included in the width */
            margin-bottom: 10px;
        }

        /* Style for submit button */
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Optional: Style for form headings */
        h3 {
            margin-bottom: 15px;
            color: #333;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="http://localhost/Taska2023/home.php">Home</a>
        <a href="http://localhost/Taska2023/dashboard_teacher.php">Dashboard</a>
    </div>

    <div class="action-box">
        <div class="action-form">
            <form action="add_student_process.php" method="post">
                <h3>Add Student</h3>

                <label for="studentName">Name:</label>
                <input type="text" id="studentName" name="studentName" required>

                <label for="studentAge">Age:</label>
                <input type="number" id="studentAge" name="studentAge" required>

                <label for="parentName">Parent's Name:</label>
                <input type="text" id="parentName" name="parentName" required>

                <label for="phoneNumber">Phone Number:</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" required>

                <label for="emergencyNumber">Emergency Number:</label>
                <input type="tel" id="emergencyNumber" name="emergencyNumber" required>

                <!-- Optional fields -->
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email">

                <label for="address">Address:</label>
                <textarea id="address" name="address"></textarea>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>

                <label for="dateOfBirth">Date of Birth:</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth">

                <label for="notes">Additional Notes:</label>
                <textarea id="notes" name="notes"></textarea>

                <button type="submit">Add Student</button>
            </form>
        </div>
    </div>
</body>

</html>
