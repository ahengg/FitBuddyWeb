<?php
ob_start();
session_start();
include "connect.php";

if(isset ($_POST["amount"]) && isset($_POST["exercise"]) && isset($_POST['tanggal'])){
    $amount = $_POST["amount"];
    $exercise = $_POST["exercise"];
    $tanggal = $_POST["tanggal"];
    
    $q = mysqli_query($db, "SELECT * FROM exercise WHERE id=$exercise");
   	
   	while($res = mysqli_fetch_assoc($q)){
		    $kalori = $res["cal_burned"]*$amount;
	}
	$id = $_SESSION['user_id'];
    
	$insert = mysqli_query($db, "INSERT INTO detail_exercise values(0,".$id.", ".$exercise.",".$amount.", ".$kalori.", '".$tanggal."')");
    if($insert){
        echo "Data Added!";
    }
    else{
        echo "Something went wrong, try again later";
    }
    
}


?>