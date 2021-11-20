<?php
require_once("../../conectar7.php");
$errorMessage = '';

// Get arguments 
if (isset($_GET['docType'])) {
    $docType = $_GET['docType'];
} else {
    $errorMessage .= "getInvoiceLines.php Messages: doctype is needed in order to get invoice lines";
}
if (isset($_GET['idInvoice'])) {
    $idInvoice = $_GET['idInvoice'];
} else {
    $errorMessage .= "client code is required in order to get invoice lines";
}
if (isset($_GET['paginainicio'])) {
    $paginainicio = $_GET['paginainicio'];
} else {
    //$errorMessage.="If paginainicio parameter is not present pagination function will be disabled. <br>";
    $paginainicio = 0;

}
//Set tools
if (isset($_GET['toolVer'])) {
    $toolVer = $_GET['toolVer'];

} else {
    $toolVer = 0;
}
if (isset($_GET['toolModificar'])) {
    $toolModificar = $_GET['toolModificar'];

} else {
    $toolModificar = 0;
}
if (isset($_GET['toolSeleccionar'])) {
    $toolSeleccionar = $_GET['toolSeleccionar'];

} else {
    $toolSeleccionar = 0;
}
if (isset($_GET['toolEliminar'])) {
    $toolEliminar = $_GET['toolEliminar'];

} else {
    $toolEliminar = 0;
}

// Check docType argument
if ($docType == "tempInvoice") {
    $table = "factulineatmp";
    $indxField = "numlinea";
} else {
    if ($docType == "Invoice") {
        $table = "factulinea";
        $indxField = "numlinea";
    } else {
        $errorMessage .= "Unknown doctype. $docType";
    }
}

/* pagination script, check later 
if($_POST) {
	$page = $_POST['page']; // Current page number
	$per_page = $_POST['per_page']; // Articles per page
	if ($page != 1) $start = ($page-1) * $per_page;
	else $start=0;
}
*/

$query_lines = "SELECT $table.$indxField FROM $table WHERE $table.codfactura='$idInvoice'";
$rs_linesNumber = mysqli_query($conexion, $query_lines);
$linesNumber = mysqli_num_rows($rs_linesNumber);
echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="' . $linesNumber . '">';


$query = "SELECT $table.numlinea, articulos.descripcion, $table.precio, $table.cantidad, unidadesmedidas.nombre, $table.dcto, $table.importe, impuestos.valor FROM $table, articulos, unidadesmedidas, impuestos WHERE $table.codfactura='$idInvoice' AND $table.codigo=articulos.codarticulo AND articulos.codunidadmedida=unidadesmedidas.codunidadmedida AND impuestos.codimpuesto=$table.TAX ORDER BY $table.$indxField LIMIT " . $paginainicio . ",10;";
//echo $query;
$rs_table = mysqli_query($conexion, $query);
$invoice_linesNumber = mysqli_num_rows($rs_table);
$count = 0;
while ($count < $invoice_linesNumber) {
    $showline = 1 + $count;
    if ($count % 2) {
        $fondolinea = "itemParTabla";
    } else {
        $fondolinea = "itemImparTabla";
    }
    $row = mysqli_fetch_row($rs_table);
    //Assign tool and row number for function associated.
    if ($toolVer == "1") {
        $tool1 = "<a href=#><img src=../img/ver.svg width=16 height=16 border=0 onClick=show(&#39;$row[0]&#39;) ></a>";
    } else {
        $tool1 = "";
    }
    if ($toolModificar == "1") {
        $tool2 = "<a href=#><img src=../img/modificar.svg width=16 height=16 border=0 onClick=modify(&#39;$row[0]&#39;) ></a>";
    } else {
        $tool2 = "";
    }
    if ($toolSeleccionar == "1") {
        $tool3 = "<a href=#><img src=../img/convertir.svg width=16 height=16 border=0  onClick=select(&#39;$row[0]&#39;) ></a>";
    } else {
        $tool3 = "";
    }
    if ($toolEliminar == "1") {
        $tool4 = "<a href=#><img src=../img/eliminar.svg width=16 height=16 border=0  onClick=remove(&#39;$row[0]&#39;,&#39;$row[6]&#39;,&#39;$row[7]&#39;) ></a>";
    } else {
        $tool4 = "";
    }
    echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
    echo '<tr class="' . $fondolinea . '">';
    echo '<td width="10%"><div align="center">' . $showline . '</td>';
    echo '<td width="20%"><div align="center">' . $row[1] . '</div></td>';
    echo '<td width="10%"><div align="center">' . $row[2] . '</div></td>';
    echo '<td width="10%"><div align="center">' . $row[3] . '</div></td>';
    echo '<td width="10%"><div align="center">' . $row[4] . '</div></td>';
    echo '<td width="10%"><div align="center">' . $row[5] . ' %</div></td>';
    echo '<td width="10%"><div align="center">' . $row[6] . '</div></td>';
    echo '<td width="10%"><div align="center">' . $row[7] . ' %</div></td>';
    echo '<td width="2%"><div align="center">' . $tool1 . '</div></td>';
    echo '<td width="2%"><div align="center">' . $tool2 . '</div></td>';
    echo '<td width="2%"><div align="center">' . $tool3 . '</div></td>';
    echo '<td width="2%"><div align="center">' . $tool4 . '</div></td>';
    echo '<td width="2%">&nbsp;</td>';
    echo '</tr>';
    echo '</table>';

    $count++;
}
//echo $errorMessage;
mysqli_close($conexion);
?>
