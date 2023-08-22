<?php
// Start the session
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
  header('Location: login.php');
  exit();
}

// Include the database connection file
include('database.php');

// Get the student's assignments from the database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM assignments WHERE student_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$assignments = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

if (isset($_POST['name'])) {
    $name = $_POST['name'];

    // Load the PDF library (if not already loaded)
    require_once('tcpdf/tcpdf.php');

    // Create a new PDF object
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set PDF properties
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Certificate');

    // Remove header and footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Add a page
    $pdf->AddPage();

    // Set font and styles
    $pdf->SetFont('helvetica', '', 11);
    $pdf->SetTextColor(0, 0, 0);

    //add text
    $pdf->SetXY(30, 50);
    $pdf->Write(0, '10th February, 2023', '', 0, 'R', true, 0, false, false, 0);

    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->SetXY(30, 70);
    $pdf->Write(0, 'TO WHOMSOEVER IT MAY CONCERN', '', 0, 'C', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetXY(30, 90);
    $pdf->Write(0, 'This is to certify that', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 100);
    $pdf->Write(0, $name, '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 110);
    $pdf->Write(0, 'is a bonafide student of our institute...', '', 0, 'L', true, 0, false, false, 0);

    $pdf->SetXY(30, 130);
    $pdf->Write(0, 'The Institute is affiliated to the University of Mumbai (formerly University of Bombay) and', '', 0, 'L', true, 0, false, false, 0);

    $pdf->SetXY(30, 140);
    $pdf->Write(0, 'approved by Governmnet of Maharashtra and AICTE.', '', 0, 'L', true, 0, false, false, 0);

    $pdf->SetXY(30, 160);
    $pdf->Write(0, 'Dr. Rajesh Chauhan', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 170);
    $pdf->Write(0, 'Principal', '', 0, 'L', true, 0, false, false, 0);

    // Output the PDF to the browser
    $pdf->Output('bonifide_certificate.pdf', 'I');
} else {
    header('Location: index.php');
}

?>
