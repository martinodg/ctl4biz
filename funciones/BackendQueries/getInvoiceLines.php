<?php
require_once("../../conectar7.php"); 
$errorMessage='';

// Get arguments 
if(isset($_GET['docType'])) {$docType=$_GET['docType'];}else{$errorMessage.="getInvoiceLines.php Messages: doctype is needed in order to get invoice lines";}
if(isset($_GET['idInvoice'])) {$idInvoice=$_GET['idInvoice'];}else{$errorMessage.="client code is required in order to get invoice lines";}
if(isset($_GET['paginainicio'])) {$paginainicio=$_GET['paginainicio'];}else{
    $errorMessage.="If paginainicio parameter is not present pagination function will be disabled. <br>";
    $paginainicio=0;
    
}

// Check docType argument
if ($docType=="tempInvoice"){
    $table="factulineatmp";
    $indxField="numlinea";
}else{ $errorMessage.= "Unknown doctype. $docType"; }

/* pagination script, check later 
if($_POST) {
	$page = $_POST['page']; // Current page number
	$per_page = $_POST['per_page']; // Articles per page
	if ($page != 1) $start = ($page-1) * $per_page;
	else $start=0;
}
*/

    $query_lines="SELECT $table.$indxField FROM $table WHERE $table.codfactura='$idInvoice'";    
	$rs_linesNumber = mysqli_query($conexion,$query_lines);
    $linesNumber= mysqli_num_rows($rs_linesNumber);
    echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$linesNumber.'">';
    
   

    $query="SELECT $table.numlinea, articulos.descripcion, $table.precio, $table.cantidad, unidadesmedidas.nombre, $table.dcto, $table.importe, $table.TAX FROM $table, articulos, unidadesmedidas WHERE $table.codfactura='$idInvoice' AND $table.codigo=articulos.codarticulo AND articulos.codunidadmedida=unidadesmedidas.codunidadmedida ORDER BY $table.$indxField LIMIT ".$paginainicio.",10;";       
	$rs_table = mysqli_query($conexion,$query);
    $invoice_linesNumber= mysqli_num_rows($rs_table);
                while ($invoice_linesNumber > 0) {
                            if ($invoice_linesNumber % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_table);
                            echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                                echo '<tr class="'.$fondolinea.'">';
							        echo '<td width="10%"><div align="center">'.$row[0].'</td>';
							        echo '<td width="20%"><div align="center">'.$row[1].'</div></td>';
							        echo '<td width="10%"><div align="center">'.$row[2].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$row[3].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$row[4].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$row[5].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$row[6].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$row[7].'</div></td>';
                                    echo '<td width="10%"><div align="center"><a href="#"><img src="../img/eliminar.svg" width="16" height="16" border="0"  onClick="remove('.$row[0].')" title="remove"></a></div></td>';
                                echo '</tr>';
                             echo '</table>';
                           
                             $invoice_linesNumber--;
                }
echo $errorMessage;
mysqli_close($conexion); 
?>
