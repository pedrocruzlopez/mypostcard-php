<?php

require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('MyPostcard Image');


// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 20);

// add a page
$pdf->AddPage();


// print a block of text using Write()
$filename = $_GET['url'];
list($width, $height) = getimagesize($filename);
if($width > $height){
    $new_width = 200;
    $new_height = ($new_width * $height) / $width;
    $x = 6;
    $y = 50;
} else {
    $new_height = 300;
    $new_width = ($new_height * $width) / $height;
    $x = 16;
    $y = 10;
}

$pdf->Image($filename, $x, $y, $new_width, $new_height, 'JPG', $filename, 'C', true, 300, '', false, false, 0, false, false, false);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('postcard.pdf', 'I');