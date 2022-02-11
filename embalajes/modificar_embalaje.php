<?php require_once("../conectar7.php"); 
require_once("../mysqli_result.php");

$codembalaje=$_GET["codembalaje"];

$query="SELECT * FROM embalajes WHERE codembalaje='$codembalaje'";
$rs_query=mysqli_query($conexion,$query);

?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
        <script type="text/javascript" src="../jquery/jquery331.js"></script>
        <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
		<script language="javascript">

		function cancelar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}

		function limpiar() {
			document.getElementById("nombre").value="";
		}

		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}

        //load stock minimo mesure units combo
        $.get( "../funciones/BackendQueries/getMeassuresUnits.php" , { articulo : document.getElementById('id').value,
            campo : 'codumstock_minimo'
        },function ( data ) {
            $('#umnstock_minimo').html(data);

        }
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
                    <div id="tituloForm" class="header"><span  id="tmodembalaje">MODIFICAR EMBALAJE</span></div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_embalaje.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td><span  id="tcod">C&Oacute;DIGO</span></td>
							<td><?php echo $codembalaje?></td>
						    <td width="42%" rowspan="2" align="left" valign="top"><ul id="lista-errores"></ul></td>
						</tr>
						<tr>
							<td width="15%"><span  id="tnomb">Nombre</span></td>
						    <td width="43%"><input NAME="Anombre" type="text" class="cajaGrande" id="nombre" size="45" maxlength="45" value="<?php echo mysqli_result($rs_query,0,"nombre")?>"></td>
				        </tr>
                        <tr>
                            <td width="15%"><span id="tcant">Cantidad</span></td>
                            <td width="43%"><input NAME="Acantidad" type="text" class="cajaGrande" id="nombre" size="45" maxlength="45" value="<?php echo mysqli_result($rs_query,0,"cantidad")?>"></td>
                        </tr>
                        <!---->
                        <tr>
                            <?php
                            $query_unidadmedida = mysqli_query($conexion,"SELECT * FROM unidadesmedidas WHERE 1;");
                            $query_codUniMedida="SELECT * FROM embalajes WHERE codembalaje = $codembalaje ORDER BY nombre ASC";
                            $consulta_codunimedida=mysqli_query($conexion,$query_codUniMedida);
                            $cod_unimedida = mysqli_result($consulta_codunimedida,0,"codunidadmedida");
                            $query_nameUniMedida="SELECT * FROM unidadesmedidas WHERE codunidadmedida = $cod_unimedida";
                            $consulta_nameunimedida=mysqli_query($conexion,$query_nameUniMedida);
                            $name_unimedida = mysqli_result($consulta_nameunimedida,0,"nombre");
                            $contador=0;
                            ?>
                            <td width="11%"><span id="tunidad">Unidad de Medida</span></td>
                            <td colspan="2">
                                <select id="cboFamilias" name="Aunimedida" class="comboGrande">
                                    <option value="0"><span id="tselectunimedida">Seleccione Unidad de Medida</span></option>
                                    <?php
                                    while ($contador < mysqli_num_rows($query_unidadmedida)) {
                                        if ($cod_unimedida==mysqli_result($consulta_codunimedida,$contador,"codunidadmedida")) {?>
                                            <option value="<?php echo mysqli_result($query_unidadmedida,$contador,"codunidadmedida")?>" selected="selected"><?php echo mysqli_result($query_unidadmedida,$cod_unimedida,"nombre");?></option>
                                        <? } else { ?>
                                            <option value="<?php echo mysqli_result($query_unidadmedida,$contador,"codunidadmedida")?>"><?php echo mysqli_result($query_unidadmedida,$contador,"nombre")?></option>
                                        <? }
                                        $contador++;
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <!---->
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="validar(formulario,true)"  onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>
					<button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span  id="tcancelar">Cancelar</span> </button>
					<input id="accion" name="accion" value="modificar" type="hidden">
					<input id="id" name="Zid" value="<?php echo $codembalaje?>" type="hidden">
			  </div>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
