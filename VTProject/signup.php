<?php
include ("config.php");
session_start();

 if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $passwordFirst = mysqli_real_escape_string($db, $_POST["password"]);
    $passwordConfirm = mysqli_real_escape_string($db, $_POST["passwordConfirm"]);
    
    if($passwordFirst === $passwordConfirm){
        
        $checkDuplicatesql = "SELECT UserName FROM user WHERE UserName = '".$username."'";
        if(mysqli_num_rows(mysqli_query($db,$checkDuplicatesql)) == 1){
            echo 'username exists';
        }
        else{
            $password = md5($passwordFirst); 
            $insertSql = " INSERT INTO user (UserID, UserName, Password) VALUES ('0','".$username."','".$password."') ";
 
            if(mysqli_query($db,$insertSql)) {
               echo 'success';
         }
            else {
                echo 'failed';
            }
        } 
    }
    else{
        echo $password_string . " - " . $passwordConfirm;
        echo 'Passwords are not same!';     
    }
    
        
       
}
?>

<html>
  <head>
    <title>Bootstrap Admin Theme v3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
  </head>
  
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="signup.php">Cargo Management Signup Screen</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>Sign Up</h6>
                                        
                                        <form action = "" method = "post">                                            
                                            <input class="form-control" type = "text" name = "username" class = "box" placeholder ="Username"/>
                                            <input class="form-control" type = "password" name = "password" class = "box" placeholder = "Password">
                                            <input class="form-control" type = "password" name = "passwordConfirm" class = "box" placeholder = "Conirm Password">
    
                                            <div class="action">
                                                <input class="btn btn-primary signup" type = "submit" value = " Submit "/><br />
                                            </div>    
                                        </form>           
			            </div>
			        </div>

			        <div class="already">
			            <p>Have an account already?</p>
			            <a href="login.php">Login</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>