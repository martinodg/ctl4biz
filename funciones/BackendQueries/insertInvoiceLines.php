<?
require_once("../../varConnUserDB.php"); 
require_once("getNewLineNumber.php"); 

$errorMessage='';
$conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");

if(isset($_GET['codFacturat'])) {$codFacturat=$_GET['codFacturat'];
}else{ $errorMessage.= "Error. temporary invoice number is mandatory."; }

if(isset($_GET['codFactura'])) {$codFactura=$_GET['codFactura'];}

//check doctype argument

if (isset($_GET['docType'])) { $doctype=$_GET['docType'];

	if ($doctype=="tempInvoice"){

		$table="factulineatmp";
		
		if(isset($_GET['codfamilia'])) {$codfamilia=$_GET['codfamilia'];
		}else{ $errorMessage.= "Error. Item family code is mandatory."; }
	
		if(isset($_GET['codArticulo'])) {$codArticulo=$_GET['codArticulo'];
		}else{ $errorMessage.= "Error. Item  code is mandatory."; }
	
		if(isset($_GET['cantidad'])) {$cantidad=$_GET['cantidad'];
		}else{ $errorMessage.= "Error. Item  quantity is mandatory."; }
	
	 	if(isset($_GET['precio'])) {$precio=$_GET['precio'];
	 	}else{ $errorMessage.= "Error. Item  price is mandatory."; }
	
	 	if(isset($_GET['importe'])) {$importe=$_GET['importe'];
		}else{ $errorMessage.= "Error. total amount is mandatory."; }
	
	 	if(isset($_GET['dscto'])) {$dscto=$_GET['dscto'];
		}
	
		if(isset($_GET['impuesto'])) {$impuesto=$_GET['impuesto'];
		}else{ $errorMessage.= "Error. Item  TAX is mandatory."; }
	 
		$codLineTmp=newNumberLine($table,$codFacturat);

		$insert_invoice="INSERT INTO $table (codfactura, numlinea, codfamilia, codigo, cantidad, precio, importe, dcto, TAX) VALUE ('$codFacturat','$codLineTmp','$codfamilia','$codArticulo','$cantidad','$precio','$importe','$dscto','$impuesto');";
		
		$rs_invoice=mysqli_query($conexion,$insert_invoice);

	}else{ 	if ($doctype=="Invoice"){
				$table="factulinea";
				$insertInvoiceLines_fromTmp="INSERT INTO $table (codfactura,numlinea,codfamilia,codigo, cantidad,precio,importe,dcto,TAX) SELECT $codFactura, numlinea,codfamilia,codigo,cantidad,precio,importe,dcto,TAX FROM factulineatmp WHERE codfactura=$codFacturat ORDER BY numlinea ASC";
				$rs_invoice=mysqli_query($conexion,$insertInvoiceLines_fromTmp);
				echo '<div align="center">';
				echo '<button type="button" id="btnsalir" onClick="salir()" onMouseOver="style.cursor=cursor"> <img src="../img/cerrar.svg" alt="aceptar" /> <span id="tsalir">Salir</span> </button>';  	
				echo '<button type="button" id="btnimprimir" onClick="imprimir()"onMouseOver="style.cursor=cursor"> <img src="../img/dinero.svg" alt="nuevo" /> <span id="tpagar">Pagar</span> </button>';			    
				echo '<button type="button" id="bpagar" onClick="pagar()"onMouseOver="style.cursor=cursor"> <img src="../img/caja.svg" alt="nuevo" /> <span id="timpr">Imprimir</span> </button>';			    
				echo '</div>';
			}else{
					$errorMessage.= "Unknown doctype. "; 
			}
	}
}


	
	mysqli_close($conexion);



?>