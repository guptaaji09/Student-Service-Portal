<?php

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


    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->SetXY(30, 50);
    $pdf->Write(0, 'Letter of Recommendation', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->SetXY(30, 70);
    $pdf->Write(0, 'Date: ' . date('Y-m-d'), '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 90);
    $pdf->Write(0, 'Estelle Darcy', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 100);
    $pdf->Write(0, 'Recruitment Specialist', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 110);
    $pdf->Write(0, 'Austin Tech', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 120);
    $pdf->Write(0, '408 Byers Lane, Sacramento, CA 924260', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 130);
    $pdf->Write(0, '+123-456-7890', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetXY(30, 150);
    $pdf->Write(0, 'Ms. Darcy:', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 170);
    $pdf->Write(0, 'I am writing this to recommend:', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 180);
    $pdf->Write(0, $name, '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 190);
    $pdf->Write(0, 'for the position of administritive assistant at Acne Corporations.', '', 0, 'L', true, 0, false, false, 0);

    $pdf->SetXY(30, 210);
    $pdf->Write(0, 'I have had the opportunity to work him/her for the past few years at CBI Industries, and', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 220);
    $pdf->Write(0, 'have been consistently impressed with him/her showing diligence, efficiency.', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 230);
    $pdf->Write(0, 'Please feel free to contact me at 555-555-5555 if you have any questions.', '', 0, 'L', true, 0, false, false, 0);

    $pdf->SetXY(30, 240);
    $pdf->Write(0, 'Sincerely,', '', 0, 'L', true, 0, false, false, 0);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetXY(30, 250);
    $pdf->Write(0, 'Signature(hard copy letter)', '', 0, 'L', true, 0, false, false, 0);

    $pdf->SetXY(30, 260);
    $pdf->Write(0, 'Elaine Chang', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetXY(30, 270);
    $pdf->Write(0, 'Office Manager, CBI Industries', '', 0, 'L', true, 0, false, false, 0);

    // Output the PDF to the browser
    $pdf->Output('lor.pdf', 'I');
} else {
    header('Location: index.html');
}

