<?php
ob_start();
session_start();
include "connect.php";

	$id = $_SESSION['user_id'];
	if(isset($_POST['tanggal'])){
		$tanggal = $_POST['tanggal'];
	}else{
		echo "Fail";
	}
	$q = mysqli_query($db, 
		"SELECT detail_exercise.id_detail_exercise, exercise.nama_exercise,detail_exercise.time, detail_exercise.cal_burned
		 FROM detail_exercise
		 INNER JOIN exercise ON detail_exercise.id_exercise=exercise.id
		 WHERE detail_exercise.id_user=$id AND detail_exercise.tanggal='$tanggal'"
		);

		$arr=[];
		while($res = mysqli_fetch_assoc($q)){
		    array_push($arr, $res);
		}

		echo json_encode($arr);
?>