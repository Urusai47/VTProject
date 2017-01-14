<?php
include ("config.php");
session_start();

 if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $count = 0;
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
    $passwordConfirm = mysqli_real_escape_string($db, $_POST["passwordConfirm"]);
    if(ctype_space($username) || ctype_space($password) || $username == '' || $password == ''){
            $error = 'Username or password is empty';
	} else {
            if($password === $passwordConfirm){
                $sql = "CALL checkDuplicateUser('".$username."')";
                $result = mysqli_query($db, $sql);
		$count = mysqli_num_rows($result);
                mysqli_free_result($result);
                mysqli_next_result($db);
                if( $count == 1 ){
                    $error = 'username exists';
		} else {
                    $insertSql = "CALL insert_user('".$username."','".$password."')";
                    if(mysqli_query($db,$insertSql)) {
                        $error = 'success';
                    }else {
                        $error = mysqli_error($db);
                    }
                } 
            } else {    
            echo $password_string . " - " . $passwordConfirm;
            echo 'Passwords are not same!';     
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Bootstrap Admin Theme</a></h1>
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
                                            <input class="form-control" type = "password" name = "passwordConfirm" class = "box" placeholder = "Confirm Password">
                                            <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                                                <?php echo $error ; ?>
                                            </div>
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