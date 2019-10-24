<?php
include ("../conectar7.php"); 


    $mproceso=$_GET["mproceso"];
    
    $consulta="SELECT metaprocesos.codproceso, metaprocesos.nombre, metaprocesos.esbatch, metaprocesos.codstatus FROM metaprocesos WHERE metaprocesos.codproceso =".$mproceso.";";
  /*  echo $consulta;*/
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_procesos= mysqli_num_rows($rs_tabla);
                 while ($nr_procesos > 0) {
                            $row = mysqli_fetch_row($rs_tabla);
                                    $data['codproceso']= $row[0];
                                    $data['nombre']= $row[1];
                                    $data['esbatch']= $row[2];
                                    $data['codstatus']= $row[3];
                                    echo json_encode($data);
                              
                        $nr_procesos--;
                        }
	
?>
