<?php

require_once "config.php";
session_start();
$t1=$_GET['p2']; //cid
$t2=$_GET['p1']; //rid
echo " cid $t1";
//echo "<br>";
echo "rid: $t2";

$sql="DELETE FROM `ctd` WHERE cid_fk=$t1 and rid_fk=$t2";
if($stmt = mysqli_prepare($connect, $sql)){

    if(mysqli_stmt_execute($stmt)==true){
        
        $sql1="UPDATE req SET reqstatus=0 WHERE rid=$t2";
        if($stmt1 = mysqli_prepare($connect, $sql1)){

            if(mysqli_stmt_execute($stmt1)==true){
        
                header("location: client_connected_connection.php");
            }
        }
    
    
    }   
    
}


?>

