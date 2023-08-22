<?php
require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");
require("PHPMailer-master/src/Exception.php");

// Include the database connection file
require_once('database.php');

// Get the user's email address from the form
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

// Validate the email address
if (!$email) {
  echo "Invalid email address.";
  exit;
}

// Query the database to retrieve the user's information
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
  // Generate a random string for the token
  $token = bin2hex(random_bytes(16));

  // Update the user's record in the database with the token
  $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
  $stmt->bind_param("ss", $token, $email);
  $stmt->execute();

  $username = $user['username'];

  $mail = new PHPMailer\PHPMailer\PHPMailer();
  $mail->SMTPDebug = 0;
  $mail->IsSMTP(); 

  $mail->CharSet="UTF-8";
  $mail->Host = "smtp.office365.com";
  $mail->Port = 587 ; //465 or 587

  $mail->SMTPSecure = 'tls';  
  $mail->SMTPAuth = true; 
  $mail->IsHTML(true);

  //Authentication
  $mail->Username = "helpbotx@outlook.com";
  $mail->Password = "Poke#123";

  //Set Params
  $mail->SetFrom("helpbotx@outlook.com");
  $mail->addAddress($email);
  $mail->Subject = 'Reset Your Password';
  $mail->Body    = "Hi,<br> <br> For Username: $username, <br><br>Please click the following link to reset your password: <a href='http://localhost/smss/reset_password.php?email=" . urlencode($email) . "&token=" . urlencode($token) . "'>Reset Password</a><br><br>Regards,<br>Student Service Portal";

  if ($mail->send()) {
    echo "<script>alert('Email sent successfully!')</script>";
    echo "<script>window.location.href='index.php?mail_sent_successfully';</script>";
} else {
    $message = 'Error sending email.';
}
  echo $message;
} else {
  echo 'User not found.';
}
?>
