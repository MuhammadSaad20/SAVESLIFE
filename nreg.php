<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $email = $location =$select = $password = $confirm_password = $verfkey  ="";
$username_err = $email_err = $location_err = $select_err =$password_err = $confirm_password_err = "";
$s1="Donor";
$s2="Client";
$sql="";
$cnt=0;
 
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
 
    $select = trim($_POST["select"]);
    if(empty(trim($_POST["select"]))){
        $select_err = "Please select valid thing.";
    } 
    else{
        // Prepare a select statement
        if($select== 0){
            echo "Please chose how do you want to login.";
        }
        else if($select == 1)
        {$sql = "SELECT id FROM users WHERE username = ?";}
        else if ($select == 2){
            $sql = "SELECT id FROM cusers WHERE username = ?";
        } 
        
        $stmt = mysqli_prepare($connect, $sql);
        //$sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt == true){ /*Error 1*/
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_select);
            
            // Set parameters
            $param_select = trim($_POST["select"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                 
                    $select = trim($_POST["select"]);
                
            } else{
                echo "Please chose how do you want to login.";
            }
        
        mysqli_stmt_close($stmt); 
        }
        
        else if($stmt == false){
            echo"select ";
            $cnt++; 
            built_error($cnt);
        }
         
        // Close statement
        /*Error 2*/
    }
    
        // Validate username 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        if($select == 1)
        {$sql = "SELECT id FROM users WHERE username = ?";}
        else if ($select == 2){
            $sql = "SELECT id FROM cusers WHERE username = ?";
        } 
        
        
        //$sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($connect, $sql);
        if($stmt==true){ /*Error 3*/
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Please Enter Username!.";
            }
        mysqli_stmt_close($stmt);
        }
        else if($stmt==false){
            echo"username ";
            $cnt++; 
            built_error($cnt);
        } 
        
        // Close statement
         /*Error 4*/
    }
    
    
    
    //validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email."; //change here
    } else{
        // Prepare a select statement
        if($select == 1)
        {$sql = "SELECT id FROM users WHERE email = ?";}
        else if($select == 2){
            $sql = "SELECT id FROM cusers WHERE email=? ";
        }
    
        //$sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($connect, $sql);
        
        if($stmt==true){ /*Error 5*/
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) > 0){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Enter Valid Email.";
            }
        mysqli_stmt_close($stmt);
        }
        // Close statement
         /*Error 6*/
        else if($stmt==false){
           echo"email ";
            $cnt++; 
            built_error($cnt);
        }
    }
    
    //validate location
    if(empty(trim($_POST["location"]))){
        $location_err = "Please enter a location."; //change here
    } else{
        // Prepare a select statement
        
        if($select == 1)
        {$sql = "SELECT id FROM users WHERE location = ?";}
        else if ($select == 2){
            $sql = "SELECT id FROM cusers WHERE location = ?";
        }
        //$sql = "SELECT id FROM users WHERE location = ?";
        
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
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
    
        
        
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    $verfkey=md5(time().$username);
        if(!(empty($vkey))){
            //out
        }
        else{
            if($select == 1)
            {$sql = "SELECT id FROM users WHERE verfkey = ?";}
            else if ($select == 2){
                $sql = "SELECT id FROM cusers WHERE verfkey = ?";
            }
            //$sql = "SELECT id FROM users WHERE location = ?";
            
            if($stmt = mysqli_prepare($connect, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_verfkey);
                
                // Set parameters
                $param_verfkey= $verfkey;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    $param_verfkey= $verfkey;
                        
                    
                } else{
                    echo "Please Enter verfkey.";
                }
                mysqli_stmt_close($stmt);
            }
    
            else if($stmt==false){
                echo"verfkey ";
                $cnt++; 
                built_error($cnt);
            }
            // Close statement
        }
    // Check input errors before inserting in database
    if( empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)  ) {
        
        // Prepare an insert statement
        /*if($select== ""){
            echo "Oops! Something went wrong. Please chose how do you want to login.";
        }*/
        
        if($select == 1)
        {$sql = "INSERT INTO users (username, email, password, location, verfkey) VALUES (?, ?, ?, ?, ?)";}
        else if($select == 2){
            $sql = "INSERT INTO cusers (username, email, password, location, verfkey) VALUES (?, ?, ?, ?, ?)";
        } 
         
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username,$param_email, $param_password,$param_location,$param_verfkey);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $praam_location= $location;
            $param_verfkey=$verfkey;
            //$param_vkey= $vkey;     
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)==true){
                // Redirect to login page
                $to=$email;
                $msg= "Thanks for Registration.";   
                $subject="Email verification (saadnust71@gmail.com)";
                $headers .= "MIME-Version: 1.0"."\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                $headers .= 'From:BLOOD_BANK_SYSTEM(CLIENT_DONOR) | MuhammadSaad <saadnust71@gmail.com>'."\r\n";
        
    $ms.="<html></body><div><div>Dear $username,</div></br></br>";
    $ms.="<div style='padding-top:8px;'>Please click The following link For verifying and activation of your account</div>
    <div style='padding-top:10px;'><a href='http://localhost/mypro/email_verification.php?code=$verfkey&s=$select'>Click Here</a></div>
    <div style='padding-top:4px;'>Powered by <a href='flyingsolution.gq'>MS_Developers</a></div></div>
    </body></html>";
    mail($to,$subject,$ms,$headers);
    echo "<script>alert('Registration successful, please verify in the registered Email-Id');</script>";
    echo "<script>window.location = 'login.php';</script>";;

                
                header("location: login.php");
            } 
            else if(mysqli_stmt_execute($stmt)==false)
            {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title></title>
 
    <meta charset="UTF-8">
    
    <title></title>
    
    <link rel="stylesheet" href="styling.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
    body{background-image:url(images/pngtree-red-blood-paint-smoke-effect-background-image_313442.jpg); height:100%;}
</style>    

<body>
    
    <!--<nav class="navbar navbar-expand-lg navbar-red bg-light">
    <a class="navbar-brand" href="#" >BLOOD BANK MANAGMENT SYSTEM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>-->
  
    <header class="headernreg">
    <div class="signin_image">
      <img id="img1" src="images/26a16cbe6c24539d6fec034e43716d2e.png">
      <img id="img2" src="images/1_KJACFKJ0GKtnhgR7OmlPFA.gif">
    </div>
        
    <div class="signin_menu">
    <ul class="signin_list">
    <li><a href="Home.php"><i class="fa fa-home" style="font-size:24px; margin-right:10px"></i>Home</a>&nbsp;<span>|</span></li> &nbsp;
    <li><a href="aboutus.html"><i class="fa fa-user-secret" style="font-size:24px; margin-right:10px"></i>About US</a></li>           
    </ul>
    </div>
    </header>   
    
    <div class="client_signinbox">
        
    <img src="images/1588b3eef9f1607d259c3f334b85ffd1.png" class="client_signin_avatar">
    <h1 id="client_sign_in_txt">Sign up</h1>
        
        <form class="client_signin_inp" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <p><i class="fa fa-user-circle" style="margin-right:10px"></i>Username</p>
        <input placeholder="Enter Username" type="text" name="username" class="form-control" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        <p><i class="fa fa-address-book" style="margin-right:10px"></i>Email</p>
        <input placeholder="Enter Email" type="email" name="email" class="form-control" value="<?php echo $email; ?>">
        <span class="help-block"><?php echo $email_err; ?></span>
        </div>
            
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <p><i class="fa fa-lock" style="margin-right:10px"></i>Password</p>
        <input placeholder="Enter Password" type="password" name="password" class="form-control" value="<?php echo $password; ?>">
        <span class="help-block"><?php echo $password_err; ?></span>
        </div>
            
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
        <p><i class="fa fa-lock" style="margin-right:10px"></i>Confirm Password</p>
        <input placeholder="Confirm Password" type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
        <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
            
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        <p><i class="fa fa-crosshairs" style="margin-right:10px"></i>Location</p>
        <input placeholder="Enter Location" type="text" name="location" class="form-control" value="<?php echo $location; ?>">
        <span class="help-block"><?php echo $location_err; ?></span>
        </div>
            
            
        <select class="signin_select" name="select">
        <option selected>Register As</option>
        <option value="1">Donor</option>
        <option value="2">Client</option>
        </select>
            
        <div class="form-group">
        <input id="client_signin_subt" type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset">
        </div>
            
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
            
        </form>
        
    </div>
    
    <footer class="signin_footer">
            &copy; 2030 minimal website &nbsp;
            <span class="separator">|</span>
            design by experts <a href="home.html">Blood Bank</a>    
    </footer>
    
</body>
</html>