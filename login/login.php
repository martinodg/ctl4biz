<?php
include("../conectar.php"); 
$companycode=$_POST["company_code"];
$usuario=$_POST["user_name"];
$clave=$_POST["password"];

session_start();
$message="";
if(count($_POST)>0) {
    if(empty($companycode)){
        $query_login="SELECT * FROM login_user WHERE user_name='".$usuario."' and password = '". $clave."';";
    }else{
       $base_datos_usuario="SELECT bdusuario";
    }
    $result = mysqli_query($conexion,$query_login);

    if (!$result) {
        die('Query failed');
    }else{
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
            $_SESSION["id"] = $row['id'];
            $_SESSION["BaseDeDatos"] = $row['id_company'];
            $_SESSION["Usuario"] = $row['user_name'];
            $_SESSION["Password"] = $row['password'];
        } else {
            $message = "Invalid Username or Password!";
        }
    }

}
if(isset($_SESSION["id"])) {
    
    header("Location:../index.php");
    
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../estilos/login.css' />
    <script type="text/javascript" src="../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../funciones/login.js"></script>
    
    
<title>User Login</title>
</head>
<body>
  <div id="content_login">
  <nav>
            <ul>
                <li>
                    <a href="#"> <img id="bandera_lengua" src="../img/english-language.svg" height="30px" width="30px"></a>
                    <ul>
                        <li><a class="lang" id="english" href="#">English</a></li>
                        <li><a class="lang" id="espanol" href="#">Espanol</a></li>
                    </ul>

                </li>
            </ul>
        </nav>
   <div><center>
       <br><br><br>
            <img class="logo_login" src="../img/ctl4bizlogo.svg" height="200px" width="200px">
            <span style="padding-top:200px">&nbsp;</span>
            <br>
            <br>
            <form name="frmUser" method="post" action="" align="center">
                <div class="message"><?php if($message!="") { echo $message; } ?></div>
                <h3 id="details" class="loginTitle">Enter Login Details</h3>
                <br><br>
                <span id="companyCode" class="loginText">Company Code:</span><br>
                <input class="input-wrapper"type="text" name="company_code">
                <br><br>
                <span class="loginText">e-mail:</span><br>
                <input class="input-wrapper"type="text" name="user_name">
                <br> <br>
                <span id="password" class="loginText">password:</span><br>
                <div class="password-wrapper">
	                <input id="password-field" type="password" class="input" name="password">
	                <div class="icon-wrapper pass">
  	                    <span toggle="#password-field" class="field-icon toggle-password"></span>
                    </div>
                </div>      
                <br><br><br>
            

                <div id="botonBusqueda">
					
                    <button type="submit"  id="btnsubmit" value="Submit" onMouseOver="style.cursor=cursor"> <img src="../img/login.svg" alt="nuevo" /> <span id="sub">Submit</span> </button>
                    <br><br>
                    <br> <br>
                <span id="noMember" class="loginText">Not a member yet?</span><br>
                    <button type="button" id="btnlogin"  onClick="window.location.href = './register.html';" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="Register" /> <span id="signin">Sign in Now!</span> </button>
                </div>
            </form>
        </center>
    </div>
   </div>
</body>
</html>