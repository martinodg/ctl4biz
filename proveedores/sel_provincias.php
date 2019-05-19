<?php

// Connects to your Database 

 include "../conectar7.php";
 $id_pais = $_GET['pais'];
 echo "<script type='text/javascript'>console.error('$id_pais');</script>";
 $query_provincias="SELECT codprovincia, nombreprovincia FROM provincias WHERE codpais='$id_pais' ORDER BY nombreprovincia ASC";
				$res_provincias=mysqli_query($conexion,$query_provincias);
                $nr_provincias= mysqli_num_rows($res_provincias);
                 while ($nr_provincias > 0) {
                            $row = mysqli_fetch_row($res_provincias);
                            echo '<option >'.$row[1].'</option>';
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                            $nr_provincias--;
                        }
?>

 
