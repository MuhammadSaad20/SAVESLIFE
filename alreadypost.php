<?php

require_once "config.php";
session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.  You Already POST this Request If you want to Post Again Delete Old Request Or Post with diffrent Location Or Blood Group.</h1>
    </div>
    <p>
        <a href="showrequestdonor.php" class="btn btn-info">Show Requests</a>
        <a href="donor_dashboard.php" class="btn btn-primary" > Dash Board</a>

    </p>
   
    
</body>
</html>