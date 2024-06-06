<?php
// get_real_time_status.php

// Example: Simulate fetching real-time status from a database
$employee = $_GET['employee']; // Get the employee parameter from the AJAX request

// Replace this with your actual logic to fetch real-time status for the given employee
// In a real-world scenario, you might query a database or use some other data source.
$realTimeStatus = getRandomStatus(); // Function to get a random status for demonstration

echo $realTimeStatus;

function getRandomStatus() {
    $statuses = ['Present', 'Absent', 'On Break', 'In a Meeting'];
    return $statuses[array_rand($statuses)];
}
?>
