<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taska2023"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $childName = htmlspecialchars($_POST['childName']);
    $childGrade = htmlspecialchars($_POST['childGrade']);

    $stmt = $conn->prepare("INSERT INTO children (name, grade) VALUES (?, ?)");
    $stmt->bind_param("ss", $childName, $childGrade);

    if ($stmt->execute()) {
        echo "<p>Child $childName in grade $childGrade added successfully!</p>";
    } else {
        echo "<p>Error adding child: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Child</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #2ecc71;
            padding: 15px 0;
            text-align: center;
            color: #fff;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .child-section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .form-container {
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input[type="text"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-container button {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="dashboard_parents.php">Dashboard</a>
        <a href="home.php">Logout</a>
        <a href="list_children.php">Children List</a>
    </div>
    <div class="child-section">
        <h2>Add Child</h2>
        <div class="form-container">
            <form id="addChildForm" method="post" action="">
                <label for="childName">Name:</label>
                <input type="text" id="childName" name="childName" required>

                <label for="childGrade">Grade:</label>
                <input type="text" id="childGrade" name="childGrade" required>

                <button type="submit" id="addChildBtn">Add Child</button>
            </form>
        </div>
    </div>
</body>
</html>
