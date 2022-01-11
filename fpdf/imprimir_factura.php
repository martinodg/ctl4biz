<?php

define('FPDF_FONTPATH','font/');
$companyData=null;
require('mysqli_table.php');
require_once("comunes.php");
require_once("../conectar7.php");
require_once("../funciones/fechas.php");
require_once("../mysqli_result.php");
require_once("../funciones/changelanguage.php");
require_once("../funciones/companyData.php");
$lang = new ChangeLanguage();
$pdf=new PDF('P',  'mm', 'A4', $companyData,$lang);
$pdf->AddPage();
$pdf->Ln(20);
$codfactura=$_GET["codfactura"];
//echo $codfactura;
$consulta = "Select * from facturas,clientes,formapago where facturas.codfactura='$codfactura' and facturas.codcliente=clientes.codcliente and clientes.codformapago=formapago.codformapago";
$resultado = mysqli_query($conexion,$consulta);
$lafila=mysqli_fetch_array($resultado);
	$pdf->Cell(95);
    $pdf->Cell(80,4,"",'',0,'C');
    $pdf->Ln(4);

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(40,65,$lang->t('factura'));
	$pdf->SetX(10);

    $pdf->Cell(95);
    $pdf->Cell(80,4,"",'LRT',0,'L',1);
    $pdf->Ln(4);

    $pdf->Cell(95);
    $pdf->Cell(80,4,$lafila["nombre"],'LR',0,'L',1);
    $pdf->Ln(4);

    $pdf->Cell(95);
    $pdf->Cell(80,4,$lafila["direccion"],'LR',0,'L',1);
    $pdf->Ln(4);

	//Calculamos la provincia
	$codigoprovincia=$lafila["codprovincia"];
	$consulta="select * from provincias where codprovincia='$codigoprovincia'";
	$query=mysqli_query($conexion,$consulta);
	$row=mysqli_fetch_array($query);

	$pdf->Cell(95);
    $pdf->Cell(80,4,$lafila["codpostal"] . "  " . $lafila["localidad"] . "  (" . $row["nombreprovincia"] . ")",'LR',0,'L',1);
    $pdf->Ln(4);

    //$pdf->Cell(95);
    // $pdf->Cell(80,4,"Tlfno: " . $lafila["telefono"] . "  " . "Movil: " . $lafila["movil"],'LR',0,'L',1);
    //$pdf->Ln(4);

    $pdf->Cell(95);
    $pdf->Cell(80,4,"",'LRB',0,'L',1);
    $pdf->Ln(10);

    $pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);

    $pdf->Cell(80);
    $pdf->Cell(30,4,$lang->t('nif'),1,0,'C',1);
	$pdf->Cell(30,4,$lang->t('cod_cliente'),                     1,0,'C',1);
	$pdf->Cell(30,4,$lang->t('fecha'),                     1,0,'C',1);
	$pdf->Cell(20,4,$lang->t('cod_factura'),                     1,0,'C',1);
	$pdf->Ln(4);

	$pdf->Cell(80);
	$pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);

	$fecha = implota($lafila["fecha"]);
	$formadepago = $lafila["nombrefp"];

    $pdf->Cell(30,4,$lafila["nif"],1,0,'C',1);
	$pdf->Cell(30,4,$lafila["codcliente"],1,0,'C',1);
	$pdf->Cell(30,4,$fecha,1,0,'C',1);
	$pdf->Cell(20,4,$codfactura,1,0,'C',1);


	//ahora mostramos las lineas de la factura
	$pdf->Ln(10);
	$pdf->Cell(1);

	$pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);

    $pdf->Cell(40,4,$lang->t('referencia'),1,0,'C',1);
	$pdf->Cell(80,4,$lang->t('descripcion'),1,0,'C',1);
	$pdf->Cell(20,4,$lang->t('cantidad'),1,0,'C',1);
	$pdf->Cell(15,4,$lang->t('precio'),1,0,'C',1);
	$pdf->Cell(15,4,$lang->t('p_desc'),1,0,'C',1);
	$pdf->Cell(20,4,$lang->t('importe'),1,0,'C',1);
	$pdf->Ln(4);


	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);


	$consulta2 = "Select * from factulinea where codfactura='$codfactura' order by numlinea";
    $resultado2 = mysqli_query($conexion,$consulta2);

	$contador=1;
	while ($row=mysqli_fetch_array($resultado2))
	{
	  $pdf->Cell(1);
	  $contador++;
	  $texto=mysqli_result($resultado2,$lineas,"texto");
if ( $texto ) {

    $pdf->SetFont('Arial','BI',8);

	  $pdf->Cell(40,4,'','LR',0,'L');

	  $pdf->Cell(80,4,$texto,'LR',0,'L');
	  $pdf->Cell(20,4,"",'LR',0,'C');
	  $pdf->Cell(15,4,"",'LR',0,'R');
		$pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(20,4,"",'R',0,'R');
	  $pdf->Ln(4);
    $pdf->SetFont('Arial','',8);

	  $contador=$contador + 1;

} else {

	  $codarticulo=mysqli_result($resultado2,$lineas,"codigo");
	  $numlinea=mysqli_result($resultado2,$lineas,"numlinea");
	  $codfamilia=mysqli_result($resultado2,$lineas,"codfamilia");

#	  $sel_articulos="SELECT * FROM articulos WHERE codarticulo='$codarticulo' AND codfamilia='$codfamilia'";
	  $sel_articulos="SELECT * FROM articulos WHERE codarticulo='$codarticulo' ";
	  $rs_articulos=mysqli_query($conexion,$sel_articulos);
	  $pdf->Cell(40,4,mysqli_result($rs_articulos,0,"referencia"),'LR',0,'L');

	  $acotado = substr(mysqli_result($rs_articulos,0,"descripcion"), 0, 45);
	  $pdf->Cell(80,4,$acotado,'LR',0,'L');

	  $pdf->Cell(20,4,mysqli_result($resultado2,$lineas,"cantidad"),'LR',0,'C');

	  $precio2= number_format(mysqli_result($resultado2,$lineas,"precio"),2,",",".");
	  $pdf->Cell(15,4,$precio2,'LR',0,'R');

	  if (mysqli_result($resultado2,$lineas,"dcto")==0)
	  {
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  }
	  else
	   {
		$pdf->Cell(15,4,mysqli_result($resultado2,$lineas,"dcto") . " %",'LR',0,'C');
	   }

	  $importe2= number_format(mysqli_result($resultado2,$lineas,"importe"),2,",",".");

	  $pdf->Cell(20,4,$importe2,'LR',0,'R');
	  $pdf->Ln(4);


	  //vamos acumulando el importe
	  $importe=$importe + mysqli_result($resultado2,$lineas,"importe");
}
	  $contador=$contador + 1;
	  $lineas=$lineas + 1;

if ( $lineas % 48 == 0 ) {
$pdf->AddPage();

	//ahora mostramos las lineas de la factura
	$pdf->Ln(30);
	$pdf->Cell(1);

	$pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);

    $pdf->Cell(40,4,$lang->t('referencia'),1,0,'C',1);
	$pdf->Cell(80,4,$lang->t('descripcion'),1,0,'C',1);
	$pdf->Cell(20,4,$lang->t('cantidad'),1,0,'C',1);
	$pdf->Cell(15,4,$lang->t('precio'),1,0,'C',1);
	$pdf->Cell(15,4,$lang->t('p_desc'),1,0,'C',1);
	$pdf->Cell(20,4,$lang->t('importe'),1,0,'C',1);
	$pdf->Ln(4);


	$pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);
}

	};

	while ($contador<35)
	{
	  $pdf->Cell(1);
      $pdf->Cell(40,4,"",'LR',0,'C');
      $pdf->Cell(80,4,"",'LR',0,'C');
	  $pdf->Cell(20,4,"",'LR',0,'C');
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(15,4,"",'LR',0,'C');
	  $pdf->Cell(20,4,"",'LR',0,'C');
	  $pdf->Ln(4);
	  $contador=$contador +1;
	}

	  $pdf->Cell(1);
      $pdf->Cell(40,4,"",'LRB',0,'C');
      $pdf->Cell(80,4,"",'LRB',0,'C');
	  $pdf->Cell(20,4,"",'LRB',0,'C');
	  $pdf->Cell(15,4,"",'LRB',0,'C');
	  $pdf->Cell(15,4,"",'LRB',0,'C');
	  $pdf->Cell(20,4,"",'LRB',0,'C');
	  $pdf->Ln(4);


	//ahora mostramos el final de la factura
	$pdf->Ln(10);
	$pdf->Cell(36);

	$pdf->SetFillColor(255,191,116);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',8);


$pdf->Cell(30,4,$lang->t('forma_pago'),1,0,'C',1);
    $pdf->Cell(30,4,$lang->t('base_imponible'),1,0,'C',1);
	$pdf->Cell(30,4,$lang->t('couta_iva'),1,0,'C',1);
	$pdf->Cell(30,4,$lang->t('iva'),1,0,'C',1);
	$pdf->Cell(35,4,$lang->t('total'),1,0,'C',1);
	$pdf->Ln(4);

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','',8);

	$pdf->Cell(36);
    $importe4=number_format($importe,2,",",".");
//esta cambio
    $pdf->Cell(30,4,$formadepago,1,0,'R',1);
    $pdf->Cell(30,4,$importe4,1,0,'R',1);
	$pdf->Cell(30,4,$lafila["iva"] . "%",1,0,'C',1);

	$ivai=$lafila["iva"];
	$impo=$importe*($ivai/100);
	$impo=sprintf("%01.2f", $impo);
	$total=$importe+$impo;
	$total=sprintf("%01.2f", $total);

	$impo=number_format($impo,2,",",".");
	$pdf->Cell(30,4,"$impo",1,0,'R',1);
    $total=sprintf("%01.2f", $total);
	$total2= number_format($total,2,",",".");
	$pdf->Cell(35,4,"$total2"." ".$companyData['moneda'],1,0,'R',1);
	$pdf->Ln(4);


     // @mysqli_free_result($resultado);
     // @mysqli_free_result($query);
	 // @mysqli_free_result($resultado2);
	 // @mysqli_free_result($query3);

$pdf->Output();
ob_end_flush(); 
?>
