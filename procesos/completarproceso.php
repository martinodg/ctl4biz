<?php
include ("../conectar7.php"); 


    $codproceso=$_GET["codproceso"];
    $codmproceso=$_GET["codmproceso"];
    $bolasoc=$_GET["bolasoc"];

    //add batch or lote number associated with the process
    $query_completarproceso="UPDATE procesos SET bolasoc='$bolasoc' WHERE codproceso='$codproceso'";
    $rs_completarproceso=mysqli_query($conexion,$query_completarproceso);

   /* echo "<div class=\"header\">ATENCION: El meta-proceso pasado al php es: '$codmproceso'!!</div>";*/
    $donde="articulos.codarticulo=metaprocesoslinea.codarticulo AND ";
    if ($codmproceso<>""){ $donde=$donde."metaprocesos.codproceso=".$codmproceso." AND ";}
    

    
	$consulta="SELECT metaprocesoslinea.codarticulo, articulos.referencia, articulos.stock, metaprocesoslinea.cantidad, metaprocesoslinea.codrecord FROM metaprocesoslinea, articulos, metaprocesos WHERE ".$donde."metaprocesos.codproceso=metaprocesoslinea.codproceso";
  /* echo $consulta; */
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_lotes= mysqli_num_rows($rs_tabla);
        echo ' <div id="cabeceraResultado" class="header">Articulo del lote </div>';
					
			echo '	<div id="frmResultado">';
			echo '	<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
			echo '			<tr class="cabeceraTabla">';
                        echo '                               <td width="15%">Codigo del Articulo</td>';
                         echo '                               <td width="35%">Nombre del Articulo</td>';
                         echo '                               <td width="18%">Stock</td>';
                         echo '                               <td width="18%">Cantidad</td>';
			echo '				<td width="14%">Validar</td>';
							
			echo '			</tr>';
            echo '	</table> ';    
            $totaldearticulos=$nr_lotes; 
                 while ($nr_lotes > 0) {
                             if ($nr_lotes % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td width="15%" align="center">'.$row[0].'</td>';
							echo '<td width="35%"><div align="center">'.$row[1].'</div></td>';
							echo '<td width="18%"><div align="center">'.$row[2].'</div></td>';
                            echo '<td width="18%"><div align="center"><input id="cantidada'.$row[4].'" type="text" class="cajaPequena" NAME="cantidada'.$row[4].'" align="center" value="'.$row[3].'" maxlength="15"></div></td>';
                            echo '<td width="14%"><div align="center"><a href="#"><img id="validacion" src="../img/validacion.svg" width="16" height="16" border="0"  onClick="validararticuloproceso(&apos;' .$row[0]. '&apos;,&apos;' .$row[3]. '&apos;,&apos;' .$row[4]. '&apos;)"></a></div></td>';
							
                              echo '</tr>';
                        echo '</table>';
                       
                            $nr_lotes--;
                        }
                        echo '<div id="botonBusqueda">';
                        echo '<div align="left"><span>Inserte la cantidad total producida</span><input id="cantidadproceso" type="text" class="cajaPequena" NAME="cantidadproceso"  value="0" maxlength="15"></div>';
                        echo '<button type="button" id="btnfin" onClick="finalizar()" onMouseOver="style.cursor=cursor"> <img src="../img/end.svg" alt="Finalizar" /> <span>Finalizar</span> </button>';
                        echo '</div>';
?>
