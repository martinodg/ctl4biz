<?
include ("../conectar7.php"); 


    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $criterio2=$_GET["criterio2"];
    $parametro2=$_GET["parametro2"];
    $criterio3=$_GET["criterio3"];
    $parametro3=$_GET["parametro3"];
    $donde=$criterio1."=".$parametro1." AND ";
    if ($parametro2<>""){ $donde=$donde.$criterio2."=".$parametro2." AND ";}
    if ($parametro3<>""){$donde=$donde.$criterio3."=".$parametro3." AND ";}

    
	$consulta="SELECT * FROM lote WHERE ".$donde."borrado=0";
    /* echo $consulta;*/
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_lotes= mysqli_num_rows($rs_tabla);
                 while ($nr_lotes > 0) {
                             if ($nr_lotes % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        echo '<table class="fuente8" width="87%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td class="aCentro" width="8%">'.$row[0].'</td>';
							echo '<td width="6%"><div align="center">'.$row[1].'</div></td>';
							echo '<td width="38%"><div align="left">'.$row[2].'</div></td>';
							echo '<td class="aDerecha" width="6%"><div align="center">'.$row[3].'</div></td>';
							echo '<td class="aDerecha" width="6%"><div align="center">'.$row[4].'</div></td>';
                                                        echo '<td class="aDerecha" width="6%"><div align="center">'.$row[5].'</div></td>';
                                                        echo '<td class="aDerecha" width="6%"><div align="center">'.$row[6].'</div></td>';
							echo '<td width="5%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0"  title="Modificar"></a></div></td>';
							echo '	<td width="5%"><div align="center"><a href="#"><img src="../img/ver.svg" width="16" height="16" border="0" title="Visualizar"></a></div></td>';
						        echo '<td width="6%"><div align="center"><a href="#"><img src="../img/eliminar.svg" width="16" height="16" border="0"  title="Eliminar"></a></div></td>';
                              echo '</tr>';
                        echo '</table>';
                           /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                            $nr_lotes--;
                        }
	
?>
