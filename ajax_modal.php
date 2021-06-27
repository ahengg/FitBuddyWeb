<?php
ob_start();
session_start();
include "connect.php";

$id = $_SESSION["user_id"];
$goalweight = $_POST["goalweight"];
$activity = $_POST["activity"];
$gender = $_POST["gender"];
$weight = $_POST["weight"];
$height = $_POST["height"];

// DATE
$dateJQ = strtr($_POST["dob"], '/', '-');
$dob = date("Y-m-d", strtotime($dateJQ));

//CALCULATE AGE
$now = time();
$dobNow = strtotime($dob);
$difference = $now - $dobNow;
$age = floor($difference / 31556926);

//COUNT DAILY GOAL
// BMR counting
if($gender == "Male"){
	$BMR = 88.362 + (13.397*$weight) + (4.779*$height) - (5.677*$age); 
}else{
	$BMR = 447.593 + (9.247*$weight) + (3.098*$height) - (4.33*$age);
}
//TEE counting
if($activity == "Not very active"){
	$TEE = $BMR*1.2;
}
else if($activity == "Lightly active"){
	$TEE = $BMR*1.375;
}
else if($activity == "Active"){
	$TEE = $BMR*1.55;
}
else{
	$TEE = $BMR*1.725;
}
//User custom goal
if($goalweight == "Lose weight"){
	$goaldaily = $TEE - 500;
}
else if($goalweight == "Maintain weight"){
	$goaldaily = $TEE;
}else{
	$goaldaily = $TEE + 500;
}

$goaldaily = round($goaldaily);
$_SESSION["user_goal"] = $goaldaily; 

$sql = mysqli_query($db, "UPDATE user SET goal_weight='$goalweight', activity_spec='$activity', gender='$gender', berat='$weight', tinggi='$height', goal_kalori='$goaldaily' WHERE id=$id");

if($sql){
	$_SESSION["user_goalWeight"] = $goalweight;
	$_SESSION["user_activity"] = $activity;
	$_SESSION["user_gender"] = $gender;
	$_SESSION["user_berat"] = $weight;
	$_SESSION["user_tinggi"] = $height;
	$_SESSION["user_dob"] = $dob;
	$_SESSION["user_umur"] = $age;

	echo $_SESSION["user_goal"];
	echo "Profile updated";
}else{
	echo "Something went wrong, try again later";
}
?>