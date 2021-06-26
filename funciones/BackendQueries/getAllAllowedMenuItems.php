<?php
session_start();
$userid=$_SESSION['id'];
require_once("../../varConnUserDB.php"); 


    $conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");
    $query_getMenu="SELECT DISTINCT resourcesTable.id_resource, resourcesTable.resourceName,resourcesTable.traslation_tag,resourcesTable.iconLink FROM resourcesTable, resourcesToRolesTable,rolesToUsersTable WHERE resourcesTable.id_resource=resourcesToRolesTable.id_resource AND resourcesToRolesTable.borrado=0 AND rolesToUsersTable.id_role=resourcesToRolesTable.id_role AND rolesToUsersTable.borrado=0 AND rolesToUsersTable.id_intUser='$userid' AND resourcesTable.id_resource <>8 AND resourcesTable.id_resource <>9 ORDER BY resourcesTable.id_resource ASC";
    //echo $query_getMenu;
    $rs_query_getMenu=mysqli_query($conexion,$query_getMenu);
    $getMenuNumber= mysqli_num_rows($rs_query_getMenu);
    $contador=1;
    //$data=[];
    //$data='';
    $data='[';
    while ($getMenuNumber > 0) {
        $resource = mysqli_fetch_row($rs_query_getMenu);
      //  $data.='{"id_resource": "'.$resource[0].'", "resourceName": "'.$resource[1].'", "traslation_tag": "'.$resource[2].'", "iconLink": "'.$resource[3].'", ';

      $data.='{"id": "'.$contador.'", "id_resource": "'.$resource[0].'", "resourceName": "'.$resource[1].'", "traslation_tag": "'.$resource[2].'", "iconLink": "'.$resource[3].'", ';
    //        $data.='{id: '.$contador.', id_resource: '.$resource[0].', resourceName: '.$resource[1].', traslation_tag: '.$resource[2].', iconLink: "'.$resource[3].'", ';
       
       // $data1=array("id", "id_resource"=>$resource[0], "resourceName"=>$resource[1],"traslation_tag"=>$resource[2], "iconLink"=>$resource[3]);
       // $data2=array_merge($data,$data1);
        /*    $data[$resource[1]]['id_resource']= $resource[0];
        $data[$resource[1]]['resourceName']= $resource[1];
        $data[$resource[1]]['traslation_tag']= $resource[2];
        $data[$resource[1]]['iconLink']= $resource[3];*/

     
            $conexion2=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");
            $query_getSubMenu="SELECT DISTINCT subResourceTable.id_sresource, subResourceTable.subResourceName,subResourceTable.traslation_tag,subResourceTable.iconLink, subResourceTable.subresourceLink FROM subResourceTable, subresourcesToRolesTable,rolesToUsersTable WHERE subResourceTable.id_sresource=subresourcesToRolesTable.id_subresource AND subresourcesToRolesTable.borrado=0 AND rolesToUsersTable.id_role=subresourcesToRolesTable.id_role AND rolesToUsersTable.borrado=0 AND rolesToUsersTable.id_intUser='$userid' AND subResourceTable.id_resource='$resource[0]' ORDER BY subResourceTable.id_sresource ASC ";
            $rs_query_getSubMenu=mysqli_query($conexion2,$query_getSubMenu);
            $getSubMenuNumber= mysqli_num_rows($rs_query_getSubMenu);
            $contador2=1;
            while ($getSubMenuNumber > 0) {
                
                $subResource = mysqli_fetch_row($rs_query_getSubMenu);
                //$data.=array($subResource[1]=>array(id_sresource=>$subResource[0], traslation_tag=>$subResource[2], iconLink=>$subResource[3], subresourceLink=>$subResource[4]));
               $data.='"'.$subResource[1].'": {"id_sresource": "'.$subResource[0].'", "traslation_tag": "'.$subResource[2].'", "iconLink": "'.$subResource[3].'", "subresourceLink": "'.$subResource[4].'"}';

           //     $data.=''.$subResource[1].': {id_sresource: '.$subResource[0].', traslation_tag: '.$subResource[2].', iconLink: &apos;'.$subResource[3].'", subresourceLink: "'.$subResource[4].'"}';
               if ($getSubMenuNumber>1){$data.=',';}else{$data.='}';}
            //   $data3=array("id","id_resource"=>$subResource[0], "resourceName"=>$subResource[1],"traslation_tag"=>$subResource[2], "iconLink"=>$subResource[3],"resourceLink"=>$subResource[4]);
               // $data=array_merge($data2,$data3);
               /*    $data[$resource[1]][$subResource[1]]['id_sresource']=$subResource[0];
                $data[$resource[1]][$subResource[1]]['subResourceName']=$subResource[1];
                $data[$resource[1]][$subResource[1]]['traslation_tag']=$subResource[2];
                $data[$resource[1]][$subResource[1]]['iconLink']=$subResource[3];
                $data[$resource[1]][$subResource[1]]['subresourceLink']=$subResource[4];*/
                $contador2++;

                $getSubMenuNumber--;
            } 
            $contador++;
            $getMenuNumber--;
            //$data.='}';  
            //$data.='}';  
            if ($getMenuNumber>0){$data.=',';} else{$data.=']';}
    } 
    //$data.='}';
    //echo '<pre>';          
    //print_r($data);
    //echo '<pre>'; 
   
   //echo json_decode($data);     
   echo json_encode($data,JSON_UNESCAPED_SLASHES);   
   //echo json_encode($data);
   //echo $data;
    mysqli_close($conexion2);
    mysqli_close($conexion);

?>