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

// Get the form input values
$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$objective = $_POST['objective'];
$college = $_POST['college'];
$college_city = $_POST['college_city'];
$major = $_POST['major'];
$gpa = $_POST['gpa'];
$company = $_POST['company'];
$company_location = $_POST['company_location'];
$skills = $_POST['skills'];
$achievement1 = $_POST['achievement1'];
$achievement2 = $_POST['achievement2'];

// Set the resume filename
$resume_filename = $name . '_resume.pdf';

// Instantiate the TCPDF class
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set the document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($name);
$pdf->SetTitle('Resume');
$pdf->SetSubject('Resume');

// Add a page
$pdf->AddPage();

// Set the font
$pdf->SetFont('times', '', 11);

// Add the header
$pdf->Image('logo.png', 10, 10, 30);
$pdf->Cell(0, 0, $name, 0, 1, 'R');
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(0, 0, $address . ', ' . $city . ', ' . $state . ' ' . $zip, 0, 1, 'R');
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 0, $phone . ' | ' . $email, 0, 1, 'R');
$pdf->Ln(10);

// Add the objective section
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, 'Objective', 0, 1);
$pdf->SetFont('times', '', 11);
$pdf->MultiCell(0, 10, $objective, 0, 'L');
$pdf->Ln(10);

// Add the education section
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, 'Education', 0, 1);
$pdf->SetFont('times', '', 11);
$pdf->Cell(70, 10, $college . ', ' . $college_city, 0, 1);
$pdf->Cell(70, 10, $major, 0, 1);
$pdf->Cell(70, 10, 'GPA: ' . $gpa, 0, 1);
$pdf->Ln(10);

// Add the experience section
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, 'Experience', 0, 1);
$pdf->SetFont('times', '', 11);
$pdf->Cell(70, 10, $company . ', ' . $company_location, 0, 1);
// $pdf->Cell(70, 10, 'Date - Date', 0, 1);
// $pdf->SetFont('times', 'B', 11);
// $pdf->Cell(70, 10, 'Position', 0, 1);
// $pdf->SetFont('times', '', 11);
$pdf->Ln(10);

// Add the skills section
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, 'Skills', 0, 1);
$pdf->SetFont('times', '', 11);
$pdf->MultiCell(0, 10, $skills, 0, 'L');
$pdf->Ln(10);

// Add the achievements section
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(0, 10, 'Achievements', 0, 1);
$pdf->SetFont('times', '', 11);
$pdf->MultiCell(0, 10, '- ' . $achievement1, 0, 'L');
$pdf->MultiCell(0, 10, '- ' . $achievement2, 0, 'L');

// Output the PDF
$pdf->Output($resume_filename, 'D');