<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Form</title>
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
            background-color: #fff; /* Changed background color to white */
        }

        .child-section h2 {
            color: #2ecc71; /* Changed heading color to match navbar */
            margin-bottom: 20px; /* Added margin bottom for spacing */
        }

        .form-container label {
            display: block;
            margin-bottom: 10px; /* Adjusted margin for spacing */
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container select,
        .form-container textarea,
        .form-container input[type="file"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 15px; /* Adjusted margin for spacing */
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container textarea {
            resize: vertical;
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
        <a href="http://localhost/Taska2023/dashboard_parent.php">Dashboard</a>
        <a href="http://localhost/Taska2023/home.php">Logout</a>
    </div>
    <div class="child-section">
        <h2>Billing Information</h2>
        <form action="submit.billing.php" method="post" onsubmit="displayMessage()" class="form-container" enctype="multipart/form-data">
            <label for="parent_name">Children Name:</label>
            <input type="text" id="parent_name" name="parent_name" required>
            
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
            
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" required min="0">

            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Bank Transfer">Bank Transfer</option>
            </select>
            
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" rows="4"></textarea>

            <!-- File upload field -->
            <label for="document_path">Upload Document:</label>
            <input type="file" id="document_path" name="document_path">

            <input type="submit" value="Submit">
        </form>
    </div>

    <!-- JavaScript function to display pop-up message and redirect -->
    <script>
        function displayMessage() {
            alert('Billing information submitted successfully.');
        }
    </script>
</body>
</html>
