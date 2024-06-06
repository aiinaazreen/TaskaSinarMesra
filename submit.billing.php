<?php
// Database connection parameters
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $parentName = $_POST["parent_name"];
    $phone = $_POST["phone"];
    $amount = $_POST["amount"];
    $paymentMethod = $_POST["payment_method"];
    $comment = $_POST["comment"];
    $verified = isset($_POST["verified"]) ? $_POST["verified"] : 0; // Set default to 0 if not provided
    $document_path = ""; // Initialize as empty string

    // Check if document_path is provided in the form submission
    if (isset($_FILES['document']['name']) && !empty($_FILES['document']['name'])) {
        // Upload document
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["document"]["name"]);
        if (move_uploaded_file($_FILES["document"]["tmp_name"], $targetFile)) {
            $document_path = $targetFile; // Set document path if upload is successful
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO billing (parent_name, phone, amount, payment_method, comment, document_path) 
            VALUES ('$parentName', '$phone', '$amount', '$paymentMethod', '$comment', '$document_path')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        // Close database connection
        $conn->close();

        // Display success message and redirect to dashboard
        echo "<script>
                alert('Billing information submitted successfully.');
                window.location.href = 'dashboard_parent.php'; // Redirect to dashboard
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
