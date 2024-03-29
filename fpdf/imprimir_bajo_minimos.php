<?php


define('FPDF_FONTPATH','font/');
require('mysqli_table.php');
$cadena = '';
$empresa=$_POST["cmbempresa"];
if ($empresa==0) { require_once("comunes.php"); }
if ($empresa==1) { require_once("comunes2.php"); }
require_once("../conectar7.php"); 
require_once("../utiles/fecha_hispana.php");
require_once("../funciones/changelanguage.php");
$lang = new ChangeLanguage();
$pdf=new PDF();
$pdf->Open();
$pdf->AddPage();

$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',7);
$pdf->SetY(30);
$pdf->SetX(0);
$pdf->MultiCell(180,6,$cadena,0,R,0);


//Nombre del Listado
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',16);
$pdf->SetY(50);
$pdf->SetX(0);
$pdf->MultiCell(220,6,$lang->t('listado_articulos_bajo_minimos'),0,'C',0);

$pdf->Ln();    

//Ttulos de las columnas
$header=array($lang->t('item'),$lang->t('familia'),$lang->t('cod_artculo'),$lang->t('descripcion'),$lang->t('costo'),$lang->t('stock'),$lang->t('bajo_minimos'));

//Colores, ancho de lnea y fuente en negrita
    $pdf->SetFillColor(200,200,200);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.2);
    $pdf->SetFont('Arial','B',10);
	
//Cabecera
    $w=array(10,25,30,60,15,10,25);
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $pdf->Ln();
	
//Restauracin de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);


//Buscamos y listamos las familias

$consulta = "select articulos.codigo as cod,articulos.descripcion,articulos.stock,
			articulos.costo,articulos.bajominimo,familia.id,familia.familia 
			from articulos,familia where articulos.borrado=0 AND familia.borrado=0 AND
			articulos.codfamilia=familia.id AND articulos.stock<=articulos.bajominimo AND articulos.bajominimo > 0 
			ORDER BY familia ASC,cod ASC";
$query = mysqli_query($conexion,$consulta);
$item=1; 	  
while ($row = mysqli_fetch_array($query))
        {

		  //imprimo el articulo
		  	$pdf->Cell($w[0],5,$item,'LRTB',0,'C');
		   	$acotado = substr($row["familia"], 0, 15);
		    $pdf->Cell($w[1],5,$acotado,'LRTB',0,'C');
			
			$acotado = substr($row["cod"], 0, 12);
			$pdf->Cell($w[2],5,$acotado,'LRTB',0,'L');

			$acotado = substr($row["descripcion"], 0, 45);
			$pdf->Cell($w[3],5,$acotado,'LRTB',0,'L');
			
			$costo = $row["costo"] . " $";
			$costo=number_format($costo,2,",",".");
			$pdf->Cell($w[4],5,$costo." $",'LRTB',0,'R');

			$pdf->Cell($w[5],5,$row["stock"],'LRTB',0,'R');
			
			$pdf->Cell($w[6],5,$row["bajominimo"],'LRTB',0,'R');
			$item++;
			$pdf->Ln();			  

        };

$pdf->Cell(array_sum($w),0,'','T');			
$pdf->Output();
ob_end_flush(); 
?> 
