<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../../estilos/login.css' />
    <script type="text/javascript" src="../../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../../funciones/languages/changelanguage.js"></script>
    <script type="text/javascript" src="../../funciones/login.js"></script>
    <script language="javascript">
        // validate avatar
        function valAvatar(){
            var fileName = $("#avatarfile").val();
            if(fileName.length > 0){
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
        }
        //get proceso code from Url hash on last page.
        var usuario = window.location.hash.substring(1);
        buscausuario(usuario);
        var cursor;
        if (document.all) {
                // Está utilizando EXPLORER
                cursor='hand';
        } else {
                // Está utilizando MOZILLA/NETSCAPE
                cursor='pointer';
        }

        function limpiar() {
            document.getElementById("formulario").reset();
        }
        function cancelar() {
            location.href="index.php";
        }
        function modificausuario() {
            valAvatar();
            var status = $("#uActivo").prop('checked');
            if (status == true) {
                var codstatus="4";
            }else{
                if (usuario!='1') {
                    var codstatus="5";
                }else{
                    alert("It is not possible to deactivate the CTL4.biz master user");
                    var codstatus="4";
                }
            }
            $('#estado').val(codstatus);
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
        //search user
        function buscausuario(usuario) {
            //alert(usuario);
            $.getJSON("./buscarUsuario.php", {
                                                    criterio1 : 'id_intUser',
                                                    parametro1 : usuario,
                                                    paginainicio: '0',
                                                    tipoBusqueda: 'modificar'
                                                },
                                                function(data) {
                                                                //alert(data.nombre);
                                                                $('#name').val(data.nombre);
                                                                $('#password-field').val(data.clave);
                                                                $('#email-field').val(data.mail);
                                                                $('#password-validation-field').val(data.clave);
                                                                $('#email-validation-field').val(data.mail);
                                                                var uActivo = data.codestado;
                                                                if (uActivo == "4") {
                                                                    $('input[type="checkbox"]').attr('checked', true);
                                                                } else {
                                                                    $('input[type="checkbox"]').attr('checked', false);
                                                                }
                                                                //$('#div_datos').html( data );
                                                                //calculaPaginacion();
                                                                }
                        );                        
        }
        //procs search fucnction
        function buscaRole(usuario){
                                    $.get( "buscarRole.php" , { criterio1 : 'id_intUser',
                                                                    parametro1 : usuario,
                                                                    tipoBusqueda: 'listar'
                                                                    //paginainicio : document.getElementById('iniciopagina').value
                                                              },function ( data ) { 
                                                                                        $('#div_datos').html( data );
                                                                                        //calculaPaginacion();
                                                                                  }
                                         );
                                    
                              }
        function ABRole(idRole,id_intUser,action){
            //alert(idRole+action+id_intUser);
            $.get( "ABRole.php" , { role : idRole,
                                    user : id_intUser,
                                    accion: action
                                    },function ( data ) { 
                                                        $('#div_datos2').html( data );
                                                        buscaRole(id_intUser);
                                                        }
                 );
        }
        $(document).ready(function() {
            window.onload = function(){
            valmail();
            valpass();
            }
            buscaRole(usuario);
        });
    </script>

    <title>Registration form</title>
</head>

<body>
    <div id="content_login">
       
        <div id="cabeceraResultado" class="header"><span id="tDetalleUsuario">Detalles del Usuario</span></div>
            <div class="column2" style="background-color:#eee; height:350px;">
                <center>
                    <form name="frmUser" align="center">
                        <input type="hidden" name="accion" value="modificar" />
                        <div class="message">
                            <?php if(!empty($message)) { echo $message; } ?>
                        </div>
                        <br> <br>
                        <span  id="nombre" class="loginText">Nombre de Usuario:</span><br>
                        <input class="input-wrapper" type="text" id="name" name="name" readonly>
                        <br> <br>

                        <span class="loginText">e-mail:</span><br>
                        <input id="email-field" class="input-wrapper" type="text" name="email">
                        <br> <br>
                        <span  id="password" class="loginText">clave:</span><br>
                        <div class="password-wrapper">
                            <input id="password-field" type="password" class="input" name="password">
                            <div class="icon-wrapper pass">
                                <span toggle="#password-field" class="field-icon toggle-password"></span>
                            </div>
                            <div class="strength-lines">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>

                </center>
            </div>
            <div class="column2" style="background-color:#eee;height:350px;">
                <center>
                    <br> <br>
                    <span id="timgfrmavatar" class="loginText">Avatar</span><br>
                    <div class="avatar-validation-wrapper">
                        <input type="file" name="avatarfile" id="avatarfile" class="input" accept="image/png" style="font-size: 1.5em;top: auto;visibility: visible;">
                        <div class="avatar-validation-icon-wrapper formatovalido"></div>
                    </div>

                    <br> <br>

                   
                    <span  id="emailValidation" class="loginText">validacion de e-mail:</span><br>
                    <div class="email-validation-wrapper">
                        <input id="email-validation-field" type="text" class="input" name="email-validation" onpaste="return false;">
                        <div class="email-validation-icon-wrapper passdistinta"></div>
                    </div>
                    <br>
                    <span  id="passwordValidation" class="loginText">validacion de clave:</span><br>
                    <div class="password-validation-wrapper">
                        <input id="password-validation-field" type="password" class="input" name="password-validation" onpaste="return false;">
                        <div class="validation-icon-wrapper passdistinta">
                            <span toggle="#password-validation-field" class="field-icon toggle-password"></span>
                        </div>
                    </div>
                    <br> <br> <br>
                    <div><span  id="usuarioDesactivado" class="loginText">Inactivo </span><label class="switch">
                            <input type="checkbox" id="uActivo" name="uActivo" > <span class="slider round"></span> </label>
                        <span  id="usuarioActivo" class="loginText">Activo</span></div>

                    <input type="hidden" id="estado" name="estado" value="4">
                    <input type="hidden" id="language" name="language" value="0">


                </center>
            </div>

            <div id="botonBusqueda" align="right">
                <button type="button" id="btnsubmit" onClick="modificausuario()" onMouseOver="style.cursor=cursor" disabled=""> <img src="../../img/disco.svg" alt="Nuevo" /> <span>Guardar modificacion</span> </button>

            </div>

            </form>
            <br>
            <div ID="div_datos" name="div_datos" > </div> 
            <div ID="div_datos" name="div_datos2" > </div> 


            <br>
        </div>
    </div>
</body>

</html>