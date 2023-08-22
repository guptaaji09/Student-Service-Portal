<?php

// Start the session
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
  header('Location: login.php');
  exit();
}

// Define variables
$full_name = $_POST['name'];
$doctor_name = $_POST['doctor_name'];
$suffering_from = $_POST['suffering_from'];
$period_of_recovery = $_POST['period_of_recovery'];
$issue_date = $_POST['issue_date'];

// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Medical Certificate');
$pdf->SetSubject('Medical Certificate');

// Set margins
$pdf->SetMargins(20, 20, 20);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('courier', '', 12);

// Add content to the document
$html = '
<h1 style="text-align:center;">MEDICAL CERTIFICATE</h1>
<p style="text-align:right;">Date: '.$issue_date.'</p>
<h1></h1>
<p>To Whom It May Concern,</p>
<p>This is to certify that <strong>'.$full_name.'</strong> has been under my medical treatment from <strong>'.date("d-M-Y", strtotime("-".$period_of_recovery)).'</strong> to <strong>'.date("d-M-Y", strtotime($issue_date)).'</strong> for '.$suffering_from.'. The patient has shown improvement and is now fit to resume normal activities.</p>
<p>The above information is true to the best of my knowledge and belief.</p>
<h1></h1>
<p style="text-align:right;">Sincerely,</p>
<p style="text-align:right;">'.$doctor_name.'</p>
';

$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF
$pdf->Output($full_name.'-Medical-Certificate.pdf', 'I');

?>