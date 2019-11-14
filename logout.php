<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
//header("Location:login.php");    
echo"<script>
   parent.changeURL('index.php');
</script>";

?>

