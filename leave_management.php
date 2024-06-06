<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reject Leave</title>

    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 90vh;
        }

        header {
            background-color: #ca1a5e;
            color: #fff;
            padding: 1px;
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

        .leave-form label {
            display: block;
            margin-bottom: 8px;
        }

        .leave-form textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 16px;
        }

        .leave-form button {
            background-color: #ca1a5e;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
        }

        .leave-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="dashboard-section">
        <div class="leave-box">
            <h3>Reject Leave</h3>
            <p>This section displays information related to rejecting leave.</p>
            <div class="leave-form">
                <!-- Form for rejecting leave -->
                <form action="reject_leave.php" method="post">
                    <label for="reject_reason">Reason for Rejection:</label>
                    <textarea id="reject_reason" name="reject_reason" required></textarea>
                    <!-- Include form elements for rejecting leave -->
                    <button type="submit">Reject</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
