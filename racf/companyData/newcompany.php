<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../../estilos/login.css' />
    <script type="text/javascript" src="../../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../../funciones/languages/changelanguage.js"></script>
    <script type="text/javascript" src="../../funciones/login.js"></script>
    <script type="text/javascript">
        // validate avatar
        function valAvatar(){
            var fileName = $("#avatarfile").val();
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (["png"].includes(extFile)){
                return true;
            } else {
                talert('seleccionarAvatar')
                $("#avatarfile").val("")
                return false;
            }
        }

        function limpiar() {
            document.getElementById("formulario").reset();
        }

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

        /*function creausuario() {
            if(valAvatar()){
                $.ajax({
                    type: "POST",
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    url: "guardarusuario.php",
                    data: new FormData($( 'form[name=frmUser]')[0]),
                    success: function( data )
                    {
                        $('#div_datos').html( data );
                        location.href="index.php";
                    }
                });
            }
        }*/

    </script>



    <!link href="../../estilos/menu2.css" type="text/css" rel="stylesheet">
    <title>Registration form</title>
</head>

<body>
    <div id="content_login">
        <div class="header">NUEVA COMPAÑIA</div>


            <div class="column2" style="background-color:#eee; height: 400px">
                <center>
                    <form name="fromCompany" align="center">
                        <input type="hidden" name="accion" value="alta" />
                        <div class="message">
                            <?php if(!empty($message)) { echo $message; } ?>
                        </div>
                        <span  id="nombreCompany" class="loginText">Nombre de Compania:</span><br>
                        <input class="input-wrapper" type="text" id="nameCompany" name="name">
                        <br> <br>
                        <span class="loginText">e-mail:</span><br>
                        <input id="emailCompany" class="input-wrapper" type="text" name="email">
                        <br> <br>
                        <span id="telefCompany" class="loginText">Telefono:</span><br>
                        <input id="telCompany" class="input-wrapper" type="text" name="email">
                        <br> <br>
                        <span id="pais" class="loginText">Pais:</span><br>
                        <input id="paisCompany" class="input-wrapper" type="text" name="email">
                        <br> <br>
                        </div>

                </center>
            </div>
            <div class="column2" style="background-color:#eee; height: 400px">
                <center>
                    <span id="direccion" class="loginText">Domicilio:</span><br>
                    <input id="domicilioCompany" class="input-wrapper" type="text" name="email">
                    <br> <br>

                    <span id="lenguaje" class="loginText">lenguaje</span><br>
                    <select name="" id="languageCompany" class="loginText input-wrapper">
                        <option value="en">Ingles</option>
                        <option value="es">Español</option>
                        <option value="pl">Polaco</option>
                        <option value="it">Italiano</option>
                        <option value="pt">Portugues</option>
                        <option value="fr">Frances</option>
                        <option value="de">Aleman</option>
                    </select>
                    <br> <br>

                    <span id="moneda" class="loginText">Moneda</span><br>
                    <select name="" id="monedaCompany" class="loginText input-wrapper">
                        <option value="eur" selected>EUR</option>
                        <option value="usd">USD</option>
                        <option value="ars">ARS</option>
                    </select>
                    <br> <br>

                    <span id="zipcodigoCompany" class="loginText">Zip-codigo</span><br>
                    <input id=" " class="input-wrapper" type="text" name="email">
                    <br> <br>

                    <span id="timgfrmavatar" class="loginText">Avatar - Logo</span><br>
                    <div class="avatar-validation-wrapper">
                        <input type="file" name="avatarfile" id="avatarfile" class="input" accept="image/png" style="font-size: 1.5em;top: auto;visibility: visible;">
                        <div class="avatar-validation-icon-wrapper formatovalido"></div>
                    </div>

                    <input type="hidden" id="language" name="language" value="0">


                </center>
            </div>

            <div id="botonBusqueda" align="right">
                <button type="button" id="btnsubmit" onClick="creausuario()" onMouseOver="style.cursor=cursor" disabled=""> <img src="../../img/nuevo.svg" alt="Nuevo" /> <span>Insertar Nueva Compañia</span> </button>

            </div>

            </form>
            <br>
            <div ID="div_datos" name="div_datos" > </div>

            <br>
        </div>
    </div>
</body>

</html>