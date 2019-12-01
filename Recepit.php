<?php

require_once "config.php";
session_start();
$t1=$_GET['p2']; //cid
$t2=$_GET['p1']; // rid
$t3=$_GET['a']; //did
//echo "cid : $t1";
//echo "rid : $t2";
//echo "did : $t3";

$sql="SELECT u.id AS E,u.username AS F,cu.id,cu.username,r.rid,r.blood_group,r.location,bp.bg_price FROM 
cusers cu,users u ,req r,bloodprices bp,ctd ct 
WHERE cu.id=$t1 and r.rid=$t2 and u.id=$t3 and bp.bg= r.blood_group and r.reqstatus=1 and ct.ctdstatus=1 
AND r.rid=ct.rid_fk and cu.id=ct.cid_fk";
$stmt=mysqli_query($connect,$sql);


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
            <a href="client_dashboard.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
            </li>
          
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Search Blood</span>
              </a>
            <ul class="sub">
              <li><a href="searchblood.php">Search</a></li>
            </ul>
          </li>
			
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span>See Connected Connections</span>
              </a>
            <ul class="sub">
              <li><a href="client_connected_connection.php">connections</a></li>
            </ul>
          </li>
          
        </ul>
      </div>
    </aside>
   
	<section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Payment Receipt</h3>
        <div class="row">
          <div class="col-md-12">
            <div class="content-panel">
              
			     <?php        while (($row = $stmt->fetch_assoc()) != NULL) {                               ?>




        
<table align="center" border="30px" style="width:1550px; line-height:100px; color:black; font-size:20px;">
<tr>
<th colspan="1"  ><h3 align="center" style="font-size:40px">Payment Receipt </h3></th>
</tr>
<t>

<th  align="center"></th>


<!-- here start -->
<tr>


<td><div align="center">
<b>
<?php 

echo   "Donor ID: "; 
echo   $row['E']; 
echo "&nbsp&nbsp&nbsp&nbsp";
echo   "Donor Name: ";
echo   $row['F']; 
echo "&nbsp&nbsp&nbsp&nbsp";

echo "<br>";
echo   "Client ID: "; 
echo $row['id']; 
echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
echo   "Client Name: "; 
echo  $row['username']; 
echo "<br>";

echo   "Request ID: ";
echo  $row['rid']; 
echo "&nbsp&nbsp&nbsp&nbsp";
echo   "Blood Group: "; 
echo $row['blood_group']; 
echo "<br>";

echo   "Location: "; 
echo $row['location']; 
echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
echo   "Amount Due: "; 
echo $row['bg_price']; 
echo "<br>";




?></div></td>
</b>

</tr> 






</table>



<?php           }             ?>
				
			<div align="center" style="margin-top:20px;">
				 <a class="btn btn-primary" href="pay.php">Payment</a>
			</div>
				
            </div>
			</div>
		  </div>
      </section>
    </section>
        
	</section>
	  
	  
	  
	<div class="req_footer">
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