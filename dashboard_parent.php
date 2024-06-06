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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Include Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General body styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #2ecc71;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto; /* Enable vertical scrolling if content exceeds height */
            transition: width 0.3s ease;
        }

        .sidebar:hover {
            width: 280px;
        }

        .sidebar-header {
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .sidebar-header:hover {
            background-color: #27ae60; /* Change to a different color on hover */
        }

        .sidebar h1 {
            font-size: 1.5rem;
        }

        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .sidebar-menu li:hover {
            transform: translateX(5px);
        }

        .sidebar-menu a {
            color: #fff;
            text-decoration: none;
        }

        /* Content area */
        .content {
            margin-left: 250px;
            padding: 20px;
            box-sizing: border-box;
            transition: margin-left 0.3s ease;
        }

        /* Profile container styles */
        .profile-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        /* Profile info and emergency info card styles */
        .profile-info, .emergency-info, .children-info {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-info:hover, .emergency-info:hover, .children-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .profile-info h2, .emergency-info h2, .children-info h2 {
            color: #007bff;
            margin-bottom: 10px;
        }

        .profile-info p, .emergency-info p, .children-info p {
            margin: 8px 0;
            font-size: 16px;
            color: #333;
        }

        /* Table styles */
        .child-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .child-table th, .child-table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .child-table th {
            background-color: #2ecc71;
            color: #fff;
        }

        .child-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .child-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .add-child-form {
            margin-top: 20px;
        }

        .add-child-form input[type="text"], .add-child-form button {
            padding: 10px;
            margin-top: 10px;
            width: calc(100% - 22px);
            box-sizing: border-box;
        }

        .add-child-form button {
            background-color: #2ecc71;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-child-form button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h1>Parent Dashboard</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="parent_profile.php">Profile</a></li>
            <li><a href="children.section.php">Children</a></li>
            <li><a href="billing.parent.php">Billing</a></li>
            <li><a href="billing_history.php">Billing History</a></li>


            <li><a href="home.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="children-info">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $childName = $_POST['childName'];
                $childGrade = $_POST['childGrade'];

                $sql = "INSERT INTO children (name, grade) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $childName, $childGrade);

                if ($stmt->execute()) {
                    echo '<p style="color: green;">Child added successfully.</p>';
                } else {
                    echo '<p style="color: red;">Error: ' . $conn->error . '</p>';
                }

                $stmt->close();
            }
            ?>

            <h2>Children</h2>
            <table class="child-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT name, grade FROM children";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . htmlspecialchars($row['name']) . "</td><td>" . htmlspecialchars($row['grade']) . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No children found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
