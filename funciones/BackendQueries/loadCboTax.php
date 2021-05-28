<?php

// Connects to your Database 

 include "../../conectar7.php";
 if (isset($_GET["defaulSelect"])) {$defaulSelect=$_GET["defaulSelect"];}
 
 $consultaImpuesto="select * from impuestos where borrado=0 order by nombre ASC";
 $queryImpuestos=mysqli_query($conexion,$consultaImpuesto);
 echo "<option value=0 data-opttrad=tdstax>Seleccionar un impuesto</option>";
 while ($rowImpuesto=mysqli_fetch_row($queryImpuestos))
   { 
       if ($anterior==$rowImpuesto[0]) { 
        echo" <option value=".$rowImpuesto[0]." selected>".utf8_encode($rowImpuesto[2])."</option>";
 	} else { 
        echo" <option value=".$rowImpuesto[0].">".utf8_encode($rowImpuesto[2])."</option>";
 	}   
      }; 
?>