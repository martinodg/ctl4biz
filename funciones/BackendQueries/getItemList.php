<?php
require_once("../../conectar7.php"); 
$errorMessage='';

// Get arguments 

//build filters
$where="";
if(isset($_GET['idCategory'])) {$idCategory=$_GET['idCategory'];
    if($idCategory>0){
        $where=$where."articulos.codfamilia='$idCategory' AND ";
    }     
}
if(isset($_GET['referencia'])) {$referencia=$_GET['referencia'];
   // $donde=$donde."articulos.descripcion LIKE '".$nombrearticulo."%' AND ";
    $where=$where."articulos.referencia LIKE '$referencia%' AND ";
}
if(isset($_GET['descripcion'])) {$descripcion=$_GET['descripcion'];
    $where=$where."articulos.descripcion LIKE '%$descripcion%' AND ";
}

if(isset($_GET['paginainicio'])) {$paginainicio=$_GET['paginainicio'];
}

  $query_nroLineas="SELECT codarticulo FROM articulos WHERE $where articulos.borrado='0'";
    //echo $query_nroLineas;

        $rs_nroLineas = mysqli_query($conexion,$query_nroLineas);
    $nr_Lineas= mysqli_num_rows($rs_nroLineas);
    echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';
	//echo "nro lineas:".$nr_Lineas;
//Set tools
if(isset($_GET['toolVer'])) {$toolVer=$_GET['toolVer'];
    
}else{$toolVer=0;}
if(isset($_GET['toolModificar'])) {$toolModificar=$_GET['toolModificar'];
   
}else{$toolModificar=0;}
if(isset($_GET['toolSeleccionar'])) {$toolSeleccionar=$_GET['toolSeleccionar'];
    
}else{$toolSeleccionar=0;}
if(isset($_GET['toolEliminar'])) {$toolEliminar=$_GET['toolEliminar'];
    
}else{$toolEliminar=0;}
    
   
//Query SQL
    $query="SELECT articulos.codarticulo, familias.nombre, articulos.descripcion, articulos.precio_pvp, unidadesmedidas.nombre, articulos.impuesto FROM articulos, unidadesmedidas, familias WHERE $where articulos.codfamilia=familias.codfamilia AND articulos.codunidadmedida=unidadesmedidas.codunidadmedida AND articulos.borrado='0' AND articulos.codfamilia<>'0' ORDER BY articulos.descripcion LIMIT ".$paginainicio.",10;";     
    //echo $query;  
	$rs_table = mysqli_query($conexion,$query);
    $linesNumber= mysqli_num_rows($rs_table);
                echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                while ($linesNumber > 0) {
                            if ($linesNumber % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_table);
                            //Assign tool and row number for function associated.
                            if($toolVer=="1") {
                                $tool1="<a href=#><img src=../img/ver.svg width=16 height=16 border=0 onClick=show(&#39;$row[0]&#39;) ></a>";
                            }else{$tool1="";}
                            if($toolModificar=="1") {
                                $tool2="<a href=#><img src=../img/modificar.svg width=16 height=16 border=0 onClick=modify(&#39;$row[0]&#39;) ></a>";
                            }else{$tool2="";}
                            if($toolSeleccionar=="1") {
                                $tool3="<a href=#><img src=../img/convertir.svg width=16 height=16 border=0  onClick=select(&#39;$row[0]&#39;) ></a>";
                            }else{$tool3="";}
                            if($toolEliminar=="1") {
                                $tool4="<a href=#><img src=../img/eliminar.svg width=16 height=16 border=0  onClick=remove(&#39;$row[0]&#39;) ></a>";
                            }else{$tool4="";}


                            echo '<tr class="'.$fondolinea.'">';
							        echo '<td width="5%"><div align="center">'.$row[0].'</td>';
							        echo '<td width="15%"><div align="center">'.$row[1].'</div></td>';
							        echo '<td width="20%"><div align="center">'.$row[2].'</div></td>';
                                    echo '<td width="18%"><div align="center">'.$row[3].'</div></td>';
                                    echo '<td width="15%"><div align="center">'.$row[4].'</div></td>';
                                    echo '<td width="15%"><div align="center">'.$row[5].'</div></td>';
                                    echo '<td width="3%"><div align="center">'.$tool1.'</div></td>';
                                    echo '<td width="3%"><div align="center">'.$tool2.'</div></td>';
                                    echo '<td width="3%"><div align="center">'.$tool3.'</div></td>';
                                    echo '<td width="3%"><div align="center">'.$tool4.'</div></td>';

                                echo '</tr>';
                              $linesNumber--;
                }
                echo '</table>';
                           

mysqli_close($conexion); 
?>
