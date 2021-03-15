<?php
require_once("../conectar7.php");

//@todo revisar si este es el metodo que se busca usar
echo '  <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>';
    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $criterio2=$_GET["criterio2"];
    $parametro2=$_GET["parametro2"];
    $criterio3=$_GET["criterio3"];
    $parametro3=$_GET["parametro3"];
    $paginainicio=$_GET["paginainicio"];
    
    $query_nroLineas="SELECT codlote FROM lote";
    /*echo $consulta;*/
        
	$rs_nroLineas = mysqli_query($conexion,$query_nroLineas);
    $nr_Lineas= mysqli_num_rows($rs_nroLineas);
    echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';


    $donde="lote.codarticulo=articulos.codarticulo AND lote.codstatus=estado.codestado AND ";
    if ($parametro1<>""){ $donde=$donde."lote.".$criterio1."='".$parametro1."' AND ";}
    if ($parametro2<>""){ $donde=$donde."lote.".$criterio2."='".$parametro2."' AND ";}
    if ($parametro3<>""){ $donde=$donde."lote.".$criterio3."='".$parametro3."' AND ";}

    echo '                      <div id="cabeceraResultado" class="header"> 
     					<span id="trelalot">relacion de LOTES</span></div>';
    echo '				<div id="frmResultado">';
    echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
    echo '					<tr class="cabeceraTabla">';
    echo '						<td width="8%"><span id="tcodigo">CODIGO</span></td>';
    echo '						<td width="38%"><span id="tvarticulo">ARTICULO</span></td>';
    echo '						<td width="6%"><span id="tcant">CANTIDAD</span></td>';
    echo '						<td width="6%"><span id="tfechin">Fecha de inicio</span></td>';
    echo '						<td width="6%"><span id="thinic">HORA DE INICIO</span></td>';
    echo '                                                <td width="6%"><span id="tfchafin">Fecha de fin</span></td>';
    echo '						<td width="6%"><span id="thorafincrt">HORA DE FIN</span></td>';
    echo '                                               <td width="6%"><span id="testado">ESTADO</span></td>';
    echo '						<td width="6%">&nbsp;</td>';
    echo '						<td width="5%">&nbsp;</td>';
    echo '					</tr>';
    echo '			</table>';
    echo '			</div>';
    
    
	$consulta="SELECT lote.codlote, articulos.descripcion, lote.cantidad, lote.fechai, lote.horai, lote.fechaf, lote.horaf, lote.codstatus, estado.estado FROM lote, articulos,estado WHERE ".$donde."lote.borrado=0 ORDER BY lote.codlote LIMIT ".$paginainicio.",10;";
    //echo $consulta;
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_lotes= mysqli_num_rows($rs_tabla);
                 while ($nr_lotes > 0) {
                             if ($nr_lotes % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td width="8%"><div align="center">'.$row[0].'</td>';
							echo '<td width="38%"><div align="center">'.$row[1].'</div></td>';
							echo '<td width="6%"><div align="center">'.$row[2].'</div></td>';
							echo '<td width="6%"><div align="center">'.$row[3].'</div></td>';
							echo '<td width="6%"><div align="center">'.$row[4].'</div></td>';
                                                        echo '<td width="6%"><div align="center">'.$row[5].'</div></td>';
                                                        echo '<td width="6%"><div align="center">'.$row[6].'</div></td>';
                                                        echo '<td width="6%"><div align="center">'.$row[8].'</div></td>';
                                                        if ($row[7]<>1){
                                                            echo '<td width="5%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0"  onClick="modificar('.$row[0].')" data-ttitle="modificar" title="Modificar"></a></div></td>';
                                                            echo '<td width="5%"><div align="center">&nbsp;</div></td>';
                                                        }else{
                                                            echo '<td width="5%"><div align="center"><img src="../img/end.svg" width="16" height="16" border="0" data-ttitle="visualizar" title="Visualizar"></a></div></td>';
                                                            echo '<td width="5%"><div align="center">&nbsp;</div></td>';                                                             
                                                        }
                              echo '</tr>';
                        echo '</table>';
                           /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                            $nr_lotes--;
                        }
	
?>
