<?php
require('php/DB.php'); 
$message = '';
if(isset($_POST['login']) != '' && isset($_POST['password']) != ''){
	$sql = "select * from users where email='".$_POST['login']."' and password='".$_POST['password']."'";
	$result = mysqli_query($conn,$sql);
	$res_count = mysqli_num_rows($result);
	$res = mysqli_fetch_array($result);
	if($res_count != '0'){
		session_start();
		$_SESSION['user_id'] = $res['user_id'];
		$_SESSION['email'] = $res['email'];
		$_SESSION['name'] = $res['name'];
		$_SESSION['user_type'] = $res['user_type'];
		header("Location:index.php");
		exit;
	}else{
		$message = 'failed';
	}
}

if(isset($_GET['value']) == 'logout'){
	session_start() ;
	session_destroy() ;
	$message = 'logout success';
}

?>

<!doctype html>
<html lang="en">
	<head>
		<?php include 'header.php';?>

		<title>Login to Helping Hands</title>
	</head>
	<style>
	.footer {
	 position: absolute;
	
	}
		/* BASIC */

		html {
		  background-color: #56baed;
		}

		body {
		  font-family: "Poppins", sans-serif;
		  height: 100vh;
		}

		a {
		  color: #92badd;
		  display:inline-block;
		  text-decoration: none;
		  font-weight: 400;
		}

		h2 {
		  text-align: center;
		  font-size: 16px;
		  font-weight: 600;
		  text-transform: uppercase;
		  display:inline-block;
		  margin: 40px 8px 10px 8px; 
		  color: #cccccc;
		}



		/* STRUCTURE */

		.wrapper {
		  display: flex;
		  align-items: center;
		  flex-direction: column; 
		  justify-content: center;
		  width: 100%;
		  min-height: 100%;
		  padding: 20px;
		}

		#formContent {
		  -webkit-border-radius: 10px 10px 10px 10px;
		  border-radius: 10px 10px 10px 10px;
		  background: #fff;
		  padding: 30px;
		  width: 90%;
		  max-width: 450px;
		  position: relative;
		  padding: 0px;
		  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
		  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
		  text-align: center;
		}

		#formFooter {
		  background-color: #f6f6f6;
		  border-top: 1px solid #dce8f1;
		  padding: 25px;
		  text-align: center;
		  -webkit-border-radius: 0 0 10px 10px;
		  border-radius: 0 0 10px 10px;
		}



		/* TABS */

		h2.inactive {
		  color: #cccccc;
		}

		h2.active {
		  color: #0d0d0d;
		  border-bottom: 2px solid #5fbae9;
		}



		/* FORM TYPOGRAPHY*/

		input[type=button], input[type=submit], input[type=reset]  {
		  background-color: #56baed;
		  border: none;
		  color: white;
		  padding: 15px 80px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  text-transform: uppercase;
		  font-size: 13px;
		  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
		  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
		  -webkit-border-radius: 5px 5px 5px 5px;
		  border-radius: 5px 5px 5px 5px;
		  margin: 5px 20px 40px 20px;
		  -webkit-transition: all 0.3s ease-in-out;
		  -moz-transition: all 0.3s ease-in-out;
		  -ms-transition: all 0.3s ease-in-out;
		  -o-transition: all 0.3s ease-in-out;
		  transition: all 0.3s ease-in-out;
		}

		input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
		  background-color: #39ace7;
		}

		input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
		  -moz-transform: scale(0.95);
		  -webkit-transform: scale(0.95);
		  -o-transform: scale(0.95);
		  -ms-transform: scale(0.95);
		  transform: scale(0.95);
		}

		input[type=text],input[type=password] {
		  background-color: #f6f6f6;
		  border: none;
		  color: #0d0d0d;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 5px;
		  width: 85%;
		  border: 2px solid #f6f6f6;
		  -webkit-transition: all 0.5s ease-in-out;
		  -moz-transition: all 0.5s ease-in-out;
		  -ms-transition: all 0.5s ease-in-out;
		  -o-transition: all 0.5s ease-in-out;
		  transition: all 0.5s ease-in-out;
		  -webkit-border-radius: 5px 5px 5px 5px;
		  border-radius: 5px 5px 5px 5px;
		}

		input[type=text]:focus,input[type=password]:focus {
		  background-color: #fff;
		  border-bottom: 2px solid #5fbae9;
		}

		input[type=text]:placeholder,input[type=password]:placeholder {
		  color: #cccccc;
		}



		/* ANIMATIONS */

		/* Simple CSS3 Fade-in-down Animation */
		.fadeInDown {
		  -webkit-animation-name: fadeInDown;
		  animation-name: fadeInDown;
		  -webkit-animation-duration: 1s;
		  animation-duration: 1s;
		  -webkit-animation-fill-mode: both;
		  animation-fill-mode: both;
		}

		@-webkit-keyframes fadeInDown {
		  0% {
			opacity: 0;
			-webkit-transform: translate3d(0, -100%, 0);
			transform: translate3d(0, -100%, 0);
		  }
		  100% {
			opacity: 1;
			-webkit-transform: none;
			transform: none;
		  }
		}

		@keyframes fadeInDown {
		  0% {
			opacity: 0;
			-webkit-transform: translate3d(0, -100%, 0);
			transform: translate3d(0, -100%, 0);
		  }
		  100% {
			opacity: 1;
			-webkit-transform: none;
			transform: none;
		  }
		}

		/* Simple CSS3 Fade-in Animation */
		@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
		@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
		@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

		.fadeIn {
		  opacity:0;
		  -webkit-animation:fadeIn ease-in 1;
		  -moz-animation:fadeIn ease-in 1;
		  animation:fadeIn ease-in 1;

		  -webkit-animation-fill-mode:forwards;
		  -moz-animation-fill-mode:forwards;
		  animation-fill-mode:forwards;

		  -webkit-animation-duration:1s;
		  -moz-animation-duration:1s;
		  animation-duration:1s;
		}

		.fadeIn.first {
		  -webkit-animation-delay: 0.4s;
		  -moz-animation-delay: 0.4s;
		  animation-delay: 0.4s;
		}

		.fadeIn.second {
		  -webkit-animation-delay: 0.6s;
		  -moz-animation-delay: 0.6s;
		  animation-delay: 0.6s;
		}

		.fadeIn.third {
		  -webkit-animation-delay: 0.8s;
		  -moz-animation-delay: 0.8s;
		  animation-delay: 0.8s;
		}

		.fadeIn.fourth {
		  -webkit-animation-delay: 1s;
		  -moz-animation-delay: 1s;
		  animation-delay: 1s;
		}

		/* Simple CSS3 Fade-in Animation */
		.underlineHover:after {
		  display: block;
		  left: 0;
		  bottom: -10px;
		  width: 0;
		  height: 2px;
		  background-color: #56baed;
		  content: "";
		  transition: width 0.2s;
		}

		.underlineHover:hover {
		  color: #0d0d0d;
		}

		.underlineHover:hover:after{
		  width: 100%;
		}



		/* OTHERS */

		*:focus {
			outline: none;
		} 

		#icon {
		  width:35%;
		}
		
		#loginform p{
			font-size : 13px;
			color:red;
			text-align: left;
			margin: 0 0 0 35px;
		}

	</style>
	<body>

	<div class="container">
		  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
				<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
				<script src="js/jquery.js"></script>
				<!------ Include the above in your HEAD tag ---------->

				<div class="wrapper fadeInDown">
				  <div id="formContent">
					<!-- Tabs Titles -->

					<!-- Icon -->
					<div class="fadeIn first">
					  <img src="img/logo.png" id="icon" alt="User Icon" /> <h1>Helping Hands</h1>
					</div>
					<?php 
						if($message == 'failed'){
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 10px;">
							  <strong>Login Failed!</strong> Invalid Email id or Password.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>';
						}else if($message == 'logout success'){
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 10px;">
							  <strong>Success!</strong> You have successfully logged out!.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>';
						}
						 
					?>
					<!-- Login Form -->
					<form name="loginform" id="loginform" action="" method="post" enctype="multipart/form-data" novalidate>
					  <input type="text" id="login" class="fadeIn second" name="login" placeholder="Enter your Email id">
					  <p class="login"></p>
					  <input type="password" id="password" class="fadeIn third" name="password" placeholder="Enter your password">
					  <p class="password"></p>
					  <input type="submit" class="fadeIn fourth" value="Log In">
					</form>

					<!-- Remind Passowrd -->
					<div id="formFooter">
					  <a class="underlineHover" href="signup.php">Click here to signup!</a>
					</div>

				  </div>
				</div>
	</div>

		<?php include 'footer.php';?>
<script>
$('#loginform').on('submit', function(e){
	var login = $('#login').val();
	var phone = $('#password').val();
		
	if(login == ''){
		$('.login').html('This field is required');
		return false;
	}else{
		$('.login').html('');	
	}
	if(password == ''){
		$('.password').html('This field is required');
		return false;
	}else{
		$('.password').html('');	
	}		
});
</script>
	</body>
</html>