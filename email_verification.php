<?php
//$code=$_GET['code'];
//$s=$_GET['s'];
//echo $coe;
//echo $s
$msg="";
include 'config.php';

if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=$_GET['code'];
$s=$_GET['s'];
if($s==1){
$sql=mysqli_query($connect,"SELECT * FROM users WHERE verfkey='$code'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
  
$st=0;
$result =mysqli_query($connect,"SELECT id FROM users WHERE verfkey='$code' and status='$st'");
$result4=mysqli_fetch_array($result);   

if($result4>0) 
{
$st=1;
$result1=mysqli_query($connect,"UPDATE users  SET status='$st' WHERE verfkey='$code'");
$msg="Your account is activated"; 
}
else
{
$msg ="Your account is already active, no need to activate again";
}
}
else
{
$msg ="Wrong activation code.";
}
}//status =1
else if($s==2){
    $sql=mysqli_query($connect,"SELECT * FROM cusers WHERE verfkey='$code'");
    $num=mysqli_fetch_array($sql);
    if($num>0)
    {
      
    $st=0;
    $result =mysqli_query($connect,"SELECT id FROM cusers WHERE verfkey='$code' and status='$st'");
    $result4=mysqli_fetch_array($result);   
    
    if($result4>0) 
      {
    $st=1;
    $result1=mysqli_query($connect,"UPDATE cusers SET status='$st' WHERE verfkey='$code'");
    $msg="Your account is activated"; 
    }
    else
    {
    $msg ="Your account is already active, no need to activate again";
    }
    }
    else
    {
    $msg ="Wrong activation code.";
    }
    }//else if end
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>SAVES LIFE BLOOD BANK| Email Verification </title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-header">
        <a class="navbar-brand" rel="home" href="Home.php">Home</a>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			
		</ul>
		
	</div>
</nav>

<div class="container-fluid">
  
 
      
     
 <!--/left-->
  
  <!--center-->
  <div class="col-sm-6">
    <div class="row">
      <div class="col-xs-12">
        <h3>PHP Email Verification Script </h3>
		<hr >
	<p><?php echo $msg;//echo htmlentities($msg); ?></p>
   <p> Now you can login</p>
   <p>For login <a href="checklogin.php">Click Here</a></p>
 
      </div>
    </div>
    <hr>
        
   
  </div><!--/center-->

  <!--right-->
  <div class="col-sm-4">
  
    	<div class="panel panel-default">
         	
         
</div>
        </div>
    
      
     
  </div>
<!--/right-->
  <hr>
</div><!--/container-fluid-->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>