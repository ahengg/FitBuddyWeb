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
		<link rel="stylesheet" type="text/css" href="style_signup.css">
		<!-- FONT -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  		<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  		<!-- ANIMATION -->
  		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  		<!-- FORM HELPER  -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.css" rel="stylesheet"/>

		<title> Sign Up-FitBuddy </title>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#submitbtn").click(function(){
					var email = $("#email").val();
					var name = $("#name").val();
					//DATE
					var Objdate = new Date($('#dob').val());
					var year = Objdate.getFullYear();
					var month = Objdate.getMonth()+1;
					var day = Objdate.getDate();
					var date = day + "/" + month + "/" + year;
					//COUNTRY ETC
					var country = $("#country-select").val();
					var password = $("#password").val();
					var confirmPass = $("#confirmPass").val();
					var gender = $('input[name="inlineRadioOptions"]:checked').val();
					
					if(email == "" || name == "" || Objdate == "" || password == "" || confirmPass == ""){
						alert("Please fill all of the forms");
					}
					else if(password != confirmPass){
						alert("Re-write and confirm your password again");
					}else{
						$.ajax({
							url: 'ajax_signup.php',
							type: 'post',
							dataType: 'text',
							data: {
								email: email,
								name: name,
								date: date, 	
								country: country,
								password: password,
								gender: gender
							},
							success: function(res){
								console.log(res);
								if(res == "<font:'red'>Email already registered</font>"){
									$("#emailHelp").html(res);
								}
								else if(res == 1){
									alert("Sign up success. Please login");
									window.location.replace("login.php");
								}
								else{
									alert("Sign up failed. Something is wrong");
								}
							},
							error : function(){
								alert('Error');
							}
						}); //ajax end
					}
				}); //submitbtn end
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
				      	<li class="nav-item">
				        <a class="nav-link" href="shop.php">Shop</a>
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

					<form class="col-12">
						<!-- Email -->
						<div class="form-group animated fadeIn" style="animation-delay: 3s">
							<input type="email" class="form-control" placeholder="Email" name="email" id="email"> 
							 <small id="emailHelp" class="float-left form-text text-danger"></small>
						</div>
						<!-- Name -->
						<div class="form-group animated fadeIn" style="animation-delay: 3s">
							<input type="name" class="form-control" placeholder="Name" name="name" id="name"> 
						</div>
						<!-- DOB -->
						<div class="form-group animated fadeIn" style="animation-delay: 3s">
							 <input type="date" class="form-control" name="dob" id="dob">
							 <small id="DOBhelp" class="float-left form-text text-muted">Date Of Birth</small>
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
						<!-- Gender -->
						<div class="form-group animated fadeInDown" style="animation-delay: 4s">
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleradio" value="Female" checked="true">
							  <label class="form-check-label" for="femaleradio">Female</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleradio" value="Male">
							  <label class="form-check-label" for="maleradio">Male</label>
							</div>	
						</div>
						<button type="button" class="btn btn-success animated flipInX" style="animation-delay: 5s" name="submitbtn" id="submitbtn"><i class="fas fa-edit"></i>Sign Up</button>
					</form>
				</div> <!-- modal content -->
			</div> <!-- main section -->
		</div> <!-- Modal end -->
	</body>

</html>