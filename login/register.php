<?php
require_once("../conectar.php"); 
$compania=$_POST["company_name"];
$nombre=$_POST["name"];
$emilio=$_POST["email"];
$clave=$_POST["password"];
$language=$_POST["language"];


// ************************php functions****************************
//convert string to MD5 code
function strToMD5($string){
    $md5strng= md5($string);
    $cleaner = trim(strip_tags($md5strng));
    return $cleaner;
}
// generate a random password
function randomPassword($length) {
 
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&_";
    $password = substr( str_shuffle( $chars ), 0, $length );         
    return $password; 
}
// **********************end php functions***************************************


// verify if company and mail already exist
$query_verify="SELECT * FROM login_data WHERE login_data.master_user='".$emilio."' and login_data.company_name='".$compania."';";
$result = mysqli_query($conexion,$query_verify);
if (mysqli_num_rows($result)>0 ) {
     //if company and mail exist send alert and back to register form
     if ($language=="0"){
        $errorm='The Company name and email you just entered already exist as CTL4.biz registered user';
    }else{
        $errorm='En nombre de la compania e email provistos ya existen como usuarios de CTS4.biz';
    }
    echo "<script>alert('$errorm');</script>";
   
    //Go to login page
    echo"<script>
            window.location = 'register.html';
        </script>";
    exit;
}else{

    //Create Id Company, Database user and password which will be inserted on the Database 
    $id_company="T_".strToMD5($compania."_".$emilio);
    $DB_user=strToMD5($compania);
    $DB_password=randomPassword(16);
    echo "El nombre de la base de datos es: ".$id_company."<br>";
    //Create company folders to hold images
   
    $path="./img/$id_company";
    $path1="./img/$id_company/users";
    $path2="./img/$id_company/items";
    mkdir($path, 0777);/* Create folder for company */
    mkdir($path1, 0777);/* Create folder for users */
    mkdir($path2, 0777);/* Create folder for items */


    $query_login_insert="INSERT INTO login_data (company_name,id_company,master_user,db_user,db_password) VALUES ('$compania','$id_company','$emilio','$DB_user','$DB_password');";
    $rs_login_insert=mysqli_query($conexion,$query_login_insert);
    mysqli_close($conexion);
    // Create connection
    $conn1 = new mysqli($Servidor,$Usuario,$Password);
        // Check connection
        if ($conn1->connect_error) {
        die("connection failed: " . $conn1->connect_error)."<br>";
        }
    
        // Create database
        echo "Creando base de datos<br>";
        $sql = "CREATE DATABASE ".$id_company.";";
        echo $sql."<br>";
        if ($conn1->query($sql) === TRUE) {
            echo "Database created successfully<br>";
        } else {
            echo "Error creating database: " . $conn1->error ."<br>";
        }
        echo "**********************************************************<br>";
        echo "Creando usuario<br>";
        // Create Master-User for Database
        $sql2 = "GRANT CREATE ON $id_company.* TO '$DB_user'@'%' IDENTIFIED BY '$DB_password';";
        echo $sql2."<br>";
        if ($conn1->query($sql2) === TRUE) {
            echo "User created successfully<br>";
        } else {
            echo "Error creating user: " . $conn1->error."<br>";
        }
        echo "**********************************************************<br>";
        echo "Dando privilegios al usuario<br>";
        // Grant permisions to master-user for new DB
        $sql3 = "GRANT SELECT, INSERT, ALTER, UPDATE, DELETE, CREATE, LOCK TABLES ON $id_company.* TO '$DB_user'@'%';";
        echo $sql3."<br>";
        if ($conn1->query($sql3) === TRUE) {
            echo "Privileges granted successfully<br>";
        } else {
            echo "Error granting permits: " . $conn1->error."<br>";
        }   
    $conn1->close();
    echo "**********************************************************<br>";
    echo "Importando tabla<br>";
    //load model DB on the new created DB  
    $sql4 = file_get_contents('../database'.$language.'.sql');
    $sql4 .= <<<APPND_TXT
     -- Dumping data for table `intUsersTable`
     INSERT INTO intUsersTable (intUser_name,user_name,password,codstatus,borrado) VALUES ('$nombre','$emilio','$clave','4','0');

     -- Finish the trasacction with commit
     COMMIT;
APPND_TXT;

    $conn2 = new mysqli("$Servidor", "$DB_user", "$DB_password", "$id_company");
        if (mysqli_connect_errno()) { /* check connection */
            printf("connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        /* execute multi query */
        if ($conn2->multi_query($sql4)) {
            echo "succeded<br>";
            echo $sql4;
            //$conn2->next_result();
    
        } else {
            echo "error<br>";
            echo $sql4;
        }
    $conn2->close();
//Load master-user on internal users table
    //$conn3 = new mysqli("$Servidor", "$DB_user", "$DB_password", "$id_company");
        // Check connection
       // $conn3=mysqli_connect("$Servidor", "$DB_user", "$DB_password", "$id_company") or die("Error: El servidor no puede conectar con la base de datos");
       /* if ($conn3->connect_error) {
        die("connection failed: " . $conn3->connect_error)."<br>";
        }else{echo "connection 3  succeded <br> to Server: $Servidor DB User: $DB_user DB password: $DB_password and Database: $id_company <br>";}*/
        //$sql5="INSERT INTO intUsersTable (intUser_name,user_name,password,codstatus,borrado) VALUES ('$nombre','$emilio','$clave','4','0');";
        //$sql5="INSERT INTO intUsersTable (intUser_name, user_name, password, codstatus, borrado) VALUES ('$nombre','$emilio', '$clave', '4', '0')";
      //  $sql5="UPDATE intUsersTable SET intUser_name='$nombre', user_name='$emilio', password='$clave', codstatus='4' WHERE id_intUser='1'";

        //$sql5="UPDATE intUsersTable SET intUser_name='$nombre', user_name='$emilio', password='$clave', codstatus='4' WHERE id_intUser='1'";
      //  echo $sql5;
     //   $rs_intUser=mysqli_query($conn3,$sql5)or die(mysqli_error($conn3));
        
     //   mysqli_close($conn3);
       /* if ($conn3->query($sql5)) {
            echo "Creation of intrenal user succeded <br>";
        }else{
            echo "error happend on internal user creation <br>" . $conn3->error."<br>";
            echo $sql5;
        }
    $conn3->close();*/
    //Go to login page
    echo"<script>
            window.location = 'login.php';
        </script>";
    exit;
}
   
