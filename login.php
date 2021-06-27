<?php

	ob_start();
	session_start();
	if(isset($_SESSION['user_email'])) header("Location: nutrition.php");
	include "connect.php";

?>
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<!-- JQuery -->
		<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
		<!-- BOOTSTRAP -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="style_login.css">
		<!-- FONT -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  		<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  		<!-- ANIMATION -->
  		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

		<title> Login-FitBuddy </title>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#loginbtn").click(function(){
					var email = $("#email").val();
					var password = $("#password").val();

					if(email == "" || password == ""){
						alert('Please enter email and password');
					}else{
						$.ajax({
							url: 'ajax_login.php',
							type: 'post',
							dataType: 'text',
							data: {
								email: email,
								password: password
							},
							success:function(res){
								if(res == 1){
									console.log("yes");
									window.location.replace("nutrition.php");
								}
								else if (res == 0){
									alert("Email or password wrong");
								}
							}, 
							error: function(a){
								alert("error");
							}
						});
					} //Else end
				}); //loginbtn click
			}); //document ready function
		</script>
	</head>


	<body>
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
			<div class="container">
				<a class="navbar-brand" href="#">Fit Buddy</a>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
				      	<li class="nav-item">
				        <a class="nav-link" href="home.php">Home</a>
				      	</li>
				      	<li class="nav-item">
				        <a class="nav-link" href="nutrition.php">Nutrition</a>
				      	</li>
				      	<li class="nav-item">
				        <a class="nav-link" href="workout.php">Workout</a>
				      	</li>
				      	<li class="nav-item">
				        <a class="nav-link" href="edit.php">Membership</a>
				      	</li>
				      	<li class="nav-item active">
				        <a class="nav-link" href="login.php">Login</a>
				      	</li>
				</div>
			</div>
		</nav>

		<div class="modal-dialog text-center">
			<div class="col-sm-8 main-section">
				<div class="modal-content animated fadeIn" style="animation-delay: 1s">
					<div class="col-12 user-img">
						<img src="img/user_pic.png" class="animated bounceIn" style="animation-delay: 2s">
					</div>

					<!-- FORM -->
					<form class="col-12" method="post" action="login.php">
						<div class="form-group animated fadeIn" style="animation-delay: 3s">
							<input type="email" class="form-control" placeholder="Email" name="email" id="email"> 
						</div>
						<div class="form-group animated fadeIn" style="animation-delay: 3s">
							<input type="password" class="form-control" placeholder="Password" name="password" id="password">
						</div>	
						<button type="submit" class="btn btn-success animated fadeInUp" style="animation-delay: 4s" name="loginbtn" id="loginbtn"><i class="fas fa-sign-in-alt"></i>Login</button>
					</form>
					<div>
							<p style="color:red; text-align: center;" id="alert"></p>
					</div>
					<!-- SIGN UP  -->
					<div class="col-12 sign_up animated flipInX" style="animation-delay: 4s">
						Not registered yet? <a href="signup.php"> Sign Up </a>
					</div>
				</div> <!-- modal content -->
			</div> <!-- main section -->
		</div> <!-- Modal end -->

	</body>

</html>

<?php
mysqli_close($db);
ob_end_flush();
?>