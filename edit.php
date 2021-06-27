<?php

	ob_start();
	session_start();
	if(!isset($_SESSION["user_email"])) header("Location: login.php");
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
		<link rel="stylesheet" type="text/css" href="style_edit.css">
		<!-- FONT -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  		<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  		<!-- ANIMATION -->
  		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  		<!-- FORM HELPER  -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.css" rel="stylesheet"/>

		<title> Membership-FitBuddy </title>
		<script type="text/javascript">
			$(document).ready(function(){
				alert("Be a member now to access our premium daily workout routine!")
				<?php
					 $id = $_SESSION['user_id'];
					 $q = mysqli_query($db, "SELECT * FROM user WHERE id = $id");
					 while($res = mysqli_fetch_assoc($q)){
					   $name = $res['nama'];
					   $email = $res['email'];
					   $country = $res['country'];
					}
				?>

				document.getElementById('email').value = "<?php echo $email; ?>";
				document.getElementById('name').value = "<?php echo $name; ?>";
				document.getElementById('country-select').value = "<?php echo $country; ?>";

				$("#submitbtn").click(function(){
					//Name
					var name = $("#name").val();
					//Email
					var email = $("#email").val();
					//COUNTRY
					var country = $("#country-select").val();
					//Password
					var password = $("#password").val();
					var confirmPass = $("#confirmPass").val();
					
					var cek = 1;
					if(email == "" || name == "" || password == "" || confirmPass == ""){
						alert("Please fill all of the forms");
						cek = 0;
					}
					if(password != confirmPass){
						alert("Re-write and confirm your password again");
						cek = 0;
					}
					if(cek == 1){
						$.ajax({
							url: 'ajax_edit.php',
							type: 'POST',
							dataType: 'text',
							data: {
								name: name,
								email: email,
								country: country,
								password: password
							},
							success: function(res){
								console.log(res);
								alert(res);
							},
							error: function(){
								alert("Error");
							}
						}); //ajax end
					}
				}); //submitbtn end

				$("#submitbtn2").click(function(){
					console.log("test");
					var name = $("#nameCard").val();
					var number = $("#numCard").val();
					var expired = $("#expCard").val();
					var sec = $("#secCard").val();
					var member = '<?php echo $_SESSION['user_member']?>';
					console.log(member);

					if(member == 'Y'){
						console.log("member");
						alert("You're already a member");
					}	
					else if(email == "" || name == "" || password == "" || confirmPass == ""){
						alert("Please fill all of the forms");
					}
					else{
						$.ajax({
							url: 'ajax_member.php',
							type: 'POST',
							dataType: 'text',
							success: function(res){
								alert(res);
							},
							error: function(){
								alert("Error");
							}
						}); //ajax end
					}
				});
			}); //document ready end

			
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
				      	<li class="nav-item active">
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

		<div class="row">

			<div class="col-md-7">
				<div class="modal-dialog2 text-center">
					<div class="col-sm-8 main-section2">
						<div class="modal-content2 animated fadeIn" style="animation-delay: 1s">
							<form class="col-12" method="post" action="edit.php">
								<div class="title" >
									<h4 class="animated fadeIn" style="animation-delay: 2s"> Activate Membership For $20</h4>
								</div><br>
								<!-- Credit Card Name -->
								<div class="form-group2 animated fadeIn" style="animation-delay: 3s">
									<input type="name" class="form-control" placeholder="Name On Credit Card" name="nameCard" id="nameCard"> 
								</div>
								<!-- Credit Card Number -->
								<div class="form-group2 animated fadeIn" style="animation-delay: 3s">
									<input type="number" class="form-control" placeholder="Credit Card Number" name="numCard" id="numCard"> 
								</div>
								<!-- Credit Card Expiry Date -->
								<div class="form-group2 animated fadeIn" style="animation-delay: 3s">
									<input type="date" class="form-control"  name="expCard" id="expCard"> 
									<small id="exphelp" class="float-left form-text text-muted">Expired Date</small>
								</div>
								<!-- Credit Card Security Code -->
								<div class="form-group2 animated fadeIn" style="animation-delay: 3s">
									<input type="number" class="form-control" placeholder="Security Code" name="secCard" id="secCard"> 
								</div>
								
								<!-- Done button -->
								<button type="submit" class="btn2 btn-success animated flipInX" style="animation-delay: 4s" name="submitbtn2" id="submitbtn2"><i class="fas fa-edit"></i>Activate</button>
							</form>
						</div> <!-- modal content -->
					</div> <!-- main section -->
				</div> <!-- Modal end -->
			</div>

			<div class="col-md-5">
				<div class="modal-dialog text-center">
					<div class="col-sm-8 main-section">
						<div class="modal-content animated fadeIn" style="animation-delay: 1s">
							<div class="col-12 user-img">
								<img src="img/user_pic.png" class="animated bounceIn" style="animation-delay: 2s">
							</div>

							<form class="col-12">
								<div class="title" >
									<h3 class="animated fadeIn" style="animation-delay: 2s"> Edit Profile </h3>
								</div>
								<!-- Email -->
								<div class="form-group animated fadeIn" style="animation-delay: 3s">
									<input type="email" class="form-control" placeholder="Email" name="email" id="email"> 
									 <small id="emailHelp" class="float-left form-text text-danger"></small>
								</div>
								<!-- Name -->
								<div class="form-group animated fadeIn" style="animation-delay: 3s">
									<input type="name" class="form-control" placeholder="Name" name="name" id="name"> 
								</div>
								<!-- Country -->
								<div class="form-group animated fadeIn" style="animation-delay: 3s">
									 <select  id="country-select" name="country-select" class="form-control bfh-countries" data-country="ID" data-flags="true"></select>
									 <small id="countryhelp" class="float-left form-text text-muted">Select Country</small>
								</div>
								<!-- Password -->
								<div class="form-group animated fadeIn" style="animation-delay: 3s">
									<input type="password" class="form-control" placeholder="Password" name="password" id="password">
								</div>
								<!-- Confirm Password -->
								<div class="form-group animated fadeIn" style="animation-delay: 3s">
									<input type="password" class="form-control" placeholder="Confirm Password" name="confirmPass" id="confirmPass">
								</div>
								<!-- Done button -->
								<button type="submit" class="btn btn-success animated flipInX" style="animation-delay: 4s" name="submitbtn" id="submitbtn"><i class="fas fa-edit"></i>Done</button>
							</form>
						</div> <!-- modal content -->
					</div> <!-- main section -->
				</div> <!-- Modal end -->
			</div>	

		</div>
		
	</body>

</html>