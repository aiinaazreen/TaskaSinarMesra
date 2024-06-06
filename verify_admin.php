<?php
// Verify or reject a billing record

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    // Update the status based on the action
    $status = '';
    if ($action == 'verify') {
        $status = 'verify';
    } elseif ($action == 'reject') {
        $status = 'rejected';
    }

    // Function to update the billing record status
    function updateBillingRecord($id, $status) {
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

        // Prepare and execute SQL statement to update the status
        $stmt = $conn->prepare("UPDATE billing SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }

    // Call the function to update the billing record status
    updateBillingRecord($id, $status);

    // Redirect back to the admin panel
    header("Location: billing.admin.php");
    exit;
} else {
    // Redirect to home page if action or ID is not provided
    header("Location: home.php");
    exit;
}
?>
