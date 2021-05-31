<?php
if(session_id() == '') {
    session_start();
}

// Turn off all error reporting
//error_reporting(0);

?>



<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../estilos/menu0.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../estilos/menu1.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../estilos/menu2.css' />
    <script type="text/javascript" src="./jquery/jquery331.js"></script>
    <script type="text/javascript" src="./funciones/languages/changelanguage.js"></script>

    
    <script language="javascript">
        loadMenu();
        $(document).ready(function() {
           
            $.get("./funciones/BackendQueries/getCompanyName.php", 
                    function(data) {
                        $('#nombreCompania').html(data);
                        

                    });
            $.get("./funciones/BackendQueries/getUserAvatar.php", 
                    function(data) {
                        $('#user_avatar').html(data);
                        

                    });
            
            
        });
        function loadMenu() {
            $.get("./funciones/BackendQueries/getMenuItems.php", 
                    function(data) {
                        $('#resources_menu').html(data);   
                    });
        }
        function openMenu(resource) {
                                            $("#resources_menu").toggle({
                                                    duration: 200,
                                            });
                                            if ($("#subresources_menu").is(":visible")){
                                                $("#subresources_menu").hide(270);
                                            }
                                            //loadMenu();
                                            
                                            
        }

        function openSubresMenu(resource) {
                
                //alert(resource);
                $("#subresources_menu").show(200);
                $.get("./funciones/BackendQueries/getMenuItems.php", { menu:"sub",
                    res:resource

                },                    function(data) {
                        $('#subresources_menu').html(data);
                        
                        

                    });
             
        }  
        function openTargetPage(link) {
            //alert("entro a funcion targetPage");
            $("#subresources_menu").hide(100);
            $("#resources_menu").hide(200);
            $("iframe").attr("src", ""+link+"");

        }

        //function to redirect parent page
        function changeURL( url ) {
            window.top.location.href = url;
            //document.location = url;
        }
    </script>
</head>

<body>
<?php
if($_SESSION["intUser"]) {
?>  
    
<div id="nombreCompania" class="company-continer"></div>

<div id="headbar">
<div class="navigation">
    <div class="ctlLogo-continer"><img class="logo" src="./img/w-ctl4bizlogo-long.svg"></div>
    <div id="user_avatar" class="avatar-continer"></div>
</div>
<!--Icono o logo cliente</-->
</div>


    
    <div id="left_side">
        <a href="#" ><img src="./img/w-menug.svg"  class="iconolado newmenu" alt="menu" onclick="openMenu()" ></a>
        <a href="./central2.php" target="principal" id="home"><img src="./img/w-graphics.svg" class="iconolado home" alt="inizio"></a>
        <a href="./settings/settings.php" target="principal" id="settings"><img src="./img/w-settings.svg" class="iconolado settings" alt="settings"></a>
        <a href="./ayuda/creditos.php" target="principal" id="ayuda"><img src="./img/w-help.svg" class="iconolado ayuda" alt="help"></a>
        <a href="./login/logout.php" target="principal" id="logout"><img src="./img/w-cerrar.svg" class="iconolado logout" alt="help"></a>      
    </div>
    <div id="resources_menu"></div>
    <div id="subresources_menu"></div>
    <div id="content">
        <iframe src="central2.php" name="principal" title="principal" width="100%" id="central2"  frameborder=0 scrolling="no" ></iframe>
    </div>
    <!--div id="bottombar"></div-->
    <?php
    }else{ 
    ?>      <script>
                changeURL('./login/login.php');
            </script>
    <?
    } 
    ?>
</body>

</html>