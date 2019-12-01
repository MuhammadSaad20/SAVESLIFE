<?php

require_once "config.php";
session_start();
$i=$_SESSION['id'];
$sql="SELECT u.username,r.location,r.blood_group,cd.rid_fk,r.did_fk FROM ctd cd,users u,req r 
WHERE cd.ctdstatus=1 and r.reqstatus=1 and r.did_fk=u.id and cd.rid_fk=r.rid and cd.cid_fk=$i";
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
        <h3><i class="fa fa-angle-right"></i>Connected Connections</h3>
       
              
			<?php        while (($row = $stmt->fetch_assoc()) != NULL) {                               ?>




        
<table align="center" border="6px" style="width:1550px; line-height:60px; margin-left:10px; color:black; font-size:20px; background-color:white;">
<tr>
<th colspan="4"  ><h3 align="center"></h3></th>
</tr>
<t>

<th>Donor Name</th>
<th>Location</th>
<th>Blood Group</th>
<th></th>
</t>

<!-- here start -->
<tr>


<td><div align="center"><?php echo $row['username']; 
$n=$row['username']; ?></div></td>
<td><div align="center"><?php echo $row['location']; ?></div></td>
<td><div align="center"><?php echo $row['blood_group']; 
$p2=$_SESSION['id']; $p1=$row['rid_fk']; $a=$row['did_fk'];
?></div></td>
 
 <td> 
    <div align="center"> <a href='ChatClient.php?p2= <?php   echo $p2   ?> & p1= <?php   echo $p1   ?> 
    & a= <?php   echo $a   ?>  & n= <?php   echo $n   ?>' > 
    <button type="submit" class="btn btn-primary" > Send Message</button></a>
    </div>
    
    
    <div align="center"> <a href='Recepit.php?p2= <?php   echo $p2   ?> & p1= <?php   echo $p1   ?> 
    & a= <?php   echo $a   ?>  '> 
    
    <button type="submit" class="btn btn-primary" >Genrate Payment Receipt</button></a>
    
    
    <br>
 
    <div align="center"> <a href='ClientDelConnection.php?p2= <?php   echo $p2   ?> & p1= <?php   echo $p1   ?> '>
    <button type="submit" class="btn btn-primary" > Delete Connection</button></a> 
    </div>
    
</td>
</tr> 






</table>



<?php           }             ?>
				
			 
      </section>
    </section>
        
	</section>
	  
	  
	  
	<div class="req_footer" style="margin-top:700px">
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