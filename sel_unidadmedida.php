<?php

// Connects to your Database 

 include "./conectar7.php";

 $query_unidadesmedidas="SELECT codunidadmedida, nombre FROM unidadesmedidas ORDER BY nombre ASC";
				$res_unidadesmedidas=mysqli_query($conexion,$query_unidadesmedidas);
                $nr_unidadesmedidas= mysqli_num_rows($res_unidadesmedidas);
                 while ($nr_unidadesmedidas > 0) {
                            $row = mysqli_fetch_row($res_unidadesmedidas);
                            echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                       $nr_unidadesmedidas--;
                        }
?>

 
