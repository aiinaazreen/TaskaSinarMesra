<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient_email = $_POST['recipient_email'];
    $subject = $_POST['subject'];
    $name = $_POST['name'];
    $sender_email = $_POST['email'];
    $message = $_POST['message'];

    // Create the email message
    $email_message = "Name: $name\n";
    $email_message .= "Email: $sender_email\n\n";
    $email_message .= "Message:\n$message";

    // Set headers
    $headers = "From: $name <$sender_email>\r\n";
    $headers .= "Reply-To: $sender_email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Send the email
    if (mail($recipient_email, $subject, $email_message, $headers)) {
        echo "Your message has been sent successfully!";
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
} else {
    // If the form is not submitted, redirect to the home page or show an error message
    echo "Invalid request.";
}
?>
