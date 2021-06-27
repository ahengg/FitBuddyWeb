<?php
	ob_start();
	session_start();
	if(!isset($_SESSION["user_email"])) header("Location: login.php");
	include "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
	<!-- JQuery -->
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<!-- CSS -->
	<link href="checkout.css" rel="stylesheet" type="text/css">
	<!-- ANIMATION -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- JQUERY UI -->
	<script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
	<!-- MOMENT.JS -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
</head>
<script type="text/javascript">
	var totalAkhir;
	var length;
	var namaArr= JSON.parse(localStorage.getItem("namaArr"));
	var hargaArr=  JSON.parse(localStorage.getItem("hargaArr"));
	var qtyArr=  JSON.parse(localStorage.getItem("qtyArr"));
	$(document).ready(function() {  
		$('#txtDate').datepicker().datepicker('setDate', 'today');
		
		length=namaArr.length;
		document.getElementById("notif").innerHTML=namaArr.length;
		var total=0;
		for(a=0;a<namaArr.length;a++){
			$("#liChart").append("<li class='list-group-item d-flex justify-content-between lh-condensed'><div><h6 class='my-0'>"+namaArr[a]+"</h6><small class='text-muted'>Qty :<p class='myqty'>"+qtyArr[a]+"</p></small></div><span class='text-muted'> Rp"+hargaArr[a]/1000+".000"+"</span></li>");
			total+=parseInt(hargaArr[a]);
		}
		$("#liChart").append("<li class='list-group-item d-flex justify-content-between'><span>Total </span><strong><p id='totalTrans'>Rp"+total/1000+".000</p></strong></li>");
		totalAkhir=total;
		
	});

	function add(){
		var idt;
		var alamat = document.getElementById("address").value;
		var member = document.getElementById("custId").value;
		// var d = new Date();
		// var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
		var val = new Date($("#txtDate").val());
		var tanggal = moment(val).format('YYYY-MM-DD');
		console.log(totalAkhir+alamat+member+tanggal);

		if(alamat == "" || member == "" || val == "" || tanggal == ""){
			alert("Please fill all the forms");
		}
		else{
			$.ajax({
				url : 'ajax_checkout_transaksi.php',
				type:'post',
				dataType : 'text',
				data:{
					alamat:alamat,
					member:member,
					totalAkhir:totalAkhir,
					tanggal:tanggal

				},
				success : function(data){
					
					var idt=parseInt(data);
					//alert("idt :" +idt);
					for(a=0;a<length;a++){
						var id=document.getElementById("user_Id").value;
						var nama1 = namaArr[a];
						var harga1 = hargaArr[a];
						var qty1 = qtyArr[a];
						console.log(id+" "+idt+" "+nama1+" "+qty1+" "+harga1);
						$.ajax({
							url : 'ajax_checkout.php',
							type:'post',
							dataType : 'text',
							data:{
								nama1:nama1,
								harga1:harga1,
								qty1:qty1,
								id:id,
								idt:idt

							},
							success : function(data){

							},
							error : function(){
								alert('sistem error!');
							}
						});
					}
					alert("Transaction success");
					window.location.replace("shop.php");
				},
				error : function(){
					alert('sistem error!');
				}
			});
		}
		
	
		
	}
</script>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#">Fit Buddy</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item ">
						<a class="nav-link" href="home.php"><HEAD></HEAD>Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="nutrition.php">Nutrition</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="workout.php">Workout</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="shop.php">Shop</a>
					</li>
					<li class="nav-item ">
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
				</ul>
			</div>
		</div>
	</nav>
	<br>
	<br>
	<br>
	<div id="bungkus1" class="container">

		<div class="row">
			

			<div class="col-md-4 order-md-2 mb-4">
				<br>
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-muted">Your cart</span>
					<span id="notif" class="badge badge-secondary badge-pill">0</span>
				</h4>
				<ul id="liChart"class="list-group mb-3 sticky-top">
					
					
					
					
				</ul>
				
			</div>
			
			<div class="col-md-8 order-md-1">
				<br>
				<h4 class="mb-3">Billing address</h4>
				<form class="needs-validation" novalidate="">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="firstName">First name</label>
							<input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
							<div class="invalid-feedback"> Valid first name is required. </div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="lastName">Last name</label>
							<input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
							<div class="invalid-feedback"> Valid last name is required. </div>
						</div>
					</div>
					

					<div class="mb-3">
						<label for="address">Address</label>
						<input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
						<div class="invalid-feedback"> Please enter your shipping address. </div>
					</div>

					<div class="row">
						<div class="col-md-5 mb-3">

							<label for="zip">No Telp</label>
							<input type="text" class="form-control" id="telp" placeholder="" required="">
							<div class="invalid-feedback"> Zip code required. </div>

						</div>
						
						
					</div>
					
					
					<h4 class="mb-3">Payment</h4>
					<div class="d-block my-3">
						<div class="custom-control custom-radio">
							<input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
							<label class="custom-control-label" for="credit">Credit card</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
							<label class="custom-control-label" for="debit">Debit card</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
							<label class="custom-control-label" for="paypal">PayPal</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="cc-name">Name on card</label>
							<input type="text" class="form-control" id="cc-name" placeholder="" required="">
							<small class="text-muted">Full name as displayed on card</small>
							<div class="invalid-feedback"> Name on card is required </div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="cc-number">Credit card number</label>
							<input type="text" class="form-control" id="cc-number" placeholder="" required="">
							<div class="invalid-feedback"> Credit card number is required </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 mb-3">
							<label for="cc-expiration">Expiration</label>
							<input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
							<div class="invalid-feedback"> Expiration date required </div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="cc-cvv">CVV</label>
							<input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
							<div class="invalid-feedback"> Security code required </div>
						</div>
					</div>
					<hr class="mb-4">
					<button class="btn btn-primary btn-lg btn-block" type="button" onclick="add()">Continue to checkout</button>
				</form>
			</div>
		</div>
		
	</div>

	<br>
	<input type="hidden" id="custId"  value="<?php echo $_SESSION["user_member"]?>">
	<input type="hidden" id="txtDate">
	<input type="hidden" id="user_Id"  value="<?php echo $_SESSION["user_id"]?>">

</body>
</html>

<?php
	mysqli_close($db);
	ob_end_flush();
?>