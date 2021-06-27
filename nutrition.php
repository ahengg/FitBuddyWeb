<?php

	ob_start();
	session_start();
	if(!isset($_SESSION["user_email"])) header("Location: login.php");
	include "connect.php";

?>


<!DOCTYPE html>
	<head>
		<!-- JQuery -->
		<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
		<!-- BOOTSTRAP -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="style_nutrition.css">
		<!-- ANIMATION -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
		<!-- MOMENT.JS -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
		<!-- FONT AWESOME -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- JQuery UI -->
		<script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
		<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
		<!-- FORM HELPER  -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.css" rel="stylesheet"/>
		<title> Nutrition-FitBuddy </title>

		<script type="text/javascript">
			//==================================== DISPLAY FUNCTION ===================================================
				//DISPLAY FOOD TABLE FUNCTION
				function display_food(){
					var val = new Date($("#datepicker").val());
					var tanggal = moment(val).format('YYYY-MM-DD');
					var data_ = {'tanggal' : tanggal};
					$.ajax({
						url: "ajax_displayFoodMongoDB.php",
			            type: "POST",
			            dataType: "json",
			            data: data_,
			            success:function(res){
			            	console.log(res);
			                var data = res;
			                var dataDiv = $(".my-food tbody");
			                var str = "";
			                for(var i=0;i<data.length;i++){
			                    var x = data[i];
								var y= data[i][0];
			                    str+= "<tr>";
			                    str+= "<td>"+y.nama+"</td>";
			                    str+= "<td>"+x.jumlah_porsi+"</td>";
			                    str+= "<td>"+x.total_kal+"</td>";
			                    str+= "<td>"+x.total_karb+"</td>";
			                    str+= "<td>"+x.total_lemak+"</td>";
			                    str+= "<td>"+x.total_prot+"</td>";
			                    str+= "<td><button type='button' class='btn btn-danger' onclick='deleteini("+x.id_detail_makanan+")' style='padding-left:4px;'><span class='fa fa-trash'></span></button>"
			                    str+="</tr>"
			                }
							console.log(str);
			                dataDiv.html(str);
			            },
			            error: function(e){
			                alert("Error");
			            }
					});
					count();
				}
				//DISPLAY EXERCISE TABLE FUNCTION
				function display_exc(){
					var val = new Date($("#datepicker").val());
					var tanggal = moment(val).format('YYYY-MM-DD');
					var data_ = {'tanggal' : tanggal};
					$.ajax({
						url: "ajax_displayExcMongoDB.php",
			            type: "POST",
			            dataType: "json",
			            data: data_,
			            success:function(res){

							//alert(res);
			            	console.log();
			                var data = res;
			                var dataDiv = $(".my-exc tbody");
			                var str = "";
			                for(var i=0;i<data.length;i++){
			                    var x = data[i];
			                    var y= data[i][0];
			                    str+= "<tr>";
			                    str+= "<td>"+y.nama_exercise+"</td>";
			                    str+= "<td>"+x.time+"</td>";
			                    str+= "<td>"+x.cal_burned+"</td>";
			                    str+= "<td><button type='button' class='btn btn-danger' onclick='deleteExc("+x.id_detail_exercise+")' style='padding-left:4px;'><span class='fa fa-trash'></span></button>"
			                    str+="</tr>"
			                }
			                console.log(str);
			                dataDiv.html(str);
			            },
			            error: function(e){
			                alert("Error exc");
			            }
					});
					count();
				}

				//================================ DELETE DATA FUNCTION ==============================
				function deleteini(id){
			        $.ajax({
			            url: "ajax_deleteFoodMongoDB.php",
			            type: "post",
			            data:{
			                id:id
			            },
			            success: function(res){
			                display_food();
			            },
			            error : function(){
							alert('Error');
						}
			        });
			    }

			    function deleteExc(id){
			        $.ajax({
			            url: "ajax_deleteExerciseMongoDB.php",
			            type: "post",
			            data:{
			                id:id
			            },
			            success: function(res){
			                display_exc();
			            },
			            error : function(){
							alert('Error');
						}
			        });
			    }

			    //================================ COUNT FUNCTION =====================================
				//COUNT EVERYTHING FUNCTION
				function count(){
					var val = new Date($("#datepicker").val());
					var tanggal = moment(val).format('YYYY-MM-DD');
					var data_ = {'tanggal' : tanggal};
					$.ajax({
						url: "ajax_count.php",
			            type: "POST",
			            dataType: "json",
			            data: data_,
			            success:function(res){
			            	console.log(res);
			            	$('#foodDaily').html(res.kalori);
			            	$('#kalDaily').html(res.kalori);
			            	$('#carbDaily').html(res.karbohidrat);
			            	$('#fatDaily').html(res.lemak);
			            	$('#protDaily').html(res.protein);
			            	$('#remainingDaily').html(res.remaining);
			            	$('#excDaily').html(res.cal_burned);
			            	$('#cal_burnOval').html(res.cal_burned);
			            	$('.prediction').html("Weight prediction : "+res.prediction+" kg");
			            }, 
			            error: function(e){
			                alert("Please fill your profile first");
			            }
					});
				}


			////<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
			$(document).ready(function(){

				// ==================================== DISPLAY TODAY DATE ====================================
				var day = moment().format('dddd');
				var NowDate = moment().format('MMMM Do YYYY');
				document.getElementById("dateNowFood").innerHTML = day + ", " + NowDate;
				$('#datepicker').datepicker().datepicker('setDate', 'today');

				//==================================== DATE PICKER ===========================================
				$('#datepicker').datepicker();
				$('#icon-cal').click(function() {
				    $('#datepicker').datepicker('show');
				    $('#datepicker').change(function(){
				    	var value = new Date($("#datepicker").val());
						var day = moment(value).format('dddd');
						var NowDate = moment(value).format('MMMM Do YYYY');
						document.getElementById("dateNowFood").innerHTML = day + ", " + NowDate;
						display_food();
						display_exc();
				    });
				});
				
				//====================================DROPDOWN SELECT FROM DATABASE=========================
				//FOOD SELECT FROM DATABASE
				$.ajax({
					url: 'ajax_foodDropdown.php',
					type: 'post',
					dataType: 'json',
					success: function(res){
						var data = res;
	                	var dataDiv = $("#foodSelect");
	                	var str = "";
	                	for(var i=0;i<data.length;i++){
		                    var x = data[i];
		                    if(i == 0){
		                    	str+=  "<option value='"+x.id+"' selected>"+x.nama+" (cal: "+x.kalori+"g)</option>";
		                    }else{
		                    	str+=  "<option value='"+x.id+"'>"+x.nama+" (cal: "+x.kalori+"g)</option>";
		                    }
	                	}
	                	dataDiv.html(str);
					},
					error : function(){
							alert('Error');
					}
				});

				//EXERCISE SELECT FROM DATABASE
				$.ajax({
					url: 'ajax_excDropdown.php',
					type: 'post',
					dataType: 'json',
					success: function(res){
						var data = res;
	                	var dataDiv = $("#excSelect");
	                	var str = "";
	                	for(var i=0;i<data.length;i++){
		                    var x = data[i];
		                    if(i == 0){
		                    	str+=  "<option value='"+x.id+"' selected>"+x.nama_exercise+" (cal burned: "+x.cal_burned+"g)</option>";
		                    }else{
		                    	str+=  "<option value='"+x.id+"'>"+x.nama_exercise+" (cal burned: "+x.cal_burned+"g)</option>";
		                    }
	                	}
	                	dataDiv.html(str);
					},
					error : function(){
							alert('Error');
					}
				});


				//================================================= DISPLAY FOOD AND EXC =====================================
				display_food();
				
				display_exc();

				//===================================== ADD DATA TO DATABASE =========================
				//ADD FOOD
				$('.btn-food').click(function(){
					var amount = $('#foodAmount').val();
					var food = $('#foodSelect').val();
					var val = new Date($("#datepicker").val());
					var tanggal = moment(val).format('YYYY-MM-DD');

					if(amount == ""){
						alert("Please enter food amount");
					}
					
					$.ajax({
						url: "ajax_addFoodMongoDB.php",
		                type: "post",
		                data:{
		                    amount: amount, 
		                    food: food,
		                    tanggal: tanggal
		                },
		                success: function(res){
		                    display_food();
		                },
		                error : function(){
							alert('Error');
						}
		            });
				});
				//ADD EXERCISE
				$('.btn-exercise').click(function(){
					var amount = $('#exerciseAmount').val();
					var exercise = $('#excSelect').val();
					var val = new Date($("#datepicker").val());
					var tanggal = moment(val).format('YYYY-MM-DD');
					
					if(amount == ""){
						alert("Please enter exercise duration");
					}

					$.ajax({
						url: "ajax_addExerciseMongoDB.php",
		                type: "post",
		                data:{
		                    amount: amount, 
		                    exercise: exercise,
		                    tanggal: tanggal
		                },
		                success: function(res){
		                    display_exc();
		                },
		                error : function(){
							alert('Error');
						}
		            });
				});
				
				//============================================== EDIT USER PROFILE =========================================
				//PROFILE BUTTON CLICKED
				$('.profile-btn').click(function(){
					//DATE CONVERSION
					var mysqlDate = "<?php echo $_SESSION['user_dob'];?>";

					document.getElementById('dob').value = mysqlDate;
					$("#activitySelect option[value='<?php echo $_SESSION["user_activity"]; ?>']").prop('selected', 'selected');
					$("#goalSelect option[value='<?php echo $_SESSION["user_goalWeight"]; ?>']").prop('selected', 'selected');
					$("#genderSelect option[value='<?php echo $_SESSION["user_gender"]; ?>']").prop('selected', 'selected');
					document.getElementById('weight').value = <?php echo $_SESSION["user_berat"]; ?>;
					document.getElementById('height').value = <?php echo $_SESSION["user_tinggi"]; ?>;
				});

				//MODAL CLICKED
				$('.btn-modal').click(function(){
					var goalweight = $('#goalSelect').val();
					var activity = $('#activitySelect').val();
					var gender = $('#genderSelect').val();
					var weight = $('#weight').val();
					var height = $('#height').val();
					//DOB
					var Objdate = new Date($('#dob').val());
					var year = Objdate.getFullYear();
					var month = Objdate.getMonth()+1;
					var day = Objdate.getDate();
					var dob = day + "/" + month + "/" + year;
					
					// INPUT TO DATABASE AND CHANGE SESSION VALUE
					$.ajax({
							url: 'ajax_modal.php',
							type: 'post',
							dataType: 'text',
							data: {
								goalweight: goalweight,
								activity: activity,
								gender: gender,
								weight: weight, 	
								height: height,
								dob: dob
							},
							success: function(res){
								$("#genderP").html('Gender : <?php echo $_SESSION["user_gender"];?>');
								$("#ageP").html('Age :  <?php echo $_SESSION["user_umur"];?>');
								$('#beratP').html('Weight :  <?php echo $_SESSION["user_berat"];?> kg');
								$('#tinggiP').html('Height : <?php echo $_SESSION["user_tinggi"];?> cm');
								$('#actP').html('Activity : <?php echo $_SESSION["user_activity"];?>');
								$('#goalP').html('Weight Goal : <?php echo $_SESSION["user_goalWeight"];?>');
								$('#goalDaily').html('<?php echo $_SESSION["user_goal"];?>');
							},
							error : function(){
								alert('Error');
							}
					}); //ajax end
					$('#userModal').modal('hide');
					
				});
				
				$('#userModal').on('hidden.bs.modal', function () {
					location.reload();
				})
			});
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
				      	<li class="nav-item active">
				        <a class="nav-link" href="nutrition.php">Nutrition</a>
				      	</li>
				      	<li class="nav-item">
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

		<div class="container-fluid my-container">
			<div class="row my-row">
				<div class="col-md-4 my-col">
					<!-- DAILY SUMMARY -->
						<h1><b> DAILY SUMMARY </b></h1>
						<h3 style="display: inline-block;"> <?php echo $_SESSION["user_nama"]?> </h3>
						<button class="btn profile-btn" data-toggle="modal" data-target="#userModal"><i class="fa fa-id-card"></i></button>
						<div class="row">
							<div class="col-6">
								<p id="genderP"> Gender : <?php echo $_SESSION["user_gender"]?> </p>
							</div>
							<div class="col-6"> 
								<p id="ageP"> Age : <?php echo $_SESSION["user_umur"]?> </p>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<p id="beratP"> Weight : <?php echo $_SESSION["user_berat"]?> kg</p>
							</div>
							<div class="col-6">
								<p id="tinggiP"> Height : <?php echo $_SESSION["user_tinggi"]?> cm</p>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<p id="goalP"> Weight Goal : <?php echo $_SESSION["user_goalWeight"]; ?></p>
							</div>
							<div class="col-6">
								<p id="actP"> Activity : <?php echo $_SESSION["user_activity"]; ?></p>
							</div>
						</div><br>
						
						
						<!-- USER GOAL AND INFO -->
						<table class="table table-borderless text-center">
							<tbody>
								<tr>
									<td>Goal</td>
									<td></td>
									<td>Food</td>
									<td></td>
									<td>Exercise</td>
									<td></td>
									<td>Remaining</td>
								</tr>
									<td id="goalDaily"><?php echo $_SESSION["user_goal"];?></td>
									<td>-</td>
									<td id="foodDaily">0</td>
									<td>+</td>
									<td id="excDaily">0</td>
									<td>=</td>
									<td id="remainingDaily">0</td>
								</tr>
							</tbody>
						</table>
						<h5 class="prediction">Weight prediction : <?php echo $_SESSION["prediction"]?> kg</h5>

				</div>


				<!-- FOOD LIST -->
				<div class="col-md-7 my-col-tab">
					<h1><b>FOOD LIST</b></h1>
					<h3 id="dateNowFood" style="display: inline-block;"></h3> 
					<a href="#" id="icon-cal"><i class="fa fa-calendar" style="font-size: 30px; display: inline-block;"></i></a>
					<input type= "hidden" id="datepicker"><br>
					<form>
						<small id="foodSelHelp" class="float-left form-text text-muted">What are you eating today?</small><br>
				        <select class="form-control" id="foodSelect">
				        </select>
				        <input type="number" name="foodAmount" id="foodAmount" placeholder="Food Portion Amount">
				        <button class="btn btn-food">Add Food</button>
					</form><br>

					<div class="row cal-box text-center justify-content-around">
						<div class="col-lg-2 col-yey">
							<h6> Calories (g)</h6>
							<p id="kalDaily">0</p>
						</div>
						<div class="col-lg-2 col-yey">
							<h6> Carbs (g)</h6>
							<p id="carbDaily">0</p>
						</div>
						<div class="col-lg-2 col-yey">
							<h6> Fat (g)</h6>
							<p id="fatDaily">0</p>
						</div>
						<div class="col-lg-2 col-yey">
							<h6> Protein (g)</h6>
							<p id="protDaily">0</p>
						</div>
					</div><br>

					<table class="table table-sm text-center my-food" style="background: #524738;">
						<thead>
						    <tr>
						      <th scope="col">Food</th>
						      <th scope="col">Amount</th>
						      <th scope="col">Calories</th>
						      <th scope="col">Carbs</th>
						      <th scope="col">Fat</th>
						       <th scope="col">Protein</th>
						    </tr>
						 </thead>
						 <tbody>
						 	
						 </tbody>
					</table>
				</div>
			</div> 

			<!-- EXERCISE LIST -->
			<div class="row my-row2">
				<div class="col-md-4 my-col-ex">
				</div>
				<div class="col-md-7 my-col-tab2">
					<h1><b>EXERCISE LIST</b></h1>
					<form>
						<small id="actSelHelp" class="float-left form-text text-muted">Do an exercise to burn those calories</small><br>
				        <select class="form-control" id="excSelect">
					        
				        </select>
				        <input type="number" name="exerciseAmount" id="exerciseAmount" placeholder="Exercise time (minute)">
				        <button class="btn btn-exercise">Add Exercise</button>
					</form><br>

					<div class="row cal-box text-center justify-content-around">
						<div class="col-lg-2 col-yey">
							<h6> Calories Burned</h6>
							<p id="cal_burnOval"> 0 </p>
						</div>
						<div class="col-lg-2">
						</div>
						<div class="col-lg-2">
						</div>
						<div class="col-lg-2">
						</div>
					</div><br>
					<table class="table table-sm text-center my-exc" style="background: #524738;">
						<thead>
						    <tr>
						      <th scope="col">Exercise</th>
						      <th scope="col">Time (minute)</th>
						      <th scope="col">Calories Burned</th>
						    </tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>

			<!-- MODAL -->
			<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
						    <h5 class="modal-title" id="userModalHTitle">Set Goal and Profile</h5>
						    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						        <span aria-hidden="true">&times;</span>
						    </button>
						</div> <!--modal header-->
						<div class="modal-body">
							<form>
								<small id="genderHelp" class="float-left form-text text-muted">Gender</small><br>
								<select class="form-control" id="genderSelect">						        	
							        <option value="Female" selected>Female</option>
							        <option value="Male">Male</option>
						        </select><br>
						        <small id="DOBhelp" class="float-left form-text text-muted">Date Of Birth</small><br>
						        <input type="date" class="form-control" name="dob" id="dob"><br>
								<small id="goalHelp" class="float-left form-text text-muted">What's your goal?</small><br>
								<select class="form-control" id="goalSelect">						        	
							        <option value="Lose weight" selected>Lose weight</option>
							        <option value="Maintain weight">Maintain weight</option>
							        <option value="Gain weight">Gain weight</option>
						        </select><br>
						        <small id="actHelp" class="float-left form-text text-muted">How active are you?</small><br>
						        <select class="form-control" id="activitySelect">
							        <option value="Not very active" selected>Not very active : spend most of the day sitting (e.g. bankteller, desk job)</option>
							        <option value="Lightly active">Lightly active : spend a good part of the day on your feet (e.g. teacher, salesperson)</option>
							        <option value="Active">Active : spend a good part of the day doing some physical activity (e.g. food server, postal carrier)</option>
							        <option value="Very active">Very active : spend most of the day doing heavy physical activity (e.g. bike messenger, carpenter)</option>
						        </select><br><br>
						        <input type="number" name="height" id="height" placeholder="Height"> cm <br><br>
						        <input type="number" name="weight" id="weight" placeholder="Weight"> kg
							</form>
						</div>
						<div class="modal-footer">
						    <button type="submit" class="btn btn-modal" style="background-color: #524738; color: #ede2d3;">Done</button>
						</div>
					</div>
				</div>
			</div>
		</div> <!--container end--> 
	</body>

</html>

<?php
	mysqli_close($db);
	ob_end_flush();
?>