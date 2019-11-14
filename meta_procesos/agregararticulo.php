<?php
include ("../conectar7.php"); 
include ("../mysqli_result.php"); 

    $codmproc=$_GET["codmproceso"];
    $nombreproceso=$_GET["nombremproceso"];
    $batch=$_GET["batch"];
    $codarticulo=$_GET["codart"];
    $nombrearticulo=$_GET["nombreart"];
    $cantidad=$_GET["cantidadart"];
    
    
    If ($nombreproceso and $codarticulo and $nombrearticulo and $cantidad<>""){

        //verify last pocess on the process table
        $consultaprevio = "SELECT max(codproceso) as maximo FROM metaprocesos";
        $rs_consultaprevio=mysqli_query($conexion,$consultaprevio);
        $ultimoproceso=mysqli_result($rs_consultaprevio,0,"maximo");
        echo "<div class=\"header\">codigo proceso en form: '$codmproc'!!</div>";
        echo "<div class=\"header\">ultimo proceso en tabla es: '$ultimoproceso'!!</div>";
       
    //if no code of meta-process is defined then no metaproces exist for this entry and we will create it at following.  
        if ($codmproc==""||$codmproc>$ultimoproceso){
            echo "<div class=\"header\">dado que el proceso pasado en el form es nulo o menora al ultimo proceso entro al if!!</div>";
                                $codproceso=$ultimoproceso;
                                //If the result of the query is null then this will be the rist entry on the table and 0 is assigned as previews entry code.
                                if ($codproceso=="") { $codproceso=0;} 
                                $codproceso++;
                                //insert the new entry on meta-process table.
                                $query_creamproceso="INSERT INTO metaprocesos (codproceso, esbatch, codarticulo, nombre, codstatus) VALUES ('$codproceso','$batch','$codarticulo','$nombreproceso','4')";
                                $rs_creaproceso=mysqli_query($conexion,$query_creamproceso);
                                $data2['codmproc']= $codproceso;
                                echo json_encode($data2); 
                        }else{
                                $codproceso=$codmproc;

                        }

                
    //verify the last code linea for this code meta-process
    $codlineaprevia = "SELECT max(codlinea) as maximo FROM metaprocesoslinea WHERE codproceso='$codproceso'";
		                        $rs_codlineaprevia=mysqli_query($conexion,$codlineaprevia);
		                        $codlinea=mysqli_result($rs_codlineaprevia,0,"maximo");
                                //If the result of the query is null then this will be the rist entry on the table and 0 is assigned as previews entry code.
                                if ($codlinea=="") { $codlinea=0;} 
                                $codlinea++;                
    //insert the item to add into the table metaprocesoslinea
        $query_operacion="INSERT INTO metaprocesoslinea (codproceso, codlinea, codarticulo, cantidad) VALUES ('$codproceso','$codlinea',$codarticulo,'$cantidad')";				
		                /*echo $query_operacion;*/

                        $rs_operacion=mysqli_query($conexion,$query_operacion);
		
	                    /*	$codproceso=mysqli_insert_id($conexion); */
                                    
                
            
        echo "<div class=\"header\">ATENCION: El proceso ha sido creado exitosamente con el codigo '$codproceso'!!</div>";
        echo mysqli_error($conexion) ;
    }else{
       echo "<div class=\"mensaje\">ATENCION: Los Campos relativos al articulo del proceso son obligatorios!</div>";
    }
       
mysqli_close($conexion);   
	
?>
