<?php
if(session_id() == '') {
    session_start();
}
var_dump('---------',$_SESSION);
var_dump('---------------------------------',$_SESSION['intUserName']);
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../../estilos/login.css' />
    <script type="text/javascript" src="../../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../../funciones/languages/changelanguage.js"></script>
    <script type="text/javascript" src="../../funciones/login.js"></script>
    <script type="text/javascript" src="../funciones/languages/langNavLogin.js"></script>
    <script type="text/javascript">

        var cursor;
        if (document.all) {
            // Está utilizando EXPLORER
            cursor='hand';
        } else {
            // Está utilizando MOZILLA/NETSCAPE
            cursor='pointer';
        }
        // validate Logo
        function valLogo(){
            var fileName = $("#logofile").val();
            if(fileName.length > 0){
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (["png"].includes(extFile)){
                    return true;
                } else {
                    talert('seleccionarLogo')
                    $("#logofile").val("")
                    return false;
                }
            }
        }
        // volver a settings
        function cancelar() {
            location.href="../../settings/settings.php";
        }
        function modificarCompany() {
            // valLogo();
            $.ajax({
                type: "POST",
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                url: "guardarCompany.php",
                data: new FormData($( 'form[name=formCompany]')[0]),
                success: function( data ) {
                    $('#div_datos').html( data );
                    location.href="guardarCompany.php";
                }
            });
        }
    </script>



    <!link href="../../estilos/menu2.css" type="text/css" rel="stylesheet">
    <title>Registration form</title>
</head>

<body>
    <div id="content_login">
        <div class="header"><span id="tcompanydata">DATOS DE COMPAÑIA</span></div>


            <div class="column2" style="background-color:#eee; height: 600px">
                <center>
                    <form id="formCompany" name="formCompany" align="center" method="post">
                        <input type="hidden" id="accion" name="accion" value="modificar">

                        <span  id="tcompanyName" class="loginText">Nombre de Compañia:</span><br>
                        <input class="input-wrapper" type="text" id="nameCompany" name="nameCompany">
                        <br> <br>
                        <span  id="tcod_fiscal" class="loginText">codigo fiscal:</span><br>
                        <input class="input-wrapper" type="text" id="cfCompany" name="cfCompany">
                        <br> <br>
                        <span  id="tcontact_name" class="loginText">Nombre de Contacto:</span><br>
                        <input class="input-wrapper" type="text" id="nameContact" name="nameContact">
                        <br> <br>
                        <span class="loginText">e-mail:</span><br>
                        <input class="input-wrapper" type="text" id="emailCompany" name="emailCompany">
                        <br> <br>
                        <span id="ttelef" class="loginText">Telefono:</span><br>
                        <input class="input-wrapper" type="text" id="telCompany" name="telCompany">
                        <br> <br>
                        <span id="direccion" class="loginText">Domicilio:</span><br>
                        <input class="input-wrapper" type="text" id="domicilioCompany" name="domicilioCompany">
                        <br> <br>
                        </div>

                </center>
            </div>
            <div class="column2" style="background-color:#eee; height: 600px">
                <center>

                    <span id="pais" class="loginText">Pais:</span><br>
                    <input class="input-wrapper" type="text" id="paisCompany" name="paisCompany">
                    <br> <br>

                    <span id="tidioma" class="loginText">Lenguaje</span><br>
                    <select class="loginText input-wrapper" id="languageCompany" name="selectPais" >
                        <option id="tlang_elegido" selected>idioma</option>
                        <option value="en">Ingles</option>
                        <option value="es">Español</option>
                        <option value="pl">Polaco</option>
                        <option value="it">Italiano</option>
                        <option value="pt">Portugues</option>
                        <option value="fr">Frances</option>
                        <option value="de">Aleman</option>
                    </select>
                    <br> <br>

                    <span id="tmoneda" class="loginText">Moneda</span><br>
                    <select class="loginText input-wrapper" id="monedaCompany" name="monedaCompany">
                        <option value="eur" selected>EUR</option>
                        <option value="usd">USD</option>
                        <option value="ars">ARS</option>
                        <option value="oti">OTI</option>
                    </select>
                    <br> <br>

                    <span id="zipcodigoCompany" class="loginText">Zip-codigo</span><br>
                    <input class="input-wrapper" type="text" id="zipCompany" name="zipCompany">
                    <br> <br>

                    <span id="leyenda" class="loginText">Leyenda:</span><br>
                    <input class="input-wrapper" type="text" id="leyenda" name="leyenda">
                    <br> <br>
                    <span id="timgfrmavatar" class="loginText">Logo (png)</span><br>
                    <div class="avatar-validation-wrapper">
                        <input class="input" type="file" id="logofile" name="logofile" accept="image/png" style="font-size: 1.5em;top: auto;visibility: visible; color:orange;">
                        <div class="avatar-validation-icon-wrapper formatovalido"></div>
                    </div>

                    <input type="hidden" id="language" name="language" value="0">


                </center>
            </div>

            <div id="botonBusqueda" align="right">
                <button type="button" id="btnsubmit" onClick="modificarCompany()" onMouseOver="style.cursor=cursor"> <img src="../../img/disco.svg" alt="cambiar" /><span id="tudate_company">Actualizar Compañia</span></button>
                <button type="button" id="btnsubmit" onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../../img/cancelar.svg" alt="cancelar" /><span id="tcancelar">Cancelar</span></button>

            </div>

            </form>
            <br>
            <div ID="div_datos" name="div_datos" ></div>

            <br>
        </div>
    </div>
</body>

</html>