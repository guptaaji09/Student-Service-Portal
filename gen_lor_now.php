<?php
// Start the session
session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
  header('Location: login.php');
  exit();
}

// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Include the database connection file
include('database.php');

// Get the LOR request from the database
$id = $_GET['id'];
$lor_request = mysqli_query($conn, "SELECT * FROM lor_request WHERE id=$id");
$lor_request = mysqli_fetch_assoc($lor_request);

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Author');
$pdf->SetTitle('LOR Request');
$pdf->SetSubject('LOR Request');
$pdf->SetKeywords('TCPDF, PDF, LOR Request');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'LOR Request', 'By: ' . $_SESSION['username'], array(0, 0, 0), array(255, 255, 255));
$pdf->setFooterData(array(0, 0, 0), array(255, 255, 255));

// Set header and footer fonts
$pdf->setHeaderFont(array('helvetica', '', 14));
$pdf->setFooterFont(array('helvetica', '', 10));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();

// Set content
$html = '<h1>LOR Request</h1>';
$html .= '<p><strong>Student Name:</strong> ' . $lor_request['student_id'] . '</p>';
$html .= '<p><strong>Professor Name:</strong> ' . $lor_request['professor_name'] . '</p>';
$html .= '<p><strong>University Name:</strong> ' . $lor_request['university_name'] . '</p>';
$html .= '<p><strong>Department Name:</strong> ' . $lor_request['department_name'] . '</p>';
$html .= '<p><strong>Deadline:</strong> ' . $lor_request['deadline'] . '</p>';
$html .= '<p><strong>Purpose:</strong> ' . $lor_request['purpose'] . '</p>';

$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF as a file (inline view)
$pdf->Output('LOR_Request.pdf', 'I');
