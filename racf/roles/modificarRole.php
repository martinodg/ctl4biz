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
        //get proceso code from Url hash on last page.
        var role = window.location.hash.substring(1);
        buscarole(role);
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

        function modificarole() {
            var status = $("#rActivo").prop('checked');
            if (status == true) {var codstatus="4"}else{var codstatus="5"}
            $.get( "guardarRole.php" , { accion : 'modificar',
                                            codigo : document.getElementById('code').value,
                                            nombre : document.getElementById('role_name').value,
                                            estado : codstatus
                                        }, function ( data ) { 
                                                            $('#div_datos2').html( data );
                                                            location.href="index.php";
                                                            }
                );                            
        }
        //search user
        function buscarole(role) {
            //alert(role);
            $.getJSON("./buscarRole.php", {
                                                    criterio1 : 'id_role',
                                                    parametro1 : role,
                                                    paginainicio: '0',
                                                    tipoBusqueda: 'modificar'
                                                },
                                                function(data) {
                                                                $('#code').val(data.codrole);
                                                                $('#role_name').val(data.nombre);
                                                                var rActivo = data.codestado;
                                                                if (rActivo == "4") {
                                                                    $('input[type="checkbox"]').attr('checked', true);
                                                                } else {
                                                                    $('input[type="checkbox"]').attr('checked', false);
                                                                }
                                                                
                                                                }
                        );                        
        }
        //procs search fucnction
        function buscaSubResources(role){
                                    $.get( "buscarSubResources.php" , { criterio1 : 'id_role',
                                                                    parametro1 : role,
                                                                    tipoBusqueda: 'listar'
                                                              },function ( data ) { 
                                                                                        $('#div_datos').html( data );
                                                                                       
                                                                                  }
                                         );
                                    
                              }
        function ABSubReso(idSreso){
            if ($('#SWSubRecurso'+idSreso).prop('checked')){
                action="agregar";
            } else {
                action="quitar";
            }
            $.getJSON( "ABSubReso.php" , { sreso : idSreso,
                                    role : role,
                                    accion: action
                                    },function ( data ) { 
                                                        if (data.mensaje!=null) {alert(data.mensaje);}
                                                        buscaSubResources(role);
                                                        }
                 );
        }
        function ABReso(idReso){
            if ($('#SWrecurso'+idReso).prop('checked')){
                $(".hrow"+idReso).show();
                action="agregar";
            } else {
                $(".hrow"+idReso).hide(); 
                action="quitar";
            }
            $.getJSON( "ABReso.php" , { reso : idReso,
                                    idrole : role,
                                    accion: action
                                    },function ( data ) { 
                                                        if (data.mensaje!=null) {alert(data.mensaje);}
                                                        buscaSubResources(role);
                                                        }
                 );

        }

        $(document).ready(function() {
            buscaSubResources(role);
            
        });
       
            
    </script>

    <title>Registration form</title>
</head>

<body>
    <div id="content_login">
       
    <div id="cabeceraResultado" class="header"> 
        <span id="tDetalleRol">Detalles del role</span></div>
            <div class="column3" style="background-color:#eee;">
                <center>
                    <form name="frmUser" align="center">
                        <div class="message">
                            <?php if(isset($message)){if($message!="") { echo $message; }} ?>
                        </div>
                        <br> <br>
                        <span  id="codigo" class="loginText">Codigo del role:</span><br>
                        <input class="input-wrapper" type="text" id="code" name="code" readonly>                  

                </center>
            </div>
            <div class="column3" style="background-color:#eee;">
                <center>
                <br> <br>
                        <span  id="nombreDelRole" class="loginText">Nombre de role:</span><br>
                        <input class="input-wrapper" type="text" id="role_name" name="name" >
                    
                </center>
            </div>
            <div class="column3" style="background-color:#eee;">
                <center>
                    <br> <br>
                    <div><span  id="roleDesactivado" class="loginText">Inactivo </span><label class="switch"> <input type="checkbox" id="rActivo" name="rActivo" > <span class="slider round"></span> </label> <span  id="roleActivo" class="loginText">Activo</span></div>

                    <input type="hidden" id="language" name="language" value="0">

                </center>
            </div>

            <div id="botonBusqueda" align="right">
                <button type="button" id="btnmodificar" onClick="modificarole()" onMouseOver="style.cursor=cursor"> <img src="../../img/disco.svg" alt="Modificar" /> <span id="tGuardarModificacion" >Guardar modificacion</span> </button>

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