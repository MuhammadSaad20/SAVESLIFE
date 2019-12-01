<?php

require_once "config.php";
session_start();
//$a=$_GET['c']; //chat
//$username=$_SESSION['chat'];
//$a1=$_GET['p1']; // cid
//$a2=$_GET['t2']; //rid
//$a3=$_GET['t3']; //did
//echo $a1;
//echo $a2;
//echo $a3;
echo $_POST["t2"];
echo $_POST["chat"];
$a=$_POST["chat"];
$b=$_POST["t2"];
$c=$_SESSION['id'];

echo $a;
echo $b;
echo $c;

//echo $username;
$sql =  "UPDATE msg SET chat='$a' WHERE cid_fk=$c and rid_fk=$b";
        $stmt = mysqli_prepare($connect, $sql);
       if(mysqli_stmt_execute($stmt)==true){
        header("location: client_connected_connection.php");
            
        }

?>