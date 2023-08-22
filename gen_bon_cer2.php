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
$full_name = $_POST['full_name'];
$roll_number = $_POST['roll_number'];
$academic_year = $_POST['academic_year'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$institute_name = $_POST['institute_name'];
$university_name = $_POST['university_name'];

// Create new PDF document
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Bonafide Certificate');
$pdf->SetSubject('Bonafide Certificate');

// Set margins
$pdf->SetMargins(20, 20, 20);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('courier', '', 12);

// Add content to the document
$html = '
<h1 style="text-align:center;">BONAFIDE CERTIFICATE</h1>
<h1></h1>
<p style="text-align:justify;">This is to certify that <strong>'.$full_name.'</strong> (Roll Number: <strong>'.$roll_number.'</strong>) is a bonafide student of '.$institute_name.', '.$university_name.' during the academic year <strong>'.$academic_year.'</strong>.</p>
<p style="text-align:justify;">The student has undergone training in our institution from <strong>'.$start_date.'</strong> to <strong>'.$end_date.'</strong> and has successfully completed the course.</p>
<p style="text-align:justify;">This certificate is issued on the request of the student and for the purpose of submission to the concerned authority.</p>
<h1></h1>
<p style="text-align:right;">Signature:____________________</p>
';

$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF
$pdf->Output($full_name.'-Bonafide-Certificate.pdf', 'I');
