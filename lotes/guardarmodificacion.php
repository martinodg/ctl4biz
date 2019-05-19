<?php
include ("../conectar7.php"); 
include ("../mysqli_result.php"); 


    $codlote=$_GET["codlote"];
    $cantidad=$_GET["cantidad"];
    $estado=$_GET["estado"];
    
    
    If ($cantidad and $fechaf and $fechai and $horaf <>""){
    //code to insert the date on the DB  
   
               
                
                //insert in DB
                $query_operacion="INSERT INTO lote (codlote, codarticulo, cantidad, fechai, horai, codstatus, borrado) VALUES ('$codlote', '$codarticulo', '$cantidad', '$fechai', '$horai', '0', '0')";				
		/*echo $query_operacion;*/

                $rs_operacion=mysqli_query($conexion,$query_operacion);
		
	/*	$codlote=mysqli_insert_id(); */
                
                
                
        echo "<div class=\"header\">ATENCION: El lote ha sido creado exitosamente con el codigo '$codlote'!!</div>";
        echo mysqli_error($conexion) ;
    }else{
       echo "<div class=\"mensaje\">ATENCION: Los Campos relativos al articulo del lote son obligatorios!</div>";
    }
 
mysqli_close($conexion);   
	
?>
