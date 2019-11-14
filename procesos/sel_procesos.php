<?php

// Connects to your Database 

 include "../conectar7.php";


 $query_proceso="SELECT codproceso, nombre FROM metaprocesos ORDER BY nombre ASC;";
				$res_proceso = mysqli_query($conexion,$query_proceso);
                $nr_proceso = mysqli_num_rows($res_proceso);
                 while ($nr_proceso > 0) {
                            $row = mysqli_fetch_row($res_proceso);
                            echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                            $nr_proceso--;
                        }
?>

 
