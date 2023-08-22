<?php
require_once 'PHPMailer/PHPMailerAutoload.php';

function send_email($email, $token)
{
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'helpbotx@outlook.com';                 // SMTP username
    $mail->Password = 'Pass#123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('your_email@domain.com', 'Student Service Portal');
    $mail->addAddress($email);     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Reset your password';
    $mail->Body    = '<p>Please click the following link to reset your password:</p><p><a href="http://localhost/reset_password.php?token='.$token.'">Reset Password</a></p>';
    $mail->AltBody = 'Please click the following link to reset your password: http://localhost/reset_password.php?token='.$token;

    if(!$mail->send()) {
        //if the email is not sent successfully
    return false;
    } else {
    return true;
    }
    }
    ?>