<?php
$conexion = null;
if(session_id() == '') {
    session_start();
}

require_once("../../conectar7.php");
require_once("../../funciones/cargaImagenes.php");

$query_companyData="SELECT * FROM company_data WHERE id=0";
$rs_companyData=mysqli_query($conexion,$query_companyData);
$row = mysqli_fetch_row($rs_companyData);
//datos de la compañia:
$id= $row [0];
$razon_soc= $row[1];
$contact_name= $row [2];
$telephone= $row [3];
$email= $row [4];
$country= $row [5];
$language= $row [6];
$address= $row [7];
$zip_code= $row [8];
$moneda= $row [9];
$cod_fiscal= $row [10];
$leyenda= $row [11];
$logo= $row [12];//@todo Cargar nombre del logo (ctl4bizlogo.jpg por default )

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
                    location.href="ver_company.php";
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
                        <input class="input-wrapper" type="text" id="nameCompany" name="nameCompany" value="<?echo $razon_soc;?>">
                        <br> <br>
                        <span  id="tcod_fiscal" class="loginText">codigo fiscal:</span><br>
                        <input class="input-wrapper" type="text" id="cfCompany" name="cfCompany" value="<?echo $cod_fiscal;?>">
                        <br> <br>
                        <span  id="tcontact_name" class="loginText">Nombre de Contacto:</span><br>
                        <input class="input-wrapper" type="text" id="nameContact" name="nameContact" value="<?echo $contact_name;?>">
                        <br> <br>
                        <span class="loginText">e-mail:</span><br>
                        <input class="input-wrapper" type="text" id="emailCompany" name="emailCompany" value="<?echo $email;?>">
                        <br> <br>
                        <span id="ttelef" class="loginText">Telefono:</span><br>
                        <input class="input-wrapper" type="text" id="telCompany" name="telCompany" value="<?echo $telephone;?>">
                        <br> <br>
                        <span id="direccion" class="loginText">Domicilio:</span><br>
                        <input class="input-wrapper" type="text" id="domicilioCompany" name="domicilioCompany" value="<?echo $address;?>">
                        <br> <br>
                        </div>

                </center>
            </div>
            <div class="column2" style="background-color:#eee; height: 600px">
                <center>

                    <span id="pais" class="loginText">Pais:</span><br>
                    <input class="input-wrapper" type="text" id="paisCompany" name="paisCompany" value="<?echo $country;?>">
                    <br> <br>

                    <span id="tidioma" class="loginText">Lenguaje</span><br>
                    <select class="loginText input-wrapper" id="languageCompany" name="languageCompany" >
                        <option value=<? echo $language;?> selected><? echo $language;?></option>
                        <option value="Ingles">Ingles</option>
                        <option value="Español">Español</option>
                        <option value="Polsky">Polaco</option>
                        <option value="Italiano">Italiano</option>
                        <option value="Portugues">Portugues</option>
                        <option value="Frances">Frances</option>
                        <option value="Aleman">Aleman</option>
                    </select>
                    <br> <br>

                    <span id="tmoneda" class="loginText">Moneda</span><br>
                    <select id="monedaCompany" name="monedaCompany" class="comboPequeno input-wrapper">
                    <?
                    $res_monedas=mysqli_query($conexion,"SELECT * FROM monedas ORDER BY moneda ASC");
                    while ($row_moneda = mysqli_fetch_array($res_monedas)) {
                        $selected = ($row_moneda['id_moneda'] == $moneda) ? ' selected ':'';
                        echo '<option value="'.$row_moneda['id_moneda'].'" '.$selected.' >'.$row_moneda['moneda'].'</option>';
                    }
                    mysqli_free_result($res_monedas);
                    ?>
                    </select>
                    <br> <br>

                    <span id="zipcodigoCompany" class="loginText">Zip-codigo</span><br>
                    <input class="input-wrapper" type="text" id="zipCompany" name="zipCompany" value="<?echo $zip_code;?>">
                    <br> <br>

                    <span id="leyenda" class="loginText">Leyenda:</span><br>
                    <input class="input-wrapper" type="text" id="leyenda" name="leyenda" value="<?echo $leyenda;?>">
                    <br> <br>
                    <!--@todo Salvar el file: logo de la compañia-->
                    <span id="timgfrmavatar" class="loginText">Logo (<?echo $logo;?>)</span><br>
                    <div class="avatar-validation-wrapper">
                        <input class="input" type="file" id="logofile" name="logofile"  style="font-size: 1.5em;top: auto;visibility: visible; color:orange;" />
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