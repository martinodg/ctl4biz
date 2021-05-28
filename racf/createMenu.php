<?

    if(session_id() == '') {
    session_start();
}
 

$id_intUser=$_SESSION["id"];
require_once(__DIR__.'/../conectar7.php');
if (!$conexion) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


