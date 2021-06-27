<?php

	ob_start();
	session_start();
	include "connect.php";

?>


<!DOCTYPE html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style_home.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
		<title> FitBuddy </title>

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
				      	<li class="nav-item active">
				        <a class="nav-link" href="#">Home</a>
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
				      	<?php if(!isset($_SESSION["user_id"])){?>	
							<li class="nav-item">
				        	<a class="nav-link" href="login.php">Login</a>
				      		</li>
						<?php } ?>
				      	<?php if(isset($_SESSION["user_id"])){?>	
							<li class="nav-item">
				        	<a class="nav-link" href="logout.php">Logout</a>
				      		</li>
						<?php } ?>
				</div>
			</div>
		</nav>

		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  <ol class="carousel-indicators">
			    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			  </ol>
			  <div class="carousel-inner">
			    <div class="carousel-item active">
			      <img src="img/carousel0.jpg" class="d-block w-100">
			      <div class="carousel-caption d-none d-md-block">
			        <h5 class="animated fadeInDown" style="animation-delay: 1s">Welcome To Fit Buddy!</h5>
			        <p class="animated fadeInRight" style="animation-delay: 2s">Whether you want to lose weight, tone up, get healthy, change your habits, or start a new diet, you'll love FitBuddy</p>
			        <p class="animated bounceIn" style="animation-delay: 3s"><a href="login.php">Get Started</a></p>
			      </div>
			    </div>
			    <div class="carousel-item">
			      <img src="img/carousel1.jpg" class="d-block w-100">
			      <div class="carousel-caption d-none d-md-block">
			        <h5 class="animated fadeInLeft" style="animation-delay: 1s">Control your body nutrition</h5>
			        <p class="animated fadeInRight" style="animation-delay: 2s">Track your daily calories based on your personal goal</p>
			        <p class="animated rollIn" style="animation-delay: 3s"><a href="nutrition.php">Get Started</a></p>
			      </div>
			    </div>
			    <div class="carousel-item">
			      <img src="img/carousel3.jpg" class="d-block w-100">
			      <div class="carousel-caption d-none d-md-block">
			        <h5 class="animated flipInX" style="animation-delay: 1s">Privilege access for membership</h5>
			        <p class="animated flipInY" style="animation-delay: 2s">Access our exclusive 7-days workout routine, additional voucher and many more </p>
			        <p class="animated zoomIn" style="animation-delay: 3s"><a href="#">Be A Member Now</a></p>
			      </div>
			    </div>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
		</div>

	</body>

</html>