<?php
require_once "config.php";
session_start();

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
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  
  <link href="css/doyourself.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- 2Checkout JavaScript library -->
  <script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
	
<script>
// Called when token created successfully.
var successCallback = function(data) {
  var myForm = document.getElementById('paymentFrm');
  
  // Set the token as the value for the token input
  myForm.token.value = data.response.token.token;
  
  // Submit the form
  myForm.submit();
};

// Called when token creation fails.
var errorCallback = function(data) {
  if (data.errorCode === 200) {
    tokenRequest();
  } else {
    alert(data.errorMsg);
  }
};

var tokenRequest = function() {
  // Setup token request arguments
  var args = {
    sellerId: "901416156",
    publishableKey: "8BF58BB8-9A7D-4997-BC24-539A018CAD82",
    ccNo: $("#card_num").val(),
    cvv: $("#cvv").val(),
    expMonth: $("#exp_month").val(),
    expYear: $("#exp_year").val()
  };
  
  // Make the token request
  TCO.requestToken(successCallback, errorCallback, args);
};

$(function() {
  // Pull in the public encryption key for our environment
  TCO.loadPubKey('sandbox');
  
  $("#paymentFrm").submit(function(e) {
    // Call our token request function
    tokenRequest();
   
    // Prevent form from submitting
    return false;
  });
});
</script>
 
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
        <h3 style="font-size:30px;"><i class="fa fa-angle-right"></i>Payment Gateway</h3>
        
		  
				<div style="margin-top:40px; height:50px;" class="card-header">
					<h5 style="color:black; font-size:20px;">Charge $25 USD with 2checkout</h5>
				</div>
				<div class="card-body">
				
		<form id="paymentFrm" method="post" action="paymentSubmit.php">
        <div class="form-group">
            <p style="font-size:20px;">Name</p>
            <input style="font-size:17px;" type="text" class="form-control" name="name" id="name" placeholder="Enter name" required autofocus>
        </div>
        <div class="form-group">
            <p style="font-size:20px;">Email</p>
            <input style="font-size:17px;" type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <p style="font-size:20px;">Card Number</p>
            <input style="font-size:17px;" type="text" class="form-control" name="card_num" id="card_num" placeholder="Enter card number" autocomplete="off" required>
        </div>
        <div class="row">
			<div class="col-sm-8">
				<div class="form-group">
            <p style="font-size:20px;"><span class="hidden-xs">EXPIRY DATE</span></p>
			<div class="input-group">
            <input style="font-size:17px;" type="number" name="exp_month" id="exp_month" class="form-control" placeholder="MM" required>
            <input style="font-size:17px;" type="number" name="exp_year" id="exp_year" class="form-control" placeholder="YY" required>
			</div>
        </div>
			</div>
		
			
        <div class="col-sm-4">
		<div class="form-group">
            <p style="font-size:20px;">CVV</p>
            <input style="font-size:17px;" type="number" name="cvv" id="cvv" class="form-control" autocomplete="off" required>
        </div>
		</div>
			</div>
			
			
        <input id="token" name="token" type="hidden" value="">
        
        <input style="font-size:17px;" type="submit" class="btn btn-primary" value="Submit Payment">
    </form>
				
				</div>
			
		  
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