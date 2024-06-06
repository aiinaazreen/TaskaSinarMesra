<?php
session_start();

// Define initial admin profile information
$adminProfile = array(
    'fullName' => 'John Doe',
    'title' => 'Administrator',
    'email' => 'john.doe@example.com',
    'phone' => '+1 (555) 123-4567',
    'address' => '123 Main St, Cityville',
    'age' => 35, // Adding age as a new field
    'profileImage' => 'path_to_default_profile_image.jpg' // Default profile image path
);

// Check if form is submitted to save changes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    // Retrieve form data and update admin profile
    $adminProfile['fullName'] = $_POST['fullName'];
    $adminProfile['title'] = $_POST['title'];
    $adminProfile['email'] = $_POST['email'];
    $adminProfile['phone'] = $_POST['phone'];
    $adminProfile['address'] = $_POST['address'];
    $adminProfile['age'] = $_POST['age'];

    // Handle profile image upload
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['profileImage']['name']);
        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $uploadFile)) {
            $adminProfile['profileImage'] = $uploadFile;
        }
    }

    // Store updated admin profile in session
    $_SESSION['adminProfile'] = $adminProfile;

    // Redirect back to the profile edit page to clear POST data from URL
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Retrieve admin profile data from session (if available)
if (isset($_SESSION['adminProfile'])) {
    $adminProfile = $_SESSION['adminProfile'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #ca1a5e; /* Updated color */
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-brand {
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
        }

        .navbar-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.4rem;
            margin-left: auto;
        }

        .navbar-menu a {
            text-decoration: none;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar-menu a:hover {
            background-color: #555;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info p {
            margin-bottom: 8px;
        }

        .edit-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #ca1a5e;
            margin: 0 auto 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .center {
            text-align: center;
        }
    </style>
    </head>
<body>

<div class="navbar">
    <a href="#" class="navbar-brand">Admin Dashboard</a>
    <div class="navbar-toggle" onclick="toggleMenu()">
        &#9776;
    </div>
    <div class="navbar-menu" id="navbarMenu">
        <a href="http://localhost/Taska2023/home.php">Home</a>
        <a href="http://localhost/Taska2023/dashboard_admin.php">Dashboard</a>
    </div>
</div>

<div class="container">
    <h2 class="center">Teacher Profile</h2>

    <div class="profile-info">
        <div class="profile-image">
            <img src="<?php echo htmlspecialchars($adminProfile['profileImage']); ?>" alt="Profile Image" id="profileImagePreview">
        </div>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($adminProfile['fullName']); ?></p>
        <p><strong>Title:</strong> <?php echo htmlspecialchars($adminProfile['title']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($adminProfile['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($adminProfile['phone']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($adminProfile['address']); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($adminProfile['age']); ?></p>
    </div>

    <button class="edit-button" onclick="toggleEdit()">Edit Profile</button>

    <form id="editForm" style="display: none;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($adminProfile['fullName']); ?>" required>

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($adminProfile['title']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($adminProfile['email']); ?>" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($adminProfile['phone']); ?>" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" required><?php echo htmlspecialchars($adminProfile['address']); ?></textarea>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($adminProfile['age']); ?>" required>

        <label for="profileImage">Profile Image:</label>
        <input type="file" id="profileImage" name="profileImage" accept="image/*" onchange="previewImage(event)">

        <button type="submit" name="save">Save Changes</button>
    </form>
</div>

<script>
    function toggleMenu() {
        const navbarMenu = document.getElementById('navbarMenu');
        navbarMenu.classList.toggle('show');
    }

    function toggleEdit() {
        const editForm = document.getElementById('editForm');
        editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('profileImagePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
