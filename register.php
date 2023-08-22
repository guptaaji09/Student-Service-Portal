<?php
// Include the database connection file
include('database.php');

// Get the user's account information from the form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];

// Validate the user's input
if ($password != $confirm_password) {
  echo 'Error=password_mismatch';
  exit();
}
if (!in_array($role, ['student', 'teacher', 'admin'])) {
  header('Location: signedup.php?error=invalid_role');
  exit();
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user record into the database
$stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
$result = $stmt->execute();

if ($result) {
  // If the account is created successfully, redirect the user to the login page with a success message
  header('Location: index.php?success=account_created');
} else {
  // If there was an error creating the account, redirect the user back to the signup page with an error message
  header('Location: signup.php?error=account_creation_failed');
}

$stmt->close();
$conn->close();
?>
