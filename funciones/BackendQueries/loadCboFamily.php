<?php

// Connects to your Database 

 include "../../conectar7.php";
 if (isset($_GET["defaulSelect"])) {$defaulSelect=$_GET["defaulSelect"];}
 
 $consultafamilia="select * from familias where borrado=0 order by nombre ASC";
 $queryfamilia=mysqli_query($conexion,$consultafamilia);
 echo "<option value=0 data-opttrad=tdsfam>Todos los tipos</option>";
 while ($rowfamilia=mysqli_fetch_row($queryfamilia))
   { 
//       if ($anterior==$rowfamilia[0]) { 
      if ($rowfamilia[0]==$defaulSelect)  {
      echo" <option value=".$rowfamilia[0]." selected>".utf8_encode($rowfamilia[1])."</option>";
 	} else { 
        echo" <option value=".$rowfamilia[0].">".utf8_encode($rowfamilia[1])."</option>";
 	}   
      }; 
?>
