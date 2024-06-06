<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
        }
        h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }
        .student-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Adjusted to show 2 cards per row */
            grid-gap: 20px;
        }
        .student-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .student-info {
            margin-bottom: 5px;
        }
        .student-info strong {
            display: inline-block;
            width: 100px;
            font-weight: bold;
            margin-right: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        nav {
    background-color: #333;
    color: #fff;
    padding: 10px 0; /* Adjusted padding */
    text-align: center;
    font-size: 16px; /* Adjusted font size */
}

nav ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
}

nav ul li {
    display: inline;
    margin-left: 10px;
}

nav ul li:first-child {
    margin-left: 0;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
}

nav ul li a:hover {
    background-color: #555;
}
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="dashboard_teacher.php">Dashboard</a></li>
            <!-- Add more navbar items if needed -->
        </ul>
    </nav>

    <div class="container">
        <h2>Registered Students</h2>
        <div class="student-grid">
            <?php
            // Database connection settings
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "taska2023";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch student data from the database
            $sql = "SELECT * FROM students";
            $result = mysqli_query($conn, $sql);

            // Check if there are any students in the database
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='student-card'>";
                    echo "<div class='student-info'><strong>Name:</strong>" . $row['studentName'] . "</div>";
                    echo "<div class='student-info'><strong>Age:</strong>" . $row['studentAge'] . "</div>";
                    echo "<div class='student-info'><strong>Parent's Name:</strong>" . $row['parentName'] . "</div>";
                    echo "<div class='student-info'><strong>Email:</strong>" . $row['email'] . "</div>";
                    echo "<div class='student-info'><strong>Phone Number:</strong>" . $row['phoneNumber'] . "</div>";
                    echo "<div class='student-info'><strong>Additional Notes:</strong>" . $row['notes'] . "</div>";

                    // Add more information here as needed
                    echo "</div>";
                }
            } else {
                echo "No students found.";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>
    <div class="footer">
        <p>&copy; Taska Sinar Mesra</p>
    </div>
</body>
</html>
