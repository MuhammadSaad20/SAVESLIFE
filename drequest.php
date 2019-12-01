<?php
// Include config file
require_once "config.php";
session_start();
// Define variables and initialize with empty values
 $location ="";
 $location_err = "";
 $did_fk="";
 $blood_group="";
 $blood_group_err="";

$avablity=$blood_group=$price=""; //
$avablity_err=$blood_group_err=$price_err="";

 $sql="";
$cnt=0;
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["select"] == 2){
    header("location: login.php");
    exit;
}
 
function built_error($cnt){
    if($cnt==1){
    echo "Something went wrong.You my left empty some fields or Please try again later.";
    }
    else{
        //do nothing
    }    
}
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    
    //validate location
    if(empty(trim($_POST["location"]))){
        $location_err = " Please enter a location."; //change here
    } else{
        // Prepare a select statement
        
            $sql = "SELECT rid FROM req WHERE location = ?";
        
        //$sql = "SELECT id FROM users WHERE location = ?";
        
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_location);
            
            // Set parameters
            $param_location = trim($_POST["location"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                 
                    $location = trim($_POST["location"]);
                
            } else{
                echo "Please Enter location.";
            }
            mysqli_stmt_close($stmt);
        }

        else if($stmt==false){
            echo"location ";
            $cnt++; 
            built_error($cnt);
        }
        // Close statement
        
    }
        
    
        //validate blood group
    if(empty(trim($_POST["blood_group"]))){
        $blood_group_err = "Please Chose a Blood Group."; //change here
    } else{
        // Prepare a select statement
            //if($blood_group != "blo")
           // $sql = "SELECT rid FROM req WHERE blood_group = 'A+' ";
            $sql = "SELECT rid FROM req WHERE blood_group = ? ";
        
        //$sql = "SELECT id FROM users WHERE location = ?";
        
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_blood_group);
            
            // Set parameters
            $param_blood_group = trim($_POST["blood_group"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                 
                    $blood_group = trim($_POST["blood_group"]);
                
            } else{
                echo "Please Chosed Blood Group.";
            }
            mysqli_stmt_close($stmt);
        }

        else if($stmt==false){
            echo"location ";
            $cnt++; 
            built_error($cnt);
        }
        // Close statement
        
    }



        $a=$_SESSION["id"]; //stored fk value (banquet website client portal id do same thing saad!);
        
    
    // Validate password
    // Check input errors before inserting in database
    $i=$location;
    $j=$blood_group;
    if(  empty($location_err)  ) {
        

     //   echo "$i";
       // echo "<br>";
       // echo "$j";            
       $sql1= "SELECT count(*) AS cnt FROM req WHERE did_fk = $a  and location='$i' and blood_group='$j' ";
        $stmt1=mysqli_query($connect,$sql1);
        while  ( ( $row = $stmt1->fetch_assoc() ) != NULL){
        $m = $row['cnt'];
        }
        if($m == 0){

            $sql = "INSERT INTO  req (did_fk,location,blood_group) VALUES ($a,?,?)";
        
            if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_location,$param_blood_group);
            
            // Set parameters
            $praam_location= $location;
            if(mysqli_stmt_execute($stmt)==true){
                // Redirect to login page
                
                
                header("location: donor_dashboard.php");
            } 
            else if(mysqli_stmt_execute($stmt)==false)
            {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }//stmt prepare
       }//m==0 
        else if($m>0){
            header("location:alreadypost.php");
        }
    } //location error
    
    // Close connection
    mysqli_close($connect);
}//server
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
              <li><a href="showrequestdonor.php">show</a></li>
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
        <h3><i class="fa fa-angle-right"></i>Upload Request</h3>
        
        <div class="row mt">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <h4 class="title" style="font-size:20px;">Enter your location:</h4>
            <div id="message"></div>
            <form class="request" class="contact-form php-mail-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				
              
            <select style="width:1550px;"  class="form-control" name="location">
            
 
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
              
            
              
			<h4 class="title" style="font-size:20px;">Chose Blood Group:</h4>
            
            <select style="width:1550px;" class="form-control" name="blood_group">
          <!--  <option selected>Blood Group</option>-->
            <option value="A+">A+</option>
            <option value="O+">O+</option>
            <option value="B+">B+</option>
            <option value="AB+">AB+</option>
            <option value="A-">A-</option>
            <option value="O-">O-</option>
            <option value="B-">B-</option>
            <option value="AB-">AB-</option>
            </select>

              <div class="req_submit" class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit Form">
              </div>

            </form>
          </div>
        </div>
      </section>
    </section>
	</section>
	  
	<div style="margin-top:500px;" class="req_footer">
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
