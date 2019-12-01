<?php

require_once "config.php";
session_start();
$a=$_SESSION['id'];
//$sql="SELECT rid,location,blood_group FROM req WHERE did_fk=$a and reqstatus=0";
$sql="SELECT r.rid,r.location, r.blood_group,bp.bg_price FROM req r,bloodprices bp 
WHERE r.did_fk=$a and r.reqstatus=0 and r.blood_group=bp.bg";

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
      
      <a href="#" class="logo"><b>Blood<span>Bank</span></b></a>
      
      
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
        <h3><i class="fa fa-angle-right"></i>Donor Requests</h3>
        
              
			<?php        while (($row = $stmt->fetch_assoc()) != NULL) {                               ?>
	  
	 <table align="center" border="6px" style="width:1550px; line-height:100px; margin-left:10px; color:black; font-size:20px; background-color:white;">
        <tr>
        <th colspan="5"  ><h3 align="center"></h3></th>
        </tr>
        <t>
        
        <th>Request ID</th>
        <th>Request Location</th>
        <th>Blood Group</th>
        <th>Price</th>

        <th></th>
        </t>
        
       <!-- here start -->
        <tr>
        
        <td><div align="center"><?php echo $row['rid']; 
                 
            $p1=   $row['rid'];  ?></div></td>
       
        <td><div align="center"><?php echo $row['location']; ?></div></td>
        <td><div align="center"><?php echo $row['blood_group']; ?></div></td>
        <td><div align="center"><?php echo $row['bg_price']; ?></div></td>
        
		<td> <div align="center"> <a href='DelRequest.php?con=<?php   echo $p1   ?> '<button type="submit" class="btn btn-primary" > DeleteRequest</button></a> 
        </td>
       </tr> 


        </table>



        <?php           }             ?>	
				
           
      </section>
    </section>
        
	</section>
	  
	  
	  
	<div style="margin-top:700px;" class="req_footer">
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