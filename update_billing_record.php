<?php
function updateFinanceStatus($id, $status) {
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

    // Prepare and bind the statement
    $stmt = $conn->prepare("UPDATE billing SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

    // Execute the statement
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true; // Success
    } else {
        $stmt->close();
        $conn->close();
        return false; // Failure
    }
}
?>
