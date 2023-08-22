<?php
session_start();

// Include the database connection file
include('database.php');

// Get the user's login credentials from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Query the database to retrieve the user's information
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Validate the user's login credentials
if (password_verify($password, $user['password'])) {
  // Set the user's session variables
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['username'] = $user['username'];
  $_SESSION['role'] = $user['role'];

  // Redirect the user to the appropriate dashboard based on their role
  if ($user['role'] == 'student') {
    header('Location: update_p3.php');
  } elseif ($user['role'] == 'teacher') {
    header('Location: manage_teacher4.php');
  } elseif ($user['role'] == 'admin') {
    header('Location: admin_dashboard.php');
  }
} else {
  // If the user's login credentials are invalid, redirect them back to the login page with an error message
  header('Location: index.php?reverted');
}
?>
