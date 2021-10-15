<?php
// to call this api, id must be provided for the output id to be passed, numberOfItemsToLoad=999 will return the first menu in the table and the result will give you back the remaining number of menues to be loaded.
// if you pass SubMenuOf=0 the api will back you the menu items, otherwise you need to provide the number of menu you want to set for query the submenues.
session_start();
$userid=$_SESSION['id'];
require_once("../../varConnUserDB.php"); 
$query_getMenu="SELECT DISTINCT resourcesTable.id_resource, resourcesTable.resourceName,resourcesTable.traslation_tag,resourcesTable.iconLink FROM resourcesTable, resourcesToRolesTable,rolesToUsersTable WHERE resourcesTable.id_resource=resourcesToRolesTable.id_resource AND resourcesToRolesTable.borrado=0 AND rolesToUsersTable.id_role=resourcesToRolesTable.id_role AND rolesToUsersTable.borrado=0 AND rolesToUsersTable.id_intUser='$userid' AND resourcesTable.id_resource <>8 AND resourcesTable.id_resource <>9 ORDER BY resourcesTable.id_resource DESC";
$errorMessage="";

if(isset($_GET['id'])) {$id=$_GET['id'];}else{$errorMessage.="getMenuItemsToLoad.php Messages: id Number is mandatory";}
if(isset($_GET['numberOfItemsToLoad'])) {$numberOfItemsToLoad=$_GET['numberOfItemsToLoad'];
    if(isset($_GET['SubMenuOf'])){$SubMenuOf=$_GET['SubMenuOf'];
                                    //echo $SubMenuOf;
                                    if ($SubMenuOf > 0){
                                        $query_getMenu="SELECT DISTINCT subResourceTable.id_sresource, subResourceTable.subResourceName,subResourceTable.traslation_tag,subResourceTable.iconLink, subResourceTable.subresourceLink FROM subResourceTable, subresourcesToRolesTable,rolesToUsersTable WHERE subResourceTable.id_sresource=subresourcesToRolesTable.id_subresource AND subresourcesToRolesTable.borrado=0 AND rolesToUsersTable.id_role=subresourcesToRolesTable.id_role AND rolesToUsersTable.borrado=0 AND rolesToUsersTable.id_intUser='$userid' AND subResourceTable.id_resource='$SubMenuOf' ORDER BY subResourceTable.id_sresource DESC ";
                                   
                                    }
                                }else{$SubMenuOf=0;}

    $conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");
    
    //echo $query_getMenu;
    $rs_query_getMenu=mysqli_query($conexion,$query_getMenu);
    if ($numberOfItemsToLoad==999){$numberOfItemsToLoad=mysqli_num_rows($rs_query_getMenu);}
    //echo $numberOfItemsToLoad;
    $remains=$numberOfItemsToLoad-1;
    while ($numberOfItemsToLoad > 0) {
        $resource = mysqli_fetch_row($rs_query_getMenu);

        //echo $SubMenuOf;
        if ($SubMenuOf==0)  {
                                $data= array("id"=>$id, "id_resource"=>$resource[0], "resourceName"=>$resource[1],"traslation_tag"=>$resource[2], "iconLink"=>$resource[3],"numberOfItemsToLoad"=>$remains);
                            }else{ $data= array("id"=>$id,"id_resource"=>$SubMenuOf, "resourceName"=>$resource[1],"traslation_tag"=>$resource[2], "iconLink"=>$resource[3],"resourceLink"=>$resource[4],"numberOfItemsToLoad"=>$remains);
                            } 
        $numberOfItemsToLoad--;                    
    }  
    mysqli_close($conexion);
    echo json_encode($data,JSON_UNESCAPED_SLASHES); 


}else{$errorMessage.="getMenuItemsToLoad.php Messages: Number of remaining Items is mandatory";
        echo $errorMessage;
    }
?>