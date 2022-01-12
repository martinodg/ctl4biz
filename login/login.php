<?php
$conexion = null;

require_once("../conectar.php");
/**
 * Agrega los datos de la compania  al session
 * @param $conexion2
 */
function agregarCompanydata($conexion2){
    $company_id= 0;
    $query_companyData = "SELECT monedas.moneda, monedas.simbolo FROM monedas JOIN company_data ON monedas.id_moneda = company_data.moneda_id WHERE company_data.id = ".$company_id;
    $rs_companyData=mysqli_query($conexion2,$query_companyData)  or die('Error: '.mysqli_error($conexion2).' query: '.$query_companyData);  ;
    $row_company_data  = mysqli_fetch_array($rs_companyData);
    $_SESSION['company_currency_sign']= $row_company_data['simbolo'];
    $_SESSION['company_currency_code']= $row_company_data['moneda'];
    $_SESSION['company_id']= $company_id;
}
if(!empty($_POST)){
$companycode=$_POST["company_code"];
$usuario=$_POST["user_name"];
$clave=$_POST["password"];
}
if(session_id() == '') {
    session_start();
}
$message="";
if(count($_POST)>0) {
   
    $query_DB="SELECT db_user, db_password, id_company, company_name FROM login_data WHERE master_user='".$usuario."' or id_company='".$companycode."';";
    $result = mysqli_query($conexion,$query_DB);

    if (!$result) {
        die('Query 1 failed');
    }else{
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
            $BaseDeDatos = $row['id_company'];
            $Usuario_DB = $row['db_user'];
            $Password_DB = $row['db_password'];
            $Company_name= $row['company_name'];
            
        } else {
            $message = "Invalid Username or Comapany name!";
        }
    }
    mysqli_close($conexion);

    $conexion2=mysqli_connect('database',$Usuario_DB,$Password_DB,$BaseDeDatos) or die("Error: El servidor no puede conectar con la base de datos");
    $query_login="SELECT * FROM intUsersTable WHERE user_name='".$usuario."' and password='".$clave."';";
    $result_login = mysqli_query($conexion2,$query_login);

    if (!$result_login) {
        die('Query 2 failed');
        echo $query_login;
    }else{
        $row_login  = mysqli_fetch_array($result_login);
        if(is_array($row_login)) {
            $_SESSION['BaseDeDatos'] = $BaseDeDatos;
            $_SESSION['Usuario_DB'] = $Usuario_DB;
            $_SESSION['Password_DB'] = $Password_DB;
            $_SESSION['intUser'] = $row_login['user_name'];
            $_SESSION['intUserName'] = $row_login['intUser_name'];
            $_SESSION['id'] = $row_login['id_intUser'];
            $_SESSION['company_name']= $Company_name;
            agregarCompanyData($conexion2);
        } else {
            $message = "Invalid Username or Comapany name!";
        }
    }
}
if(isset($_SESSION["intUser"])) {
    
    header("Location:../loadMenu.html");
    
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../estilos/login.css' />
    <script type="text/javascript" src="../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../jquery/localbase.min.js"></script>
    <script type="text/javascript" src="../funciones/login.js"></script>
    <script type="text/javascript" src="../funciones/languages/changelanguage.js"></script>
    <script type="text/javascript" src="../funciones/languages/langNavLogin.js"></script>
 
    
    
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
                        <li><a class="lang" id="polish" href="#">Polski</a></li>
                        <li><a class="lang" id="italiano" href="#">Italiano</a></li>
                        <li><a class="lang" id="portugues" href="#">Portugues</a></li>
                        <li><a class="lang" id="francais" href="#">Français</a></li>
                        <li><a class="lang" id="deutsche" href="#">Deutsche</a></li>

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
                <span  id="companyCode" class="loginText">Company Code:</span><br>
                <input class="input-wrapper"type="text" name="company_code">
                <br><br>
                <span class="loginText">e-mail:</span><br>
                <input class="input-wrapper"type="text" name="user_name">
                <br> <br>
                <span  id="password" class="loginText">password:</span><br>
                <div class="password-wrapper">
	                <input id="password-field" type="password" class="input" name="password">
	                <div class="icon-wrapper pass">
  	                    <span toggle="#password-field" class="field-icon toggle-password"></span>
                    </div>
                </div>      
                <br><br><br>
            

                <div id="botonBusqueda">
					
                    <button type="submit"  id="btnsubmit" value="Submit" onMouseOver="style.cursor=cursor"> <img src="../img/login.svg" alt="nuevo" /> <span  id="sub">Submit</span> </button>
                    <br><br>
                    <br> <br>
                <span  id="noMember" class="loginText">Not a member yet?</span><br>
                    <button type="button" id="btnlogin"  onClick="window.location.href = './register.html';" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="Register" /> <span  id="signin">Sign in Now!</span> </button>
                </div>
            </form>
        </center>
    </div>
   </div>
</body>
</html>