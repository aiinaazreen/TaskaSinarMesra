<style>
 /* Styles for process_billing.php */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

p {
    font-size: 16px;
    color: #555;
}
   
</style>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    // Store billing information in session
    $_SESSION['billing_info'] = [
        'date' => $date,
        'description' => $description,
        'amount' => $amount
    ];

    // Redirect back to admin_billing.php
    header("Location: admin_billing.php");
    exit();
}
?>
