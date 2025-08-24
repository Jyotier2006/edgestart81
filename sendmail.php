<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Collect form data
    $name     = $_POST['full-name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $jobTitle = $_POST['job-title'];
    $location = $_POST['location'];
    $message  = $_POST['message'];

    // 2. Handle file upload (resume)
    $resume = $_FILES['resume']['name'];
    $resume_tmp = $_FILES['resume']['tmp_name'];
    $upload_dir = "uploads/";

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $resume_path = $upload_dir . basename($resume);
    move_uploaded_file($resume_tmp, $resume_path);

    // 3. Email details
    $to = "coderprogrammer88@gmail.com"; // 🔴 Change to your email
    $subject = "New Job Finder Form Submission";
    $body = "
    New job application received:

    Full Name: $name
    Email: $email
    Phone: $phone
    Desired Job Title: $jobTitle
    Preferred Location: $location
    Additional Notes: $message
    Resume File: $resume_path
    ";

    $headers = "From: $email";

    // 4. Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "✅ Application submitted successfully!";
    } else {
        echo "❌ Failed to send application. Please try again.";
    }
}
?>
