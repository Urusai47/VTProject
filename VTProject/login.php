<?php
include ("config.php");
session_start();
 if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]); 
    if(ctype_space($username) || ctype_space($password) || $username == '' || $password == ''){
		$error = 'Username or Password is empty';

	} else {
		$sql = "CALL login('".$username."', '".$password."')";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count == 1) {
        //session_register("myusername");
        //$_SESSION['login_user'] = $myusername;
        $error =  'basarili giris.';
        //header("location: welcome.php");
		}
		else {
			$error = 'Your Login Name or Password is invalid';
		}
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
	                 <h1><a href="login.php">Cargo Management Login Screen</a></h1>
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
			                <h6>Sign In</h6>
			                
                                        <form action = "" method = "post">                                            
                                            <input class="form-control" type = "text" name = "username" class = "box" placeholder ="Username"/>
                                            <input class="form-control" type = "password" name = "password" class = "box" placeholder = "Password">
                                            <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                                                <?php echo $error ; ?>
                                            </div>
                                            <div class="action">
                                                <input class="btn btn-primary signup" type = "submit" value = " Submit "/><br />
                                            </div>    
                                        </form>
                                        
			            </div>
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
