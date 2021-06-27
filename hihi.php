<!DOCTYPE html>
<html>


<head>
		<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
		<!-- BOOTSTRAP -->
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
		<script type="text/javascript">
	
	 		$(document).ready(function(){
	 			alert("");
	 			var data_="";
				$.ajax({

							url: "ajax_displayExcMongoDB.php",
				            type: "json",
				            dataType: "json",
				            data: data_,
				            success:function(res){
				            	alert("");
				            	console.log(res);
				                var data = res;
				                var str="";
				                console.log(data.length);
				                for(var i=0;i<data.length;i++){
				                    var x = data[i][0];

				                    str+=x.nama_exercise;

				                    str+=" ";
				                }
				                alert(str);
				            },
				            error: function(e){
				                alert("Error exc");
				            }
						});
   			 });	
</script>

	<title></title>
	<h1>wow</h1>
</head>
<body>

</body>
</html>