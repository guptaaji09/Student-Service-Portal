<?php

session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
  header('Location: login.php');
  exit();
}

require_once('tcpdf/tcpdf.php');

// Get form data
$full_name = $_POST['full_name'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$qualification = $_POST['qualification'];
$department = $_POST['department'];
$student_name = $_POST['student_name'];
$student_roll_number = $_POST['student_roll_number'];
$authority_name = $_POST['authority_name'];
$authority_designation = $_POST['authority_designation'];
$authority_address = $_POST['authority_address'];

// Set up PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($full_name);
$pdf->SetTitle('Letter of Recommendation');
$pdf->SetMargins(20, 20, 20);
$pdf->SetAutoPageBreak(true, 20);

// Add page
$pdf->AddPage();

// Add content
$pdf->SetFont('courier', '', 12);

// Add Name and Phone No/Mail ID
$pdf->Cell(0, 10,''. $full_name . '('. $qualification . ')', 0, 1, 'C');
$pdf->Cell(0, 10, $phone_number . ' / ' . $email, 0, 1, 'C');

// Add Date
$pdf->Cell(0, 10, 'Date: ' . date('d-m-Y'), 0, 1, 'R');

// Add Concerned Authority Details
$pdf->Ln();
$pdf->Cell(0, 10, 'To,', 0, 1);
$pdf->Cell(0, 10, $authority_name, 0, 1);
$pdf->Cell(0, 10, $authority_designation, 0, 1);
$pdf->Cell(0, 10, $authority_address, 0, 1);

// Add To Whom It May Concern
$pdf->Ln();
$pdf->Cell(0, 10, 'Dear '.$authority_name.',', 0, 1);

// Add General Paragraph
$pdf->Ln();
$general_paragraph = 'I am writing to recommend ' . $student_name . ', who is currently a student (Roll no: '.$student_roll_number.') at our institution. I have had the pleasure of knowing ' . $student_name . ' for ' . rand(2, 4) . ' years and have been continuously impressed with ' . $student_name . '\'s academic achievements, interpersonal skills, and leadership qualities. ' . $student_name . ' is an exceptional student who has consistently demonstrated a deep passion for ' . rand(3, 4) . ' courses he/she has taken with me. He/She is a quick learner, a critical thinker, and an excellent team player. I have no doubt that ' . $student_name . ' will be an asset to any academic institution or organization that he/she chooses to join in the future.';
$pdf->MultiCell(0, 10, $general_paragraph, 0, 'J');

// Add Name, Qualification, and Department
$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(0, 10, 'Sincerely,', 0, 1);
$pdf->Cell(0, 10, $full_name, 0, 1);
$pdf->Cell(0, 10, $department . ', FCRIT ', 0, 1);


// Output PDF
$pdf->Output($student_name.'-LOR.pdf', 'I');
?>