<?php
session_start();
$userid=$_SESSION['id'];
require_once("../../varConnUserDB.php"); 
require_once("getNewLineNumber.php"); 
if (isset($_GET["res"])){ $res=$_GET["res"];}
if (isset($_GET["menu"])){ $menu=$_GET["menu"];
                            if($menu=="sub"){ 
                                $query_getMenu="SELECT DISTINCT subResourceTable.id_sresource, subResourceTable.subResourceName,subResourceTable.traslation_tag,subResourceTable.iconLink, subResourceTable.subresourceLink FROM subResourceTable, subresourcesToRolesTable,rolesToUsersTable WHERE subResourceTable.id_sresource=subresourcesToRolesTable.id_subresource AND subresourcesToRolesTable.borrado=0 AND rolesToUsersTable.id_role=subresourcesToRolesTable.id_role AND rolesToUsersTable.borrado=0 AND rolesToUsersTable.id_intUser='$userid' AND subResourceTable.id_resource='$res' ORDER BY subResourceTable.id_sresource ASC ";
                                //echo $query_getMenu;
                            

//$errorMessage='';

//echo $userid;



$conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");
$rs_query_getMenu=mysqli_query($conexion,$query_getMenu);
$getMenuNumber= mysqli_num_rows($rs_query_getMenu);
while ($getMenuNumber > 0) {
            
            $row = mysqli_fetch_row($rs_query_getMenu);

            echo '<div class="icons_menu"><a href="#"  id="a-'.$row[1].'"><img src="../../img/'.$row[3].'" class="iconolado2 icono-'.$row[1].'" id="'.$row[1].'img" onClick="openTargetPage(&apos;'.$row[4].'&apos;)" alt="'.$row[1].'"><span id="'.$row[2].'"></span></div></a>';

                   
                    

                    $getMenuNumber--;
}
echo '<script>traducirVista();</scirpt>';}

}else{
    $query_getMenu="SELECT DISTINCT resourcesTable.id_resource, resourcesTable.resourceName,resourcesTable.traslation_tag,resourcesTable.iconLink FROM resourcesTable, resourcesToRolesTable,rolesToUsersTable WHERE resourcesTable.id_resource=resourcesToRolesTable.id_resource AND resourcesToRolesTable.borrado=0 AND rolesToUsersTable.id_role=resourcesToRolesTable.id_role AND rolesToUsersTable.borrado=0 AND rolesToUsersTable.id_intUser='$userid' AND resourcesTable.id_resource <>8 AND resourcesTable.id_resource <>9 ORDER BY resourcesTable.id_resource ASC";

    //$errorMessage='';

    //echo $userid;



    $conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: La Funcion insertTempInvoice no puede conectar con la base de datos");
    $rs_query_getMenu=mysqli_query($conexion,$query_getMenu);
    $getMenuNumber= mysqli_num_rows($rs_query_getMenu);
    while ($getMenuNumber > 0) {
            
            $row = mysqli_fetch_row($rs_query_getMenu);

            echo '<div class="icons_menu"><a href="#"  id="a-'.$row[1].'"><img src="../../img/'.$row[3].'" class="iconolado2 icono-'.$row[1].'" id="'.$row[1].'img" onClick="openSubresMenu(&apos;'.$row[0].'&apos;)" alt="'.$row[1].'"><span id="'.$row[2].'"></span></div></a>';

                   
                    

                    $getMenuNumber--;
    }

}
echo '<script>traducirVista();</scirpt>';
mysqli_close($conexion); 
?>