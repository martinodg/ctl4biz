<?php

// Connects to your Database 

 include "./conectar7.php";
 
 if (isset($_GET["articulo"])) {$articulo=$_GET["articulo"];}
 if (isset($_GET["campo"])) {$campo=$_GET["campo"];}
//$articulo=$_GET['articulo'];
//$campo=$_GET['campo'];
if (isset($campo) & isset($articulo)) {
 $query_value="SELECT $campo FROM `articulos` WHERE codarticulo='$articulo';";
//echo $query_value;
 $res_value=mysqli_query($conexion,$query_value);
 $pre_value=mysqli_fetch_array($res_value);
 $value=$pre_value[$campo];
}

 $query_unidadesmedidas="SELECT codunidadmedida, nombre FROM unidadesmedidas ORDER BY codunidadmedida ASC";
				$res_unidadesmedidas=mysqli_query($conexion,$query_unidadesmedidas);
                $nr_unidadesmedidas= mysqli_num_rows($res_unidadesmedidas);
                 while ($nr_unidadesmedidas > 0) {
                            $row = mysqli_fetch_row($res_unidadesmedidas);
                            if($row[0]==$value){
                                                $selected='selected="selected"';
                                                }else{
                                                     $selected='';
                                                }
                            echo '<option value="'.$row[0].'" '.$selected.'>'.$row[1].'</option>';
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                       $nr_unidadesmedidas--;
                        }
?>

 
