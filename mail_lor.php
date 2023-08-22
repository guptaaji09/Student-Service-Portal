<?php
// Start the session
session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
  header('Location: login.php');
  exit();
}

// Include the database connection file
include('database.php');

// Retrieve the teacher's profile data from the database
$stmt = $pdo->prepare('SELECT full_name, email FROM teacher_profile WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$profile = $stmt->fetch();

// Get student email from form data
$student_email = $_POST['student_email'];

// Set email parameters
$to = $student_email;
$from = $profile['email'];
$subject = "Here's the LOR requested by you!";
$message = "Hey, This is ".$profile['full_name'].", I have attached the requested LOR with this email. If you have any queries, email me anytime!";

// Set headers
$headers = "From: ".$from."\r\n";
$headers .= "Reply-To: ".$from."\r\n";
$headers .= "Content-Type: text/html\r\n";

// Get teacher full name from form data
$teacher_full_name = $_POST['full_name'];

// Send email
if (mail($to, $subject, $message, $headers)) {
  // Email sent successfully
  echo "<script>alert('Email sent successfully!');</script>";
} else {
  // Email failed to send
  echo "<script>alert('Failed to send email. Please try again later.');</script>";
}

// Redirect to previous page
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
