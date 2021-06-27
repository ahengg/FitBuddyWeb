<?php
ob_start();
session_start();
include "connect.php";

if(isset ($_POST["amount"]) && isset($_POST["food"]) && isset($_POST['tanggal'])){
    $amount = $_POST["amount"];
    $food = $_POST["food"];
    $tanggal = $_POST["tanggal"];
    
    $q = mysqli_query($db, "SELECT * FROM makanan WHERE id=$food");
   	
   	while($res = mysqli_fetch_assoc($q)){
		    $kalori = $res["kalori"]*$amount;
		    $karbohidrat = $res["karbohidrat"]*$amount;
		    $protein = $res["protein"]*$amount;
		    $lemak = $res["lemak"]*$amount;
	}
	$id = $_SESSION['user_id'];

	$insert = mysqli_query($db, "INSERT INTO detail_makanan values(0,".$id.", ".$food.",".$amount.", ".$kalori.", ".$karbohidrat.", ".$lemak.", ".$protein.", '".$tanggal."')");
    if($insert){
        echo "Data Added!";
    }
    else{
        echo "Something went wrong, try again later";
    }
    
}


?>