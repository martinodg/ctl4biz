<?php
require_once("../../conectar7.php"); 
$errorMessage='';

// Get arguments 

//build filters
if(isset($_GET['tipoLista'])) {$tipoLista=$_GET['tipoLista'];}
if(isset($_GET['codLista'])) {$codLista=$_GET['codLista'];}

$where="";
if(isset($_GET['idCategory'])) {$idCateogory=$_GET['idCategory'];
    if($idCateogory>0){
        $where=$where."articulos.codfamilia='$idCateogory' AND ";
    }
    
}
if(isset($_GET['referencia'])) {$referencia=$_GET['referencia'];
    if(!empty($referencia)){
        $where=$where."articulos.referencia LIKE '$referencia%' AND ";
    }
}
if(isset($_GET['descripcion'])) {$descripcion=$_GET['descripcion'];
    if(!empty($descripcion)){
        $where=$where."articulos.descripcion LIKE '%$descripcion%' AND ";
    }
}

if(isset($_GET['codarticulo'])) {$codarticulo=$_GET['codarticulo'];
    if(!empty($codarticulo)){
        $where=$where."(articulos.codarticulo*1)='$codarticulo' AND ";
    }
}
if(isset($_GET['paginainicio'])) {
    $paginainicio=$_GET['paginainicio'];
}

  $query_nroLineas="SELECT codarticulo FROM articulos WHERE $where articulos.borrado='0'";
  $rs_nroLineas = mysqli_query($conexion,$query_nroLineas);
   $nr_Lineas= mysqli_num_rows($rs_nroLineas);
    echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';
	//echo "nro lineas:".$nr_Lineas;
//Set tools$query_nroLineas
if(isset($_GET['toolVer'])) {$toolVer=$_GET['toolVer'];
    
}else{$toolVer=0;}
if(isset($_GET['toolModificar'])) {$toolModificar=$_GET['toolModificar'];
   
}else{$toolModificar=0;}
if(isset($_GET['toolSeleccionar'])) {$toolSeleccionar=$_GET['toolSeleccionar'];
    
}else{$toolSeleccionar=0;}
if(isset($_GET['toolEliminar'])) {$toolEliminar=$_GET['toolEliminar'];
    
}else{$toolEliminar=0;}
    
   
//Query SQL
    switch($tipoLista){
        case "listaPrecio":
            //reformat where for join query
            $where='';
            if($idCateogory>0){
                $where=$where."codf='$idCateogory' AND ";
            }
            if(!empty($codarticulo)){
                $where=$where."(cda*1)='$codarticulo' AND ";
            }
            if(!empty($descripcion)){
                $where=$where."dsc LIKE '%$descripcion%' AND ";
            }
            $query="SELECT * FROM
            (SELECT articulos.codarticulo as cda, familias.nombre, articulos.descripcion as dsc, 
                   margenPorArticulo.porcentaje,  articulos.codfamilia as codf, margenPorArticulo.codlista as codlst
            FROM articulos 
            LEFT JOIN familias
            ON articulos.codfamilia=familias.codfamilia 
            LEFT JOIN margenPorArticulo
            ON articulos.codarticulo=margenPorArticulo.codarticulo and margenPorArticulo.codlista=$codLista)reslt WHERE $where 1=1;";
            break;
        default:
            $query="SELECT articulos.codarticulo, familias.nombre, articulos.descripcion, articulos.precio_pvp, unidadesmedidas.nombre, articulos.impuesto FROM articulos, unidadesmedidas, familias WHERE $where articulos.codfamilia=familias.codfamilia AND articulos.codunidadmedida=unidadesmedidas.codunidadmedida ORDER BY articulos.descripcion";
            break;
    }

    //echo $query;  
	$rs_table = mysqli_query($conexion,$query);
    $linesNumber= mysqli_num_rows($rs_table);
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



                            echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                                echo '<tr class="'.$fondolinea.'">';
                                switch($tipoLista){
                                    case "listaPrecio":
                                        echo '<td width="10%"><div align="center">'.$row[0].'</td>';
                                        echo '<td width="20%"><div align="center">'.$row[1].'</div></td>';
                                        echo '<td width="40%"><div align="center">'.$row[2].'</div></td>';
                                        echo '<td width="10%"><div align="center">'.$row[3].'</div></td>';
                                        echo '<td width="5%"><div align="center">'.$tool1.'</div></td>';
                                        echo '<td width="5%"><div align="center">'.$tool2.'</div></td>';
                                        echo '<td width="5%"><div align="center">'.$tool3.'</div></td>';
                                        echo '<td width="5%"><div align="center">'.$tool4.'</div></td>';
                                        break;
                                    default:
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
                                        break;
                            }
                                echo '</tr>';
                             echo '</table>';
                           
                             $linesNumber--;
                }

mysqli_close($conexion); 
?>
