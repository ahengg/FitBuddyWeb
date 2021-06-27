<?php

	ob_start();
	session_start();
	if(!isset($_SESSION["user_email"])){
		header("Location: login.php");
	} 
	if($_SESSION["user_member"] == "N"){
		header("Location: edit.php");
	}
	include "connect.php";

?>

<!DOCTYPE html
	<head>
		<!-- JQuery -->
		<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
		<!-- BOOTSTRAP -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<!-- ANIMATION -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="style_workout.css">
		<title> FitBuddy-Workout </title>

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
				      	<li class="nav-item active">
				        <a class="nav-link" href="workout.php">Workout</a>
				      	</li>
				      	<li class="nav-item">
				        <a class="nav-link" href="edit.php">Membership</a>
				      	</li>
				      	<?php if(!isset($_SESSION["user_email"])){?>	
							<li class="nav-item">
				        	<a class="nav-link" href="login.php">Login</a>
				      		</li>
						<?php } ?>
				      	<?php if(isset($_SESSION["user_email"])){?>	
							<li class="nav-item">
				        	<a class="nav-link" href="logout.php">Logout</a>
				      		</li>
						<?php } ?>
				</div>
			</div>
		</nav>
		
		<br><br>

		<div class="container1">
			<h1 id="judul"> Fit Buddy 7 Days Workout Routine </h1>
			<h4 id="judul"> in collaboration with "The Body Coach TV" </h4>
			<ul class="a">
				<a href="https://www.youtube.com/watch?v=06cBKk6Xkg0&list=PLyCLoPd4VxBsY7HCrUBS7eZRrMPmsTjDa"> <li style="background-image: url('img/day1edit.jpg')"> <div class="title">Day 1</div> </li> </a>
				<a href="https://www.youtube.com/watch?v=dA8YrNg_Zl4&list=PLyCLoPd4VxBsY7HCrUBS7eZRrMPmsTjDa&index=2"> <li style="background-image: url('img/day2edit.jpg')"> <div class="title">Day 2</div> </li> </a>
				<a href="https://www.youtube.com/watch?v=7rRH8C4i2lA&list=PLyCLoPd4VxBsY7HCrUBS7eZRrMPmsTjDa&index=3"> <li style="background-image: url('img/day3edit.jpg')"> <div class="title">Day 3</div> </li> </a>
				<a href="https://www.youtube.com/watch?v=eXnf0WaIhp8&list=PLyCLoPd4VxBsY7HCrUBS7eZRrMPmsTjDa&index=4"> <li style="background-image: url('img/day4edit.jpg')"> <div class="title">Day 4</div> </li> </a>
				<a href="https://www.youtube.com/watch?v=pbN5VwIwG0g&list=PLyCLoPd4VxBsY7HCrUBS7eZRrMPmsTjDa&index=5"> <li style="background-image: url('img/day5edit.jpg')"> <div class="title">Day 5</div> </li> </a>
				<a href="https://www.youtube.com/watch?v=Y1BJUkoPxPw&list=PLyCLoPd4VxBsY7HCrUBS7eZRrMPmsTjDa&index=6"> <li style="background-image: url('img/day6edit.jpg')"> <div class="title">Day 6</div> </li> </a>
				<a href="https://www.youtube.com/watch?v=Kdd5mGbQP58&list=PLyCLoPd4VxBsY7HCrUBS7eZRrMPmsTjDa&index=7"> <li style="background-image: url('img/day7edit.jpg')"> <div class="title">Day 7</div> </li> </a>
			</ul>
		</div>

		
	</body>

</html>