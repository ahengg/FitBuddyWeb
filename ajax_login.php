<?php
ob_start();
session_start();
include "connect.php";

if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = $_POST["email"];
	$password = $_POST["password"];
	$cryptedPass = md5($password);

	$sql = mysqli_query($db, "SELECT * FROM user WHERE email='$email' and password='$cryptedPass'");
	
	if(mysqli_num_rows($sql) > 0){
		$row_user = mysqli_fetch_array($sql);
		
		$_SESSION['user_id'] = $row_user['id'];
		$_SESSION['user_email'] = $row_user['email'];
		$_SESSION['user_nama'] = $row_user['nama'];
		$_SESSION['user_gender'] = $row_user['gender'];
		$_SESSION['user_member'] = $row_user['member'];
		$_SESSION['user_tinggi'] = $row_user['tinggi'];
		$_SESSION['user_berat'] = $row_user['berat'];
		$_SESSION['user_goal'] = $row_user['goal_kalori'];
		$_SESSION['user_goalWeight'] = $row_user['goal_weight'];
		$_SESSION['user_activity'] = $row_user['activity_spec'];
		$_SESSION['user_calGoal'] = $row_user['goal_kalori'];
		$_SESSION['user_dob'] =  $row_user['tgl_lahir'];
		$_SESSION['prediction'] = $_SESSION['user_berat'];

		//CALCULATE AGE
		$now = time();
		$dob = strtotime($_SESSION['user_dob']);
		$difference = $now - $dob;
		$age = floor($difference / 31556926);
	 	$_SESSION['user_umur'] = $age;
	 	
		echo 1;
	}else{
		echo 0;
	}
}
?>