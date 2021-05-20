<?
require_once("../conectar7.php");
if(isset($_GET['codpresupuesto'])) { $codpresupuesto=$_GET['codpresupuesto'];}
if(isset($_GET['numlinea'])) { $numlinea=$_GET['numlinea'];}

$consulta="DELETE FROM presulineatmp WHERE codpresupuesto=$codpresupuesto AND numlinea=$numlinea";
//echo "<script>alert('".$consulta."');</script>;";
$rs_consulta = mysqli_query($conexion,$consulta);
echo "<script>location.href='frame_lineas.php?codpresupuestotmp=".$codpresupuesto."';</script>;";

?>