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
		"SELECT detail_makanan.id_detail_makanan, makanan.nama, detail_makanan.jumlah_porsi, detail_makanan.total_kal, detail_makanan.total_karb, detail_makanan.total_lemak, detail_makanan.total_prot
		 FROM detail_makanan
		 INNER JOIN makanan ON detail_makanan.id_makanan=makanan.id
		 WHERE detail_makanan.id_user=$id AND detail_makanan.tanggal='$tanggal'"
		);

		$arr=[];
		while($res = mysqli_fetch_assoc($q)){
		    array_push($arr, $res);
		}

		echo json_encode($arr);
?>