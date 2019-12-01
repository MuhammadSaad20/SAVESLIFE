<?php
require_once "config.php";
session_start();
$a=$_SESSION['id'];

function datefuc($m){
    $reqdate = new DateTime($m);
    $now = new DateTime();
    
    //echo $date->diff($now)->format("%d days, %h hours and %i minuts Ago")
    $D= $reqdate->diff($now)->format("%d days Ago") ;
    
    //echo $D;
       $H= $reqdate->diff($now)->format("%h hours Ago") ;
        $M=$reqdate->diff($now)->format("%i minuts Ago") ;
    //echo $D;
  if($D==0){if(  $H <= 24 && $H>=1 ) {echo $H;}  } 
    else if($D>=1){echo $D;}   

}

$sql="SELECT c.rid_fk, cl.id,cl.username, r.location, r.blood_group,bp.bg_price ,c.date 
FROM ctd c ,req r, cusers cl, bloodprices bp   
WHERE 
c.rid_fk=r.rid and r.did_fk=$a and c.cid_fk=cl.id and r.blood_group=bp.bg";
$stmt=mysqli_query($connect,$sql);

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["select"] == 2){
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title></title>

  

  
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  
  <link href="css/doyourself.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

 
</head>

<body>
  <section id="container">
   
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      
      <a href="index.html" class="logo"><b>Blood<span>Bank</span></b></a>
      
      
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </header>
    
    <aside>
      <div id="sidebar" class="nav-collapse ">
        
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="img/download.png" class="img-circle" width="80"></a></p>
           <h5 class="centered"><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</h5>
            <li class="mt">
            <a href="donor_dashboard.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
            </li>
          
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Connect Clients</span>
              </a>
            <ul class="sub">
              <li><a href="connectclients.php">connect with clients</a></li>
            </ul>
          </li>
			
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span>Show Requests</span>
              </a>
            <ul class="sub">
              <li><a href="showrequestdonor.php">shows</a></li>
            </ul>
          </li>
			
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Donate Blood</span>
              </a>
            <ul class="sub">
			  <li><a href="drequest.php">Donate</a></li>
            </ul>
          </li>
          
        </ul>
      </div>
    </aside>
   
	<section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Connect with clients</h3>
        
              
			  	<?php        while (($row = $stmt->fetch_assoc()) != NULL) {                               ?>




        
<table align="center" border="6px" style="width:1550px; line-height:100px; margin-left:10px; color:black; font-size:20px; background-color:white;">
<tr>
<th colspan="7"  ><h3 align="center"></h3></th>
</tr>
<t>

<th>Request ID</th>
<th>Client Name</th>
<th>Location</th>
<th>Blood Group</th>
<th>Amount Due</th>
<th>Connecting Post</th>
<th></th>
</t>

<!-- here start -->
<tr>

<td><div align="center"><?php echo $row['rid_fk']; 
         
    $p1=   $row['rid_fk']; $p2=$row['id'] ?></div></td>

<td><div align="center"><?php echo $row['username']; 
$pn=$row['username']; 
?></div></td>
<td><div align="center"><?php echo $row['location']; ?></div></td>
<td><div align="center"><?php echo $row['blood_group']; ?></div></td>
<td><div align="center"><?php echo $row['bg_price']; ?></div></td>
<td><div align="center"><?php $m= $row['date']; datefuc($m);?></div></td>
 
 <td> 
    <?php $str= "Hey Boy!!"?>
    <div align="center"><a href='Acceptconnection.php?p2=<?php   echo $p2   ?>  & p1= <?php   echo $p1   ?> & pn= <?php   echo $pn   ?> 
    '><button type="submit" class="btn btn-primary" > Connect Connection</button></a>
    </div>
    
   <!-- <br>  -->

  <!--  <div align="center"> <a href='DelConnection.php?p2=  <?php   echo $p2   ?> & p1= <?php   echo $p1   ?>         '>
    <button type="submit" class="btn btn-warning" > Decline Connection</button></a> 
    </div> -->
    
   <!-- <div align="center"> <a href='1.php?con=<?php   echo $p2   ?>&con1=<?php   echo $p1   ?>
    '><button type="submit" class="btn btn-warning" > Decline Connection</button></a> 
    </div>  -->
  
    
</td>
</tr> 






</table>



<?php           }             ?>
				
				
				
          
      </section>
    </section>
        
	</section>
	  
	  
	  
	<div class="conn_footer">
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Blood Bank</strong>. All Rights Reserved
        </p>
        <div class="credits">
          Created by Blood Bank System <a href="https://templatemag.com/"></a>
        </div>
        <a href="panels.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
	</div>
    <!--footer end-->
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>

</body>

</html>