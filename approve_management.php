<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        header {
            background-color: #ca1a5e;
            color: #fff;
            padding: 15px;
            text-align: center;
            width: 100%;
        }

        .dashboard-section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
            text-align: center;
        }

        .leave-box {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 20px;
        }

        .leave-form {
            margin-top: 20px;
        }

        .leave-form button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
        }

        .leave-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <header>
        <h1>Leave Management System</h1>
    </header>

    <div class="dashboard-section">
        <h2>Leave Management</h2>
        <div class="leave-box">
            <h3>Approve Leave</h3>
            <p>This section displays information related to approving leave.</p>
            <div class="leave-form">
                <!-- Form for approving leave -->
                <form action="approve_leave.php" method="post">
                    <!-- Include form elements for approving leave -->
                    <button type="submit">Approve Leave</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
