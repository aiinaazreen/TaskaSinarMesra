<?php
// Assuming $conn is your database connection object

$teacherId = 123; // Example teacher ID
$sqlFetchLeaveDays = "SELECT remaining_leave_days FROM teacher_leave_balance WHERE teacher_id = $teacherId";

$result = $conn->query($sqlFetchLeaveDays);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $remainingLeaveDays = $row['remaining_leave_days'];
    echo "Remaining Leave Days: $remainingLeaveDays";
} else {
    echo "No leave balance found for this teacher.";
}
?>


<?php
// Assuming $conn is your database connection object

$teacherId = 123; // Example teacher ID
$newLeaveDays = 10; // Example new leave days balance

$sqlUpdateLeaveDays = "INSERT INTO teacher_leave_balance (teacher_id, remaining_leave_days) VALUES ($teacherId, $newLeaveDays)
    ON DUPLICATE KEY UPDATE remaining_leave_days = $newLeaveDays";

if ($conn->query($sqlUpdateLeaveDays) === TRUE) {
    echo "Leave days updated successfully.";
} else {
    echo "Error updating leave days: " . $conn->error;
}
?>
