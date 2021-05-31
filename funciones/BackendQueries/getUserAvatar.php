<?
session_start();
$userid=$_SESSION['id'];
include "../../conectar7.php";
$query_user="SELECT intUser_name , avatar FROM intUsersTable WHERE id_intUser='$userid';";
$rs_user=mysqli_query($conexion,$query_user);
$nr_users= mysqli_num_rows($rs_user);
                 while ($nr_users > 0) {
                            $row = mysqli_fetch_row($rs_user);
                            echo '<img id="avatarNavImg" class="avatarNav"  src="../../img/'.$row[1].'" title="'.$row[0].'">';
                            $nr_users--;
                        }
?>