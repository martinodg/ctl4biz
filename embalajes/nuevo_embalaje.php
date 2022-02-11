<?php require_once("../conectar7.php");?>
<html>
<head>
    <title>Principal</title>
    <link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="../funciones/validar.js"></script>
    <script type="text/javascript" src="../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
    <script language="javascript">

        function cancelar() {
            location.href="index.php";
        }

        var cursor;
        if (document.all) {
            // Está utilizando EXPLORER
            cursor='hand';
        } else {
            // Está utilizando MOZILLA/NETSCAPE
            cursor='pointer';
        }

        function limpiar() {
            document.getElementById("nombre").value="";
            document.getElementById("cantidad").value="";
            document.getElementById("unidad").value="";
        }

        //Perform when DOM is full loaded
        $( document ).ready(function(){

            //load process combo
            $.get("../funciones/BackendQueries/getMeassuresUnits.php", function(data) {
                $('.cboUnidadmedida').html(data);
            });
        });

    </script>
</head>
<body>
<div id="pagina">
    <div id="zonaContenido">
        <div align="center">
            <div id="tituloForm" class="header"><span id="tinseremb">INSERTAR EMBALAJE</span></div>
            <div id="frmBusqueda">
                <form id="formulario" name="formulario" method="post" action="guardar_embalaje.php">
                    <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
                        <tr>
                            <td><span id="tnomb">Nombre</span></td>
                            <td><input NAME="Anombre" type="text" class="cajaGrande" id="nombre" size="50" maxlength="50"></td>
                            <td width="47%" rowspan="2" align="left" valign="top"><ul id="lista-errores"></ul></td>
                        </tr>
                        <tr>
                            <td><span id="tcant">Cantidad</span></td>
                            <td><input NAME="Acantidad" type="text" class="cajaGrande" id="cantidad" size="50" maxlength="50"></td>
                        </tr>
                        <tr>
                            <td><span id="tunidad">Unidad de Medida</span></td>
                            <td>
                                <select id="unidad" class="cboUnidadmedida" name="Aunimedida" >
                                </select>
                            </td>
                        </tr>
                    </table>
            </div>
            <div id="botonBusqueda">
                <button type="button" id="btnaceptar" onClick="validar(formulario,true)"  onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span  id="taceptar">Aceptar</span> </button>
                <button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span  id="tlimpiar">Limpiar</span> </button>
                <button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span  id="tcancelar">Cancelar</span> </button>
                <input id="accion" name="accion" value="alta" type="hidden">
                <input id="id" name="id" value="" type="hidden">
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
