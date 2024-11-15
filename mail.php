<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign form fields
    $name = filter_var(trim($_POST["contact-name"]), FILTER_SANITIZE_STRING);
    $phone = filter_var(trim($_POST["contact-phone"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["contact-email"]), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["contact-message"]), FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Set your email address to receive the form submissions
    $to = "your-email@example.com";  // Replace with your email address

    // Set the email subject
    $email_subject = "Contact Form Submission: $subject";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Set the email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $email_subject, $email_content, $headers)) {
        echo "Thank you for your message. It has been sent.";
    } else {
        echo "There was a problem sending your message. Please try again.";
    }
} else {
    echo "Invalid request method";
}
?>
