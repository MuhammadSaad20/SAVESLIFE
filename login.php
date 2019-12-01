<?php
// Initialize the session
session_start();
$select="";
$select_err="";
$sql="";
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($select == 1)
    { header("location: donor_dashboard.php");}
    else if($select == 2 )
    { header("location: client_dashboard.php"); }
    
    exit;   
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //check who's loged in
    if(empty(trim($_POST["select"]))){
        $select_err = "Please specified ypur role.";
    } else{
        $select = trim($_POST["select"]);
    }
    
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err) && empty($select_err)){
        // Prepare a select statement
        if($select == 1)
        {$sql = "SELECT id, username, password FROM users WHERE username = ?";}
         if($select == 2)
        {$sql = "SELECT id, username, password FROM cusers WHERE username = ?";}
        $stmt = mysqli_prepare($connect, $sql);
        if($stmt == true ){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;   $_SESSION["email"] = $email;
                            $_SESSION["location"] = $location;
                            $_SESSION["select"]= $select;
                            // Redirect user to welcome page
                            if($select==1)
                            {header("location: donor_dashboard.php");}
                            else if($select==2)
                            {header("location: client_dashboard.php");}
                        } 
                        else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        mysqli_stmt_close($stmt);
        }
        else if($stmt == false){
                echo "Oops! MOTHER FUCKER! Something went wrong. Please try again later.";
                
        }
        
        // Close statement
        
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

<!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>-->
<header>
<div class="login_image">
<img id="img1" src="images/26a16cbe6c24539d6fec034e43716d2e.png">
<img id="img2" src="images/1_KJACFKJ0GKtnhgR7OmlPFA.gif">    
</div>
    
<div class="login_menu">
    <ul class="login_list">
    <li><a href="Home.php"><i class="fa fa-home" style="font-size:24px; margin-right:10px"></i>Home</a>&nbsp;<span>|</span></li> &nbsp;
    <li><a href="aboutus.html"><i class="fa fa-user-secret" style="font-size:24px; margin-right:10px"></i>About US</a></li>           
    </ul>    
</div>
</header>
    
<div class="client_loginbox">
<img src="images/1588b3eef9f1607d259c3f334b85ffd1.png" class="client_login_avatar">
<h1 id="client_log_in_txt">Login</h1>
<form class="client_login_inp" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
    <p><i class="fa fa-user-circle" style="margin-right:10px"></i>Username</p>
    <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $username; ?>">
    <span class="help-block"><?php echo $username_err; ?></span>
    </div>    
    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
    <p><i class="fa fa-lock" style="margin-right:10px"></i>Password</p>
    <input type="password" name="password" placeholder="Enter Password" class="form-control">
    <span class="help-block"><?php echo $password_err; ?></span>
    </div>
    <select class="login_select" name="select">
    <option selected>Login As</option>
    <option value="1">Donor</option>
    <option value="2">Client</option>
    </select>    
    <div class="form-group">
    <input id="client_login_subt" type="submit" class="btn btn-primary" value="Login">
    </div>
    <p>Don't have an account? <a href="nreg.php">Sign up now</a>.</p>
    </form>
    </div>
    
    
<footer class="login_footer">
            &copy; 2030 minimal website &nbsp;
            <span class="separator">|</span>
            design by experts <a href="home.html">Blood Bank</a>    
</footer>
    
</body>
</html>