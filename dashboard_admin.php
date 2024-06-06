<?php
    // Start session
    session_start();

    // Logout functionality
    if(isset($_POST['logout'])) {
        // Destroy session
        session_destroy();
        // Redirect to login page
        header("Location: login.php");
        exit();
    }

    // Set error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Include Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Navbar styles */
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

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .top-bar {
            background-color: #ca1a5e;
            color: #fff;
            padding: 10px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            box-sizing: border-box;
        }

        .top-bar h1 {
            font-size: 20px;
            margin: 0;
        }

        .header-icon {
            font-size: 24px;
            color: #fff;
            margin-bottom: 5px;
            position: relative;
        }

        .header-icon i {
            position: relative;
            z-index: 2;
        }

        .header-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            background-color: #ca1a5e;
            border-radius: 50%;
            z-index: 1;
        }

        .user-icon {
            font-size: 18px;
            color: #fff;
            background-color: #960b3d;
            padding: 5px;
            border-radius: 50%;
            margin-bottom: 5px;
        }

        .container {
            flex: 1;
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }

        .dashboard-section {
            margin-top: 20px;
            width: 50%;
        }

        .dashboard-section h2 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 20px;
        }

        .action-box {
            flex: 1;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin: 0 10px;
            text-align: center;
        }

        .action-box h3 {
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            font-size: 16px;
        }

        .action-form {
            text-align: center;
            margin-top: 15px;
        }

        .action-form button {
            padding: 10px;
            font-size: 14px;
            background-color: #ca1a5e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .action-form button:hover {
            background-color: #960b3d;
        }

        .logout {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .logout button {
            padding: 10px;
            font-size: 14px;
            background-color: #ca1a5e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout button:hover {
            background-color: #960b3d;
        }

        .footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #ca1a5e;
            width: 100%;
            color: #fff;
            text-align: center;
        }

        .leave-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <div class="header-icon back-button" onclick="goBack()">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </div>
        <h1>Welcome, Admin!</h1>
        </div>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <a href="http://localhost/Taska2023/home.php">Home</a>
        <a href="http://localhost/Taska2023/admin_profile.php">Profile</a>
        <a href="http://localhost/Taska2023/announcement.php">Announcement</a>



    </div>

    <div class="dashboard-section">
        <h2>Leave Management</h2>
        <div class="leave-container">
            <div class="action-box">
                <div class="action-form">
                    <form action="admin_leave.php" method="post">
                        <button type="submit">Manage Leave</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="dashboard-section">
        <h2>History Leave</h2>
        <div class="leave-container">
            <div class="action-box">
                <div class="action-form">
                    <form action="leave_history.php" method="post">
                        <button type="submit">History Leave</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="dashboard-section">
        <h2>Attendance Management</h2>
        <div class="attendance-container">
            <div class="action-box">
                <div class="action-form">
                    <form action="view_attendance.php" method="post">
                        <button type="submit">Manage Attendance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-section">
        <h2>Finance Management</h2>
        <div class="finance-container">
            <div class="action-box">
                <div class="action-form">
                    <form action="billing.admin.php" method="post">
                        <button type="submit">Manage Finance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    
     <!-- Logout button -->
<div class="logout">
    <a href="home.php" style="text-decoration: none; color: #333; font-weight: bold; background-color: #f44336; color: white; padding: 10px 20px; border-radius: 5px;">Logout</a>
</div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>


    <div class="footer">
        &copy; 2023 Admin Dashboard. This is a long footer to demonstrate its length.
    </div>

</body>

</html>