<?php
require_once("../../conectar7.php"); 
//@todo revisar si este es el metodo que se busca usar
echo '  <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>';
if($_POST) {
	$page = $_POST['page']; // Current page number
	$per_page = $_POST['per_page']; // Articles per page
	if ($page != 1) $start = ($page-1) * $per_page;
	else $start=0;
}
    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $criterio2=$_GET["criterio2"];
    $parametro2=$_GET["parametro2"];
    $criterio3=$_GET["criterio3"];
    $parametro3=$_GET["parametro3"];
    $paginainicio=$_GET["paginainicio"];

    $query_nroLineas="SELECT codGrupoDeProcesos FROM grupoDeProcesos";
    /*echo $consulta;*/
        
	$rs_nroLineas = mysqli_query($conexion,$query_nroLineas);
    $nr_Lineas= mysqli_num_rows($rs_nroLineas);
    echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';

    $donde="tipoproceso.codtipo=grupoDeProcesos.batchOrLot AND ";
    if ($parametro1<>""){ $donde=$donde."grupoDeProcesos.".$criterio1."='".$parametro1."' AND ";}
    if ($parametro2<>""){ $donde=$donde."grupoDeProcesos.".$criterio2."='".$parametro2."' AND ";}
    if ($parametro3<>""){ $donde=$donde."grupoDeProcesos.".$criterio3."='".$parametro3."' AND ";}

    echo '                      <div id="cabeceraResultado" class="header"><span id="trelgrupdef">Listado de los Grupos de procesos definidos</span></div>';
    echo '				<div id="frmResultado">';
    echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
    echo '					<tr class="cabeceraTabla">';
    echo '						<td width="18%"><span id="tcodigo">CODIGO</span></td>';
    echo '						<td width="18%"><span id="ttipproc">TIPO DE PROCESO</span></td>';
    echo '						<td width="28%"><span id="tnomb">Nombre</span></td>';
    echo '						<td width="18%"><span id="testado">ESTADO</span></td>';
    echo '						<td width="8%">&nbsp;</td>';
    echo '						<td width="8%">&nbsp;</td>';
    echo '					</tr>';
    echo '			</table>';
    echo '			</div>';
    
    
	$consulta="SELECT grupoDeProcesos.codGrupoDeProcesos, tipoproceso.nombre, grupoDeProcesos.nombre, estado.estado FROM grupoDeProcesos, tipoproceso, estado WHERE ".$donde."estado.codestado=grupoDeProcesos.codstatus ORDER BY grupoDeProcesos.nombre LIMIT ".$paginainicio.",10;";
    //echo $consulta;
        
	$rs_tabla = mysqli_query($conexion,$consulta);
    $nr_procesos= mysqli_num_rows($rs_tabla);
                 while ($nr_procesos > 0) {
                             if ($nr_procesos % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td width="8%"><div align="center">'.$row[0].'</td>';
							echo '<td width="20%"><div align="center">'.$row[1].'</div></td>';
							echo '<td width="18%"><div align="center">'.$row[2].'</div></td>';
                            echo '<td width="18%"><div align="center">'.$row[3].'</div></td>';

							
                                                
                                                            echo '<td width="8%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0"  onClick="modificar('.$row[0].')" data-ttitle="modificar" title="Modificar"></a></div></td>';
                                                            echo '<td width="8%"><div align="center">&nbsp;</div></td>';
                                                       
                              echo '</tr>';
                        echo '</table>';
                         
                            $nr_procesos--;
                        }
mysqli_close($conexion); 
?>
