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
	<link href="shop.css" rel="stylesheet" type="text/css">
	<!-- ANIMATION -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title> Shop-FitBuddy </title>
</head>	
<script type="text/javascript">
	var arrData=[];
	var pertama = 0;
	var check=0;
	var count=0;

	$(document).ready(function() {  
		$('#cartModal').click(function() {
			$(".mymodal").keypress(function() {
				
				console.log(this.id);

				//console.log($(".mymodal"));
				var id=this.id;
				document.getElementsByClassName("mymodal")[id].onkeyup = function() { myfunction(id)


				};
			});
			$(".tombol").click(function() {
				//alert("clicked");
				// console.log(this.id);
				// var id=this.id;
				var id=this.id;
				$(this).parent().parent().remove();
				//console.log("id:" + id);
				var qty= document.getElementsByClassName("mymodal");
				for(a=0;a<document.getElementById("chart").rows.length-1;a++){
					qty[a].id=parseInt(parseInt(qty[a].id)-1);
				}
				
				
				count-=1;


				//total
				var hasil=0;
				for(a=1;a<document.getElementById("chart").rows.length;a++){
					var x=document.getElementById("chart").rows[a].cells;
					
					hasil=hasil+parseInt(x[4].innerHTML);


				}
				document.getElementById("totalModal").innerHTML=hasil;
				
			});
			
		});
		
		//card[2].style.display="block";


		// $('#cartModal').modal('show');
		


	});
	
	function myfunction(id){

		var dataQty=document.getElementsByClassName("mymodal")[id].value;
		var harga=document.getElementsByClassName("hargaMod");
		var dataHarga0=harga[id].innerHTML;
		var dataHarga = Number(dataHarga0.replace(/[^0-9.-]+/g,""));
		console.log("data harga :"+dataHarga);
		console.log("udah di my function idnya : "+dataQty);
		dataQty=parseInt(dataQty);
		dataHarga=parseInt(dataHarga);
		
		$.ajax({
			url: "ajax_qty.php",
			type: "POST",
			dataType: "text",
			data:{
				dataQty:dataQty,
				dataHarga:dataHarga
			}, 
			success:function(res){

				var total=document.getElementsByClassName("tot");
				if(res.length >= 20){
					var hasil=res.substr(120,1);
					res=hasil;
				}
				total[id].innerHTML=res;
				var hasil=0;
				for(a=1;a<document.getElementById("chart").rows.length;a++){
					var x=document.getElementById("chart").rows[a].cells;
					hasil=hasil+parseInt(x[4].innerHTML);


				}
				document.getElementById("totalModal").innerHTML=hasil;
			},
			error: function(e){
				alert("Error");
			}
		});
	}
	function search(txt){
		var value = txt.toLowerCase();


		$(".card-product-list").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
		});
		
	}
	function apply(min,max){
		var min1 = Number(min.replace(/[^0-9\.-]+/g,""));
		var min2=min1*1000;

		var max1 = Number(max.replace(/[^0-9\.-]+/g,""));
		var max2=max1*1000;

		
		var list=document.getElementsByClassName("price h5");
		var card=document.getElementsByClassName("card-product-list");
		for(a=0;a<list.length;a++){
			var number1 = Number(list[a].innerHTML.replace(/[^0-9\.-]+/g,""));
			var number2=number1*1000;
			if(number2 < min2 || number2 > max2){
				card[a].style.display="none";
			}
			else{
				card[a].style.display="block";
			}

		}

		
	}
	function change(){
		var str;
		var card=document.getElementsByClassName("col-md-9");
		var pilih123=$( "#myselect option:selected" )
		var pilih=pilih123.val();
		//alert(pilih);

		if(pilih == 1){
			//alert("wkwk");
			str="<header class='border-bottom mb-4 pb-3'><div class='form-inline'><span class='mr-md-auto' style='color:white; font-size:16px;'>Halo <?php echo $_SESSION["user_nama"]?> </span><select id='myselect' class='mr-2 form-control' onchange='change()'><option value=1>Latest items</option><option value=2>Cheapest</option></select><button type='button' class='btn btn-success' data-toggle='modal' data-target='#cartModal'><i class='fa fa-shopping-cart'></i> View Cart</button></header><article class='card card-product-list'><div class='row no-gutters'><aside class='col-md-3'><span class='badge badge-danger'> NEW </span><img src='img/suplemen1.png' style='  width: 100%; height: 15vw; object-fit: cover;padding: 1.5rem 1rem;'></aside><div class='col-md-6'  style='border-right: 1px solid #e4e4e4 ;padding: 1.5rem 1rem;'><div class='info-main'><a href='#' class='h5 title'> Citruline POLYHIDRATE  </a><p> Citrulline adalah asam amino non-esensial yang merupakan perantara penting dalam siklus urea, berfungsi bersama dengan asam amino lainnya untuk membersihkan tubuh amonia, produk sampingan dari metabolisme protein. Citrulline juga memainkan peran penting dalam proses penyembuhan dan dalam pemeliharaan sistem kekebalan tubuh yang sehat.  </p></div> </div> <aside class='col-sm-3' style='padding: 1.5rem 1rem;height: 100%;'><div class='info-aside' ><div class='price-wrap' ><span id='price1' class='price h5'> Rp 399.000 </span>	<del class='price-old'> 400.000</del></div><br></div><br><p><a href='#' class='btn btn-light btn-block' onclick='add(document.getElementById('price1').innerHTML,'Citruline POLYHIDRATE','img/suplemen1.png')'><i class='fa fa-shopping-cart'></i> <span class='text'>Add to cart</span></a></p></aside> </div> </article> <br><article class='card card-product-list'><div class='row no-gutters'><aside class='col-md-3'><a href='#' class='img-wrap'><img src='img/suplemen2.png' style='  width: 100%;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></a></aside><div class='col-md-6'  style='border-right: 1px solid #e4e4e4 ;padding: 1.5rem 1rem'><div class='info-main'><a href='#' class='h5 title'> PAKET WHEY PROTEIN GOLD STANDARD  </a><p> Whey Protein Isolates (WPI) are the purest form of whey protein that currently exists. WPIs are costly to use, but rate among the best proteins that money can buy. That's why they're the first ingredient you read on the Gold Standard 100% Whey™ label. </p></div> </div><aside class='col-sm-3' style='padding: 1.5rem 1rem;height: 100%;'><div class='info-aside'><div class='price-wrap'><span id='price2' class='price h5'> Rp 200.000 </span>	<del class='price-old'> 750.000</del></div> <br><p><a href='#' class='btn btn-light btn-block' onclick='add(document.getElementById('price2').innerHTML,'PAKET WHEY PROTEIN GOLD STANDARD','img/suplemen2.png')'><i class='fa fa-shopping-cart'></i> <span class='text'>Add to cart</span></a></p></div> </aside> </div> </article> <br><article class='card card-product-list'><div class='row no-gutters'><aside class='col-md-3'><a href='#' class='img-wrap'><img src='img/suplemen3.png' style='  width: 100%;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></a></aside> <!-- col.// --><div class='col-md-6'  style='border-right: 1px solid #e4e4e4 ;padding: 1.5rem 1rem'><div class='info-main'><a href='#' class='h5 title'> FIT BAR protein XL  </a><p> Fitbar adalah snack sehat yang terbuat dari Oat, Quinoa dan Whole Wheat yang merupakan sumber serat. Serta Fitbar bebas dari kolesterol, bebas dari lemak trans, dan memiliki kandungan kalori yang rendah. Jauh lebih rendah dibandingkan  snack-snack lainnya. </p></div> </div> <aside class='col-sm-3' style='padding: 1.5rem 1rem;height: 100%;'><div class='info-aside'><div class='price-wrap'><span id='price3' class='price h5'> Rp 600.000 </span>	</div> <br><p><a href='#' class='btn btn-light btn-block' onclick='add(document.getElementById('price3').innerHTML,'FIT BAR protein XL','img/suplemen3.png')'><i class='fa fa-shopping-cart'></i> <span class='text'>Add to cart</span></a></p></div> </aside> </div> </article> <br><article class='card card-product-list' ><div class='row no-gutters'><aside class='col-md-3'><a href='#' class='img-wrap'><img src='img/suplemen4.png' style='  width: 100%;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></a></aside><div class='col-md-6'  style='border-right: 1px solid #e4e4e4;padding: 1.5rem 1rem'><div class='info-main'><a href='#' class='h5 title'> MTN ops MAGNUM  </a><p> MTN OPS MAGNUM Whey Protein blend and AMMO Whey Protein Meal Replacement are loaded with premium whey protein blends to enhance your desired results. It doesn't matter if you're looking to gain lean muscle mass in the gym or fit into a pair of old high school jeans again, find the right protein and flavor to help you reach your health goals today </p></div></div> <aside class='col-sm-3' style='padding: 1.5rem 1rem;height: 100%;'><div class='info-aside'><div class='price-wrap'><span id='price4' class='price h5'> Rp 500.000 </span></div> <br><p><a href='#' class='btn btn-light btn-block'  onclick='add(document.getElementById('price4').innerHTML,'MTN ops MAGNUM','img/suplemen4.png')'><i class='fa fa-shopping-cart'></i> <span class='text'>Add to cart</span></a></p></div> </aside> </div> </article> <br><nav aria-label='Page navigation sample' ><ul class='pagination' ><li class='page-item disabled'><a class='page-link' href='#' style='opacity: 0.9;background-color: #313131 ;color: #eee;'>Previous</a></li><li class='page-item active'><a class='page-link' href='#'>1</a></li><li class='page-item'><a class='page-link' href='#'>2</a></li><li class='page-item'><a class='page-link' href='#'>3</a></li><li class='page-item'><a class='page-link' href='#'>Next</a></li></ul></nav>";

			card[0].innerHTML=str;
			document.getElementById("myselect").value="1";
		}
		else if(pilih==2){

			str="<header class='border-bottom mb-4 pb-3'><div class='form-inline'><span class='mr-md-auto' style='color:white; font-size:16px;'>Halo <?php echo $_SESSION["user_nama"]?> </span><select id='myselect' class='mr-2 form-control' onchange='change()'><option value=1>Latest items</option><option value=2>Cheapest</option></select><button type='button' class='btn btn-success' data-toggle='modal' data-target='#cartModal'><i class='fa fa-shopping-cart'></i> View Cart</button></header><article class='card card-product-list'><div class='row no-gutters'><aside class='col-md-3'><a href='#' class='img-wrap'><img src='img/suplemen2.png' style='width: 100%;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></a></aside> <div class='col-md-6'  style='border-right: 1px solid #e4e4e4 ;padding: 1.5rem 1rem'><div class='info-main'><a href='#' class='h5 title'> PAKET WHEY PROTEIN GOLD STANDARD  </a><p> Whey Protein Isolates (WPI) are the purest form of whey protein that currently exists. WPIs are costly to use, but rate among the best proteins that money can buy. That's why they're the first ingredient you read on the Gold Standard 100% Whey™ label. </p></div> </div><aside class='col-sm-3' style='padding: 1.5rem 1rem;height: 100%;'><div class='info-aside'><div class='price-wrap'><span id='price2' class='price h5'> Rp 200.000 </span><del class='price-old'> 750.000</del></div><br><p><a href='#' class='btn btn-light btn-block' onclick='add(document.getElementById('price2').innerHTML,'PAKET WHEY PROTEIN GOLD STANDARD','img/suplemen2.png')'><i class='fa fa-shopping-cart'></i><span class='text'>Add to cart</span></a></p></div> </aside> </div> </article> <br><article class='card card-product-list'><div class='row no-gutters'><aside class='col-md-3'><span class='badge badge-danger'> NEW </span><img src='img/suplemen1.png' style='  width: 100%;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></aside><div class='col-md-6'  style='border-right: 1px solid #e4e4e4 ;padding: 1.5rem 1rem;'><div class='info-main'><a href='#' class='h5 title'> Citruline POLYHIDRATE  </a><p> Citrulline adalah asam amino non-esensial yang merupakan perantara penting dalam siklus urea, berfungsi bersama dengan asam amino lainnya untuk membersihkan tubuh amonia, produk sampingan dari metabolisme protein. Citrulline juga memainkan peran penting dalam proses penyembuhan dan dalam pemeliharaan sistem kekebalan tubuh yang sehat.  </p></div> </div> <aside class='col-sm-3' style='padding: 1.5rem 1rem;height: 100%;'><div class='info-aside' ><div class='price-wrap' ><span id='price1' class='price h5'> Rp 399.000 </span><del class='price-old'> 400.000</del></div> </div><p><a href='#' class='btn btn-light btn-block' onclick='add(document.getElementById('price1').innerHTML,'Citruline POLYHIDRATE','img/suplemen1.png')'><i class='fa fa-shopping-cart'></i> <span class='text'>Add to cart</span></a></p></aside> </div> </article> <br><article class='card card-product-list' ><div class='row no-gutters'><aside class='col-md-3'><a href='#' class='img-wrap'><img src='img/suplemen4.png' style='  width: 100%;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></a></aside><div class='col-md-6'  style='border-right: 1px solid #e4e4e4;padding: 1.5rem 1rem'><div class='info-main'><a href='#' class='h5 title'> MTN ops MAGNUM  </a><p> MTN OPS MAGNUM Whey Protein blend and AMMO Whey Protein Meal Replacement are loaded with premium whey protein blends to enhance your desired results. It doesn't matter if you're looking to gain lean muscle mass in the gym or fit into a pair of old high school jeans again, find the right protein and flavor to help you reach your health goals today </p></div></div> <aside class='col-sm-3' style='padding: 1.5rem 1rem;height: 100%;'><div class='info-aside'><div class='price-wrap'><span id='price4' class='price h5'> Rp 500.000 </span>	</div> <br><p><a href='#' class='btn btn-light btn-block'  onclick='add(document.getElementById('price4').innerHTML,'MTN ops MAGNUM','img/suplemen4.png')'><i class='fa fa-shopping-cart'></i> 	<span class='text'>Add to cart</span></a>	</p></div> </aside> </div> </article> <br><article class='card card-product-list'><div class='row no-gutters'><aside class='col-md-3'><a href='#' class='img-wrap'><img src='img/suplemen3.png' style='  width: 100%;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></a></aside><div class='col-md-6'  style='border-right: 1px solid #e4e4e4 ;padding: 1.5rem 1rem'><div class='info-main'><a href='#' class='h5 title'> FIT BAR protein XL  </a><p> Fitbar adalah snack sehat yang terbuat dari Oat, Quinoa dan Whole Wheat yang merupakan sumber serat. Serta Fitbar bebas dari kolesterol, bebas dari lemak trans, dan memiliki kandungan kalori yang rendah. Jauh lebih rendah dibandingkan  snack-snack lainnya. </p></div> </div> <aside class='col-sm-3' style='padding: 1.5rem 1rem;height: 100%;'><div class='info-aside'><div class='price-wrap'><span id='price3' class='price h5'> Rp 600.000 </span>	</div> <br><p><a href='#' class='btn btn-light btn-block' onclick='add(document.getElementById('price3').innerHTML,'FIT BAR protein XL','img/suplemen3.png')'><i class='fa fa-shopping-cart'></i> <span class='text'>Add to cart</span></a></p></div> </aside> </div> </article> <br><nav aria-label='Page navigation sample' ><ul class='pagination' ><li class='page-item disabled'><a class='page-link' href='#' style='opacity: 0.9;background-color: #313131 ;color: #eee;'>Previous</a></li><li class='page-item active'><a class='page-link' href='#'>1</a></li><li class='page-item'><a class='page-link' href='#'>2</a></li><li class='page-item'><a class='page-link' href='#'>3</a></li><li class='page-item'><a class='page-link' href='#'>Next</a></li></ul></nav>";
			
			card[0].innerHTML=str;
			document.getElementById("myselect").value="2";

		}
		//alert(str);
	}


	function add(harga,nama,img){
		var number = Number(harga.replace(/[^0-9\.-]+/g,""));
		harga=number*1000;
		
		// $("tbody").append("<tr><td class='w-25'><img src="+img+" style='  width: 100;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></img></td><td>"+nama+"</td><td>"+harga+"</td><td><class='qty'><input type='text' class='form-control' id='input1' value='1'></td><td>"+1000+"<td><a href='#' class='btn btn-danger btn-sm'><i class='fa fa-times'></i></a></td><tr>");
		if(document.getElementById("chart").rows.length==1){
			$("tbody").append("<tr class='mytr'><td class='w-25' style='vertical-align: middle;text-align: center;'><img src="+img+" style='border: 1px solid #dee2e6;border-radius: .25rem; width: 100;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></img></td><td style='vertical-align: middle;text-align: center;'>"+nama+"</td><td class='hargaMod'style='vertical-align: middle;text-align: center;'>"+(harga)+"</td><td  style='vertical-align: middle;text-align: center;'><class='qty'><input type='text' class='form-control mymodal' index="+count+" id='"+count+"'' value=' 1 ' style='width: 45px;'></td><td class='tot'style='vertical-align: middle;text-align: center;'>"+harga+"<td style='vertical-align: middle;text-align: center;'><a href='#' id='"+count+"' class='btn btn-danger btn-sm tombol' ><i class='fa fa-times'></i></a></td></tr>");
			count+=1;
		}
		else{
			for(a=1;a<document.getElementById("chart").rows.length;a++){

				var x=document.getElementById("chart").rows[a].cells;
				
				if(x[1].innerHTML!=nama){
					check=1;
					
				}
				else{
					var f = document.getElementsByClassName("form-control mymodal");
					//console.log(f[0].value);
					//alert(f[0].innerHTML);
					//alert(document.getElementsByTagName("m").length);
					//alert("class name :"+document.getElementsByClassName("m")[a-1].value);
					// alert("sama : " + x[1].innerHTML + " qty : " + document.getElementByClassName('form-control')[a].value);
					check=0;
					
					f[a-1].value=parseInt(f[a-1].value)+1;

					x[4].innerHTML= parseInt(x[2].innerHTML)*parseInt(f[a-1].value);
					break;
				}

			}
		}
		
		if(check==1){
			$("tbody").append("<tr><td class='w-25' style='vertical-align: middle;text-align: center;'><img src="+img+" style='border: 1px solid #dee2e6;border-radius: .25rem; width: 100;height: 15vw;object-fit: cover;padding: 1.5rem 1rem;'></img></td><td style='vertical-align: middle;text-align: center;'>"+nama+"</td><td class='hargaMod' style='vertical-align: middle;text-align: center;'>"+harga+"</td><td style='vertical-align: middle;text-align: center;'><class='qty'><input type='text' class='form-control mymodal' index="+count+" id='"+count+"' value=' 1 ' style='width: 45px;'></td><td class='tot'style='vertical-align: middle;text-align: center;'>"+harga+"<td style='vertical-align: middle;text-align: center;'><a href='#' id='"+count+"' class='btn btn-danger btn-sm tombol' ><i class='fa fa-times'></i></a></td></tr>");
			count+=1;
			check=0;
		}
		var hasil=0;
		for(a=1;a<document.getElementById("chart").rows.length;a++){
			var x=document.getElementById("chart").rows[a].cells;
			hasil=hasil+parseInt(x[4].innerHTML);
			
			
		}
		document.getElementById("totalModal").innerHTML=hasil;

	}

	function Checkout(){
		console.log(document.getElementById("chart").rows.length);
		if(document.getElementById("chart").rows.length > 1){
			var qty= document.getElementsByClassName("mymodal");
			var namaArr=[];
			var hargaArr=[];
			var qtyArr=[];
			for(a=1,b=0;a<document.getElementById("chart").rows.length;a++,b++){
				var x=document.getElementById("chart").rows[a].cells;
				console.log(x[1].innerHTML+" "+x[2].innerHTML+" "+qty[b].value);
				namaArr[b]=x[1].innerHTML;
				hargaArr[b]=x[2].innerHTML;
				qtyArr[b]=qty[b].value;
			}
			console.log(namaArr);

			console.log(hargaArr);

			console.log(qtyArr);
			
			localStorage.setItem("namaArr",JSON.stringify(namaArr));

			localStorage.setItem("hargaArr",JSON.stringify(hargaArr));

			localStorage.setItem("qtyArr",JSON.stringify(qtyArr));
			window.location.replace("Checkout.php");
		}
		else{
			alert("Cart is empty");
		}
	}
</script>

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
				      	<li class="nav-item  active">
				        <a class="nav-link" href="shop.php">Shop</a>
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
	<br>
	<br>
	<br>

	<div class="container">

		<div class="row">
			<aside class="col-md-3" >

				<div class="card mycard" style=" opacity: 0.9;
				background-color: #313131 ;
				color: #eee;">
				<article class="filter-group">
					<header class="card-header">
						<a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" class="collapsed">
							
							<h6 class="title">Product search</h6>
						</a>
					</header>
					<div class="filter-content collapse" id="collapse_1" style="">
						<div class="card-body">
							<form class="pb-3">
								<div id="asd" class="input-group">
									<input type="text" id="unik" class="form-control" placeholder="Search">
									<div class="input-group-append">
										<button class="btn btn-light" type="button" onclick="search(document.getElementById('unik').value)"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>



						</div> <!-- card-body.// -->
					</div>
				</article> 
				<article class="filter-group">
					<header class="card-header">
						<a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="false" class="collapsed">
							
							<h6 class="title">Price range </h6>
						</a>
					</header>
					<div class="filter-content collapse" id="collapse_3" style="">
						<div class="card-body">

							<label>Min</label>
							<input id="min" class="form-control" placeholder="Harga minimum" type="number">
							<br>

							<label>Max</label>
							<input id="max" class="form-control" placeholder="Harga maksimum" type="number">
							<br>
							
							<button class="btn btn-block btn-primary" onclick="apply(document.getElementById('min').value,document.getElementById('max').value)">Apply</button>
						</div><!-- card-body.// -->
					</div>
				</article> <!-- filter-group .// -->


			</div> <!-- card.// -->

		</aside> <!-- col.// -->
		<br>
		<main class="col-md-9">

			<header class="border-bottom mb-4 pb-3">
				<div class="form-inline">
					<span class="mr-md-auto" style="color:white; font-size:16px;">Halo <?php echo $_SESSION["user_nama"]?> </span>
					<select id="myselect" class="mr-2 form-control" onchange="change()">
						<option value=1>Latest items</option>
						<option value=2>Cheapest</option>
					</select>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#cartModal">
						<i class="fa fa-shopping-cart"></i> View Cart
					</button>  

				</header><!-- sect-heading -->


				<article class="card card-product-list">
					<div class="row no-gutters">
						<aside class="col-md-3">

							<span class="badge badge-danger"> NEW </span>
							<img src="img/suplemen1.png" style="  width: 100%;
							height: 15vw;
							object-fit: cover;padding: 1.5rem 1rem;">

						</aside> <!-- col.// -->

						<div class="col-md-6"  style="border-right: 1px solid #e4e4e4 ;padding: 1.5rem 1rem;">
							<div class="info-main">
								<a href="#" class="h5 title"> Citruline POLYHIDRATE  </a>


								<p> Citrulline adalah asam amino non-esensial yang merupakan perantara penting dalam siklus urea, berfungsi bersama dengan asam amino lainnya untuk membersihkan tubuh amonia, produk sampingan dari metabolisme protein. Citrulline juga memainkan peran penting dalam proses penyembuhan dan dalam pemeliharaan sistem kekebalan tubuh yang sehat.  </p>
							</div> <!-- info-main.// -->
						</div> <!-- col.// -->
						<aside class="col-sm-3" style="padding: 1.5rem 1rem;

						height: 100%;">
						<div class="info-aside" >
							<div class="price-wrap" >
								<span id="price1" class="price h5"> Rp 399.000 </span>	
								<del class="price-old"> 400.000</del>
							</div> <!-- info-price-detail // -->
							<br>
						</div> <!-- info-aside.// -->
						
						<p>
							
							<a href="#" class="btn btn-light btn-block" onclick="add(document.getElementById('price1').innerHTML,'Citruline POLYHIDRATE','img/suplemen1.png')"><i class="fa fa-shopping-cart"></i> 
								<span class="text">Add to cart</span>
							</a>
						</p>
					</aside> <!-- col.// -->
				</div> <!-- row.// -->
			</article> <!-- card-product .// -->
			<br>
			<article class="card card-product-list">
				<div class="row no-gutters">
					<aside class="col-md-3">
						<a href="#" class="img-wrap"><img src="img/suplemen2.png" style="  width: 100%;
						height: 15vw;
						object-fit: cover;padding: 1.5rem 1rem;"></a>
					</aside> <!-- col.// -->
					<div class="col-md-6"  style="border-right: 1px solid #e4e4e4 ;padding: 1.5rem 1rem">
						<div class="info-main">
							<a href="#" class="h5 title"> PAKET WHEY PROTEIN GOLD STANDARD  </a>


							<p> Whey Protein Isolates (WPI) are the purest form of whey protein that currently exists. WPIs are costly to use, but rate among the best proteins that money can buy. That's why they're the first ingredient you read on the Gold Standard 100% Whey™ label. </p>
						</div> <!-- info-main.// -->
					</div> <!-- col.// -->
					<aside class="col-sm-3" style="padding: 1.5rem 1rem;

					height: 100%;">
					<div class="info-aside">
						<div class="price-wrap">
							<span id="price2" class="price h5"> Rp 200.000 </span>	
							<del class="price-old"> 750.000</del>
						</div> <!-- info-price-detail // -->
						<br>
						<p>
							
							<a href="#" class="btn btn-light btn-block" onclick="add(document.getElementById('price2').innerHTML,'PAKET WHEY PROTEIN GOLD STANDARD','img/suplemen2.png')"><i class="fa fa-shopping-cart"></i> 
								<span class="text">Add to cart</span>
							</a>
						</p>
					</div> <!-- info-aside.// -->
				</aside> <!-- col.// -->
			</div> <!-- row.// -->
		</article> <!-- card-product .// -->
		<br>
		<article class="card card-product-list">
			<div class="row no-gutters">
				<aside class="col-md-3">
					<a href="#" class="img-wrap"><img src="img/suplemen3.png" style="  width: 100%;
					height: 15vw;
					object-fit: cover;padding: 1.5rem 1rem;"></a>
				</aside> <!-- col.// -->
				<div class="col-md-6"  style="border-right: 1px solid #e4e4e4 ;padding: 1.5rem 1rem">
					<div class="info-main">
						<a href="#" class="h5 title"> FIT BAR protein XL  </a>


						<p> Fitbar adalah snack sehat yang terbuat dari Oat, Quinoa dan Whole Wheat yang merupakan sumber serat. Serta Fitbar bebas dari kolesterol, bebas dari lemak trans, dan memiliki kandungan kalori yang rendah. Jauh lebih rendah dibandingkan  snack-snack lainnya. </p>
					</div> <!-- info-main.// -->
				</div> <!-- col.// -->
				<aside class="col-sm-3" style="padding: 1.5rem 1rem;

				height: 100%;">
				<div class="info-aside">
					<div class="price-wrap">
						<span id="price3" class="price h5"> Rp 600.000 </span>	
					</div> <!-- info-price-detail // -->

					<br>
					<p>
						
						<a href="#" class="btn btn-light btn-block" onclick="add(document.getElementById('price3').innerHTML,'FIT BAR protein XL','img/suplemen3.png')"><i class="fa fa-shopping-cart"></i> 
							<span class="text">Add to cart</span>
						</a>
					</p>
				</div> <!-- info-aside.// -->
			</aside> <!-- col.// -->
		</div> <!-- row.// -->
	</article> <!-- card-product .// -->
	<br>
	<article class="card card-product-list" >
		<div class="row no-gutters">
			<aside class="col-md-3">
				<a href="#" class="img-wrap"><img src="img/suplemen4.png" style="  width: 100%;
				height: 15vw;
				object-fit: cover;padding: 1.5rem 1rem;"></a>
			</aside> <!-- col.// -->
			<div class="col-md-6"  style="border-right: 1px solid #e4e4e4;padding: 1.5rem 1rem">
				<div class="info-main">
					<a href="#" class="h5 title"> MTN ops MAGNUM  </a>


					<p> MTN OPS MAGNUM Whey Protein blend and AMMO Whey Protein Meal Replacement are loaded with premium whey protein blends to enhance your desired results. It doesn't matter if you're looking to gain lean muscle mass in the gym or fit into a pair of old high school jeans again, find the right protein and flavor to help you reach your health goals today </p>
				</div> <!-- info-main.// -->
			</div> <!-- col.// -->
			<aside class="col-sm-3" style="padding: 1.5rem 1rem;

			height: 100%;">
			<div class="info-aside">
				<div class="price-wrap">
					<span id="price4" class="price h5"> Rp 500.000 </span>	
				</div> <!-- info-price-detail // -->

				<br>
				<p>
					
					<a href="#" class="btn btn-light btn-block"  onclick="add(document.getElementById('price4').innerHTML,'MTN ops MAGNUM','img/suplemen4.png')"><i class="fa fa-shopping-cart"></i> 
						<span class="text">Add to cart</span>
					</a>
				</p>
			</div> <!-- info-aside.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</article> <!-- card-product .// -->
<br>



<nav aria-label="Page navigation sample" >
	<ul class="pagination" >
		<li class="page-item disabled"><a class="page-link" href="#" style="opacity: 0.9;
		background-color: #313131 ;
		color: #eee;">Previous</a></li>
		<li class="page-item active"><a class="page-link" href="#">1</a></li>
		<li class="page-item"><a class="page-link" href="#">2</a></li>
		<li class="page-item"><a class="page-link" href="#">3</a></li>
		<li class="page-item"><a class="page-link" href="#">Next</a></li>
	</ul>
</nav>

</main>

</div>

</div>
<div  class="modal fade show" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header border-bottom-0">
				<h5 class="modal-title" id="exampleModalLabel">
					Your Shopping Cart
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table id="chart" class="table table-image">
					<thead>
						<tr>
							<th scope="col" style="border: 0;
							color: #666;
							font-size: 0.8rem; text-align: center;"></th>
							<th scope="col" style="border: 0;
							color: #666;
							font-size: 0.8rem; text-align: center;">product</th>
							<th scope="col" style="border: 0;
							color: #666;
							font-size: 0.8rem; text-align: center;">Price</th>
							<th scope="col" style="border: 0;
							color: #666;
							font-size: 0.8rem;">Qty</th>
							<th scope="col" style="border: 0;
							color: #666;
							font-size: 0.8rem; text-align: center;">Total</th>
							<th scope="col" style="border: 0;
							color: #666;
							font-size: 0.8rem; text-align: center;">Actions</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table> 
				<div class="d-flex justify-content-end">
					<h5>Total: Rp <span id="totalModal" class="price text-success" data-a-dec="," data-a-sep="."> </span></h5>
				</div>
			</div>
			<div class="modal-footer border-top-0 d-flex justify-content-between">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="Checkout()">Checkout</button>
			</div>
		</div>
	</div>
</div>
<script src="main.js"></script>
</body>
</html>