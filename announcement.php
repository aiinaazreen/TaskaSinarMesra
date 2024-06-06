<?php
// Handle form submission for updating the announcement
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the announcement text
    $announcement = isset($_POST["announcement"]) ? htmlspecialchars($_POST["announcement"]) : "";

    // Save the announcement to a file or database
    // For demonstration purposes, let's save it to a text file named announcement.txt
    file_put_contents("announcement.txt", $announcement);

    // Redirect to home.php after saving the announcement
    header("Location: home.php");
    exit(); // Terminate the script after redirection
}

// Read the announcement from the text file
$announcement = file_get_contents("announcement.txt");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        h2 {
            margin-top: 0;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            resize: none;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #ca1a5e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #d23670;
        }

        footer {
            background-color: #ca1a5e;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
    <title>Update Announcement</title>
</head>

<body>
    <div class="container">
        <h2>Update Announcement</h2>
        <form method="post">
            <textarea name="announcement" rows="4" cols="50"><?php echo $announcement; ?></textarea><br>
            <button type="submit">Save Announcement</button>
        </form>
    </div>

    <footer>
        &copy; 2023 Taska Sinar Mesra.
    </footer>
</body>

</html>
