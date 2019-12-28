<?php
session_start();
unset($_SESSION["id"]); 
unset($_SESSION["BaseDeDatos"]); 
unset($_SESSION["Usuario"]); 
unset($_SESSION["Password"]);
//header("Location:login.php");    
echo"<script>
   parent.changeURL('../index.php');
</script>";

?>

