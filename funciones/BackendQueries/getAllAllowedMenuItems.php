<?php
session_start();
$userid=$_SESSION['id'];
require_once("../../varConnUserDB.php"); 


    $conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");
    $query_getMenu="SELECT DISTINCT resourcesTable.id_resource, resourcesTable.resourceName,resourcesTable.traslation_tag,resourcesTable.iconLink FROM resourcesTable, resourcesToRolesTable,rolesToUsersTable WHERE resourcesTable.id_resource=resourcesToRolesTable.id_resource AND resourcesToRolesTable.borrado=0 AND rolesToUsersTable.id_role=resourcesToRolesTable.id_role AND rolesToUsersTable.borrado=0 AND rolesToUsersTable.id_intUser='$userid' AND resourcesTable.id_resource <>8 AND resourcesTable.id_resource <>9 ORDER BY resourcesTable.id_resource ASC";
    $rs_query_getMenu=mysqli_query($conexion,$query_getMenu);
    $getMenuNumber= mysqli_num_rows($rs_query_getMenu);
    $contador=1;
   
    $data='[';
    while ($getMenuNumber > 0) {
        $resource = mysqli_fetch_row($rs_query_getMenu);

      $data.='{"id": "'.$contador.'", "id_resource": "'.$resource[0].'", "resourceName": "'.$resource[1].'", "traslation_tag": "'.$resource[2].'", "iconLink": "'.$resource[3].'", ';
   
            $conexion2=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");
            $query_getSubMenu="SELECT DISTINCT subResourceTable.id_sresource, subResourceTable.subResourceName,subResourceTable.traslation_tag,subResourceTable.iconLink, subResourceTable.subresourceLink FROM subResourceTable, subresourcesToRolesTable,rolesToUsersTable WHERE subResourceTable.id_sresource=subresourcesToRolesTable.id_subresource AND subresourcesToRolesTable.borrado=0 AND rolesToUsersTable.id_role=subresourcesToRolesTable.id_role AND rolesToUsersTable.borrado=0 AND rolesToUsersTable.id_intUser='$userid' AND subResourceTable.id_resource='$resource[0]' ORDER BY subResourceTable.id_sresource ASC ";
            $rs_query_getSubMenu=mysqli_query($conexion2,$query_getSubMenu);
            $getSubMenuNumber= mysqli_num_rows($rs_query_getSubMenu);
            $contador2=1;
            while ($getSubMenuNumber > 0) {
                
                $subResource = mysqli_fetch_row($rs_query_getSubMenu);
               $data.='"'.$subResource[1].'": {"id_sresource": "'.$subResource[0].'", "traslation_tag": "'.$subResource[2].'", "iconLink": "'.$subResource[3].'", "subresourceLink": "'.$subResource[4].'"}';

               if ($getSubMenuNumber>1){$data.=',';}else{$data.='}';}
           
                $contador2++;

                $getSubMenuNumber--;
            } 
            $contador++;
            $getMenuNumber--;
         
            if ($getMenuNumber>0){$data.=',';} else{$data.=']';}
    } 
      
   echo json_encode($data,JSON_UNESCAPED_SLASHES);   
   
    mysqli_close($conexion2);
    mysqli_close($conexion);

?>