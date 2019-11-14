<?php
include("conectar.php"); 
$usuario=$_POST["user_name"];
$clave=$_POST["password"];

session_start();
$message="";
if(count($_POST)>0) {
$query_login="SELECT * FROM login_user WHERE user_name='".$usuario."' and password = '". $clave."';";
$result = mysqli_query($conexion,$query_login);

    if (!$result) {
        die('Query failed');
    }else{
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
            $_SESSION["id"] = $row['id'];
            $_SESSION["name"] = $row['name'];
        } else {
            $message = "Invalid Username or Password!";
        }
    }

}
if(isset($_SESSION["id"])) {
    
    header("Location:index.php");
    
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../estilos/menu0.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../estilos/menu1.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../estilos/menu2.css' />
    <!link href="../estilos/menu2.css" type="text/css" rel="stylesheet">
<title>User Login</title>
</head>
<body>
  <div id="content_login">
   <div><center>
            <img class="logo_login" src="./img/ctl4bizlogo.svg" height="200px" width="200px">
            <span style="padding-top:200px">&nbsp;</span>
            <form name="frmUser" method="post" action="" align="center">
                <div class="message"><?php if($message!="") { echo $message; } ?></div>
                <h3 align="center">Enter Login Details</h3>
                Username:<br>
                <input type="text" name="user_name">
                <br>
                Password:<br>
                <input type="password" name="password">
                <br><br>
                <input type="submit" name="submit" value="Submit">
                <input type="reset">
            </form>
        </center>
    </div>
   </div>
</body>
</html>