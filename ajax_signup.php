<?php
ob_start();
session_start();
include "connect.php";

$name = $_POST["name"];
$email = $_POST["email"];
// DATE
$dateJQ = strtr($_POST["date"], '/', '-');
$date = date("Y-m-d", strtotime($dateJQ));
//COUNTRY ETC
$country = $_POST["country"];
$gender	= $_POST["gender"];
$password = $_POST["password"];
$cryptedPass = md5($password);
$member = "N";

$sql = mysqli_query($db, "SELECT * FROM user WHERE email='$email'");

if(mysqli_num_rows($sql) > 0){
	echo "<font:'red'>Email already registered</font>";
}else{
	// $add = mysqli_query($db, "INSERT INTO user VALUES(NULL, '".$name."', '".$email."', ".$date.", '".$country."', '".$password."', '".$gender."')");
	$add = mysqli_query($db, "INSERT INTO user (id, nama, email, tgl_lahir, country, gender, password, member) VALUES (NULL, '$name', '$email', '$date', '$country', '$gender', '$cryptedPass', '$member')");
	if($add){
		echo 1;
	}else{
		echo 0;
	}
}

?>