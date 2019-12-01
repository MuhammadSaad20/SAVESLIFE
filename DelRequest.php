<?php
require_once "config.php";
session_start();
$t1=$_GET['con'];
echo "$t1";
$sql="DELETE FROM `req` WHERE rid=$t1";
if($stmt = mysqli_prepare($connect, $sql)){

    if(mysqli_stmt_execute($stmt)==true){
        
        header("location: showrequestdonor.php");
    }   
    
}


?>