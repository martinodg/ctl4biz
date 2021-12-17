<?php
ob_start();
define('FPDF_FONTPATH','font/');
require ('mysqli_table.php');
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("comunes.php");
require_once("../funciones/changelanguage.php");
$lang = new ChangeLanguage();
$pdf=new PDF();
$pdf->AddPage();
//Nombre del Listado
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',16);
$pdf->SetY(40);
$pdf->SetX(0);
$pdf->MultiCell(290,6,$lang->t('listado_proveedores'),0,'C',0);
$pdf->Ln();    	
//Restauracin de colores y fuentes
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);
//Buscamos y listamos las familias
$codproveedor=$_GET["codproveedor"];
$nombre=$_GET["nombre"];
$nif=$_GET["nif"];
$codprovincia=$_GET["cboProvincias"];
$localidad=$_GET["localidad"];
$telefono=$_GET["telefono"];
$where="1=1";
if ($codproveedor <> "") { $where.=" AND codproveedor='$codproveedor'"; }
if ($nombre <> "") { $where.=" AND nombre like '%".$nombre."%'"; }
if ($nif <> "") { $where.=" AND nif like '%".$nif."%'"; }
if ($codprovincia > "0") { $where.=" AND codprovincia='$codprovincia'"; }
if ($localidad <> "") { $where.=" AND localidad like '%".$localidad."%'"; }
if ($telefono <> "") { $where.=" AND telefono like '%".$telefono."%'"; }
//Ttulos de las columnas
$header=array($lang->t('nombre'),$lang->tu('nif'),$lang->t('direccion'),$lang->t('localidad'),$lang->t('telefono'));
//Colores, ancho de lnea y fuente en negrita
$pdf->SetFillColor(200,200,200);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.2);
$pdf->SetFont('Arial','B',8);	
//Cabecera
$w=array(50,20,60,40,20);
for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
$pdf->Ln();
$pdf->SetFont('Arial','',8);
$sel_resultado="SELECT * FROM proveedores WHERE borrado=0 AND ".$where;
$res_resultado=mysqli_query($conexion,$sel_resultado);
$contador=0;
while ($contador < mysqli_num_rows($res_resultado)) {
	$pdf->Cell($w[0],5,mysqli_result($res_resultado,$contador,"nombre"),'LRTB',0,'L');
	$pdf->Cell($w[1],5,mysqli_result($res_resultado,$contador,"nif"),'LRTB',0,'C');
	$pdf->Cell($w[2],5,mysqli_result($res_resultado,$contador,"direccion"),'LRTB',0,'L');
	$pdf->Cell($w[3],5,mysqli_result($res_resultado,$contador,"localidad"),'LRTB',0,'L');
	$pdf->Cell($w[4],5,mysqli_result($res_resultado,$contador,"telefono"),'LRTB',0,'C');
	$pdf->Ln();
	$contador++;
};			
$pdf->Output();
ob_end_flush(); 
?> 
