

<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf->SetAuthor('Martin Drot');
$pdf->SetTitle('FPDF tutorial'); 
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
?>

