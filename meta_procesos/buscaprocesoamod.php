<?php
include ("../conectar7.php"); 


    $proceso=$_GET["proceso"];
    
    $consulta="SELECT proceso.codproceso, articulos.referencia, proceso.cantidad, proceso.fechai, proceso.horai, proceso.codstatus, proceso.codarticulo FROM proceso, articulos WHERE proceso.codproceso =".$proceso." AND proceso.codarticulo=articulos.codarticulo AND proceso.codstatus!=1 AND proceso.borrado=0;";
  /*  echo $consulta;*/
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_procesos= mysqli_num_rows($rs_tabla);
                 while ($nr_procesos > 0) {
                            $row = mysqli_fetch_row($rs_tabla);
                                    $data['codproceso']= $row[0];
                                    $data['articulo']= $row[1];
                                    $data['cantidad']= $row[2];
                                    $data['fechai']= $row[3];
                                    $data['horai']= $row[4];
                                    $data['status']= $row[5];
                                    $data['codarticulo']= $row[6];
                                    echo json_encode($data);
                              
                        $nr_procesos--;
                        }
	
?>
