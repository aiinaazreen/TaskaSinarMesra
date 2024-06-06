<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taska2023";


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    
    // Handle profile image upload
    if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check !== false) {
            move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
            $profile_image_path = $target_file;
        } else {
            // Redirect to an error page if the file is not an image
            header("Location: edit_profile.php?status=error&message=invalid_image");
            exit();
        }
    } else {
        $profile_image_path = NULL;
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, address, profile_image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $profile_image_path);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to a success page or back to the profile page
        header("Location: profile.php?status=success");
        exit();
    } else {
        // Redirect to an error page or back to the profile page with an error message
        header("Location: edit_profile.php?status=error");
        exit();
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
