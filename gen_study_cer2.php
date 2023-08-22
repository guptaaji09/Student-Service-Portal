<?php
// Start the session
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
  header('Location: login.php');
  exit();
}

// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Define variables
$full_name = $_POST['name'];
$course = $_POST['course'];
$date_of_birth = $_POST['date_of_birth'];
$year_of_completion = $_POST['year_of_completion'];

// Create new PDF document
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Study Certificate');
$pdf->SetSubject('Study Certificate');

// Set margins
$pdf->SetMargins(20, 20, 20);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('courier', '', 12);

// Add content to the document
$html = '
<h1 style="text-align:center;">STUDY CERTIFICATE</h1>
<h1></h1>
<p style="text-align:justify;">This is to certify that <strong>'.$full_name.'</strong> has successfully completed the course <strong>'.$course.'</strong> during the academic year <strong>'.$year_of_completion.'</strong>.</p>
<p style="text-align:justify;">Date of Birth for '.$full_name.' is: <strong>'.$date_of_birth.'</strong>.</p>
<p style="text-align:justify;">This certificate is issued on the request of the student and for the purpose of submission to the concerned authority.</p>
<h1></h1>
<p style="text-align:right;">Signature:____________________</p>
';

$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF
$pdf->Output($full_name.'-Study-Certificate.pdf', 'I');
?>