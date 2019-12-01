<?php

require_once "config.php";
session_start();
$a1=$_GET['t1']; //cid
$a2=$_GET['t2']; //rid
echo " cid $a1";
//echo "<br>";
echo "rid: $a2";

$sql="DELETE FROM `ctd` WHERE cid_fk=$a1 and rid_fk=$a2 and ctdstatus=1";
if($stmt = mysqli_prepare($connect, $sql)){

    if(mysqli_stmt_execute($stmt)==true){
        
      $sql1="UPDATE req SET reqstatus=0 WHERE rid=$a2";
        if($stmt1 = mysqli_prepare($connect, $sql1)){

            if(mysqli_stmt_execute($stmt1)==true){
        
            header("location: connectclients.php");
        } 
      }
    }  
  }


?>