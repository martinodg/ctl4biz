<?php
 if(session_id() == '') {
    session_start();
}   
function newNumberLine($ftable,$fcodfacturatmp) {
    require("../../varConnUserDB.php"); 
    $conexion_f=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La funcion getNewLineNumber no puede conectar con la base de datos");
        //Ask for last codproceso and assing new value
	    $query = "SELECT max(numlinea) as maximo FROM ".$ftable." WHERE codfactura=".$fcodfacturatmp.";";
        $rs_table = mysqli_query($conexion_f,$query);
            $linesNumber= mysqli_num_rows($rs_table);
            while ($linesNumber > 0) {
                $row = mysqli_fetch_row($rs_table);
                $codlineatmp=$row[0];
                $linesNumber--;
            }
    mysqli_close($conexion_f); 
	//If the result of the query is null then this will be the rist entry on the table and 0 is assigned as previews entry code.
	if ($codlineatmp=="") { $codlineatmp="0";} 
	$codlineatmp++;            
    return $codlineatmp;
}
?>