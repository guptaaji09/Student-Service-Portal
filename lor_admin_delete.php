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

// Check if the request id is set and is numeric
if (isset($_POST['request_id']) && is_numeric($_POST['request_id'])) {
  $request_id = $_POST['request_id'];

  // Delete the request from the database
  mysqli_query($conn, "DELETE FROM requests_for_lor WHERE id = '$request_id'");

  // Set a success message
  $_SESSION['success'] = "LOR request was deleted successfully.";
}

// Redirect back to the original page
header('Location: teacher_dashboard3.php');
exit();
?>
