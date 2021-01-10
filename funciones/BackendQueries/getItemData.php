<?php
require_once("../../conectar7.php"); 
$errorMessage='';

// Get arguments 
if(isset($_GET['idCategory'])) {$idCateogory=$_GET['idCategory'];
    $where="articulos.codfamilia='$idCategory' AND ";
}else{
    $where="";
}




    
   

    $query="SELECT articulos.codarticulo, familias.nombre, articulos.descripcion, articulos.precio_pvp, unidadesmedidas.nombre, articulos.impuesto FROM articulos, unidadesmedidas, familias WHERE $where articulos.codfamilia=familias.codfamilia AND articulos.codunidadmedida=unidadesmedidas.codunidadmedida ORDER BY articulos.descripcion";       
	$rs_table = mysqli_query($conexion,$query);
    $linesNumber= mysqli_num_rows($rs_table);
                while ($linesNumber > 0) {
                            if ($linesNumber % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_table);
                            echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                                echo '<tr class="'.$fondolinea.'">';
							        echo '<td width="10%"><div align="center">'.$row[0].'</td>';
							        echo '<td width="10%"><div align="center">'.$row[1].'</div></td>';
							        echo '<td width="10%"><div align="center">'.$row[2].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$row[3].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$row[4].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$row[5].'</div></td>';
                                    echo '<td width="10%"><div align="center"><a href="#"><img src="../../img/eliminar.svg" width="16" height="16" border="0"  onClick="remove('.$row[0].')" title="remove"></a></div></td>';
                                echo '</tr>';
                             echo '</table>';
                           
                             $linesNumber--;
                }

mysqli_close($conexion); 
?>
