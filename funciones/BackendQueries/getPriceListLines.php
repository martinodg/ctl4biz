<?php
require_once("../../conectar7.php"); 
$errorMessage='';
$where='';

// Get arguments 
if(isset($_GET['pLName'])) {$pLName=$_GET['pLName'];
                            $where.='nombre like "'.$pLName.'" AND ';
                        }
if(isset($_GET['idPriceList'])) {$idPriceList=$_GET['idPriceList'];
                                $where.='codLista like "'.$idPriceList.'" AND ';
                        }
if(isset($_GET['iniciopagina'])) { $paginainicio=$_GET['iniciopagina'];
        if ($paginainicio==""){$paginainicio=0;}
} else {
    
        $paginainicio=0;
    
}

//Set tools
if(isset($_GET['toolVer'])) {$toolVer=$_GET['toolVer'];
    
}else{$toolVer=0;}
if(isset($_GET['toolModificar'])) {$toolModificar=$_GET['toolModificar'];
   
}else{$toolModificar=0;}
if(isset($_GET['toolSeleccionar'])) {$toolSeleccionar=$_GET['toolSeleccionar'];
    
}else{$toolSeleccionar=0;}
if(isset($_GET['toolEliminar'])) {$toolEliminar=$_GET['toolEliminar'];
    
}else{$toolEliminar=0;}



    $query_lines="SELECT listaDePrecios.codLista FROM listaDePrecios WHERE $where 1=1";    
    //echo $query_lines;
	$rs_linesNumber = mysqli_query($conexion,$query_lines);
    $linesNumber= mysqli_num_rows($rs_linesNumber);
    echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$linesNumber.'">';
    
   

    $query="SELECT listaDePrecios.codLista, listaDePrecios.nombre, listaDePrecios.porcentaje FROM listaDePrecios WHERE $where 1=1 ORDER BY listaDePrecios.codLista LIMIT ".$paginainicio.",10;";       

    $rs_table = mysqli_query($conexion,$query);
    $invoice_linesNumber= mysqli_num_rows($rs_table);
    $count=0;
                while ( $count < $invoice_linesNumber) {
                          
                            if ($count % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
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
							        echo '<td width="10%"><div align="center">'.$row[0].'</div></td>';
							        echo '<td width="40%"><div align="center">'.$row[1].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$row[2].'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$tool1.'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$tool2.'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$tool3.'</div></td>';
                                    echo '<td width="10%"><div align="center">'.$tool4.'</div></td>';
                                 
                                echo '</tr>';
                             echo '</table>';
                           
                             $count++;
                }

mysqli_close($conexion); 
?>