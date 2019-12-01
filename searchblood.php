<?php
 //to disable Notice errors on System. Notices removal.
 //error_reporting( error_reporting() & ~E_NOTICE );
require_once "config.php";
session_start();
$s="y";
$s_err="";
$stmt="";
function datefuc($m){
    $reqdate = new DateTime($m);
    $now = new DateTime();
    
    //echo $date->diff($now)->format("%d days, %h hours and %i minuts Ago")
    echo $reqdate->diff($now)->format("%d days Ago") ;
    
}     
    if(isset($_POST['s']))
    {   
        $s=$_POST['s'];
    }
    //$msg="SELECT u.username,u.email,r.date from users u,req r where u.location='$s' ";
    $msg="SELECT u.username, u.email, r.date,r.location,r.blood_group,r.rid,bp.bg_price FROM users u, req r, bloodprices bp  
    where r.location='$s' and u.id=r.did_fk and r.blood_group=bp.bg and r.reqstatus=0";
    $stmt=mysqli_query($connect,$msg);
    

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
              <li><a href="searchblood.php">search</a></li>
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
        <h3><i class="fa fa-angle-right"></i>Search Request</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <h4 class="title" style="font-size:20px">Please Select Area Where You Want to get Blood:</h4>
            <div id="message"></div>
            
			  
	<form class="request" name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   
            <select style="width:1550px" class="form-control" name="s">
            
 
         <!--   <option  selected>Chose Area</option> -->
            <option value="Gulshan">Gulshan</option>
            <option value="Defence">Defence</option>
            <option value="Malir">Malir</option>
            <option value="TSKR">Tskr</option>
            <option value="Hadeed">Hadeed</option>
            <option value="North Nazimabad">North Nazimabad</option>
            <option value="North Karachi">North Karachi</option>
            <option value="Clifton">Clifton</option>
            <option value="Lyari">Lyari</option>
            <option value="Gulberg">Gulberg</option>
            <option value="Korangi">Korangi</option>
            
            
                  
            </select>
    
    <br>
    

                <div class="form-group" style="text-align:center; margin-left:725px;">
                <input type="submit" class="btn btn-info" value="Search">
                </div>
   
      </form>
			  
			  
          </div>
        </div>
      </section>
    </section>
	</section>
	  
	  <?php
        function customError($errno, $errstr) {
            echo "<b>Error:</b> [$errno] $errstr<br>";
            echo "Ending Script";
            die();
          }
          set_error_handler("customError",E_USER_WARNING);
         // if($stmt->num_row > 0)
          //{
          while (($row = $stmt->fetch_assoc()) != NULL) {
            
        ?>    
                 


        <table align="center" border="4px" style="width:1550px; line-height:100px; margin-left:230px; color:black; font-size:20px; background-color:white;">
        <tr>
        <th colspan="8"  ><h3 align="center">Donors In Your Areas</h3></th>
        </tr>
        <t>
        
        <th>Donor Name</th>
        <th>Email</th>
        <th>Post Request</th>
        <th>Location</th>
        <th>Blood Group</th>
        <th>Req ID</th>
        <th>Blood Price</th>

        <th></th>
        </t>
        
       <!-- here start -->
        <tr>
        
        <td><div align="center"><?php echo $row['username']; ?></div></td>
        <td><div align="center"><?php echo $row['email']; ?></div></td>
        <td><div align="center"><?php 
        $m= $row['date']; datefuc($m);?></div></td>
        <td><div align="center"><?php echo $row['location']; ?></div></td>
        <td><div align="center"><?php echo $row['blood_group']; ?></div></td>
        <td><div align="center"><?php echo $row['rid']; 
                 
            $p1=   $row['rid'];  ?></div></td>
       <!-- <td> <a href='dreqconf.php?con=/*  //echo $p1    ' >Connect Donor</a></td> -->
       <td><div align="center"><?php echo $row['bg_price']; ?></div></td>
         
			<td> <div align="center"> <a href='dreqconf.php?con=<?php   echo $p1   ?> '<button type="submit" class="btn btn-primary" > Connect Donor</button></a>
        </td>   
       </tr> 

    <?php    
 }  


     ?>
        
   
        
 <!-- --> </table> 
	

	<div style="margin-top:600px" class="req_footer">
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
