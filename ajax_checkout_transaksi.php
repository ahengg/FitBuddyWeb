<?php
ob_start();
session_start();
require_once 'connect.php';
if(isset($_POST["alamat"]) && isset($_POST["member"]) && isset($_POST["tanggal"]) && isset($_POST["totalAkhir"])){
	$alamat = $_POST["alamat"];
	$member = $_POST["member"];
	$totalAkhir= $_POST["totalAkhir"];

	$date= $_POST["tanggal"];

	if($member == "Y"){
		$disc="20%";
		$totalAkhir=$totalAkhir-($totalAkhir*0.2);
		$query=mysqli_query($db, "INSERT INTO transaksi VALUES(NULL,".$totalAkhir.",'".$date."','".$alamat."','".$disc."')");

	} 
	else{
		$disc="0%";
		$query=mysqli_query($db, "INSERT INTO transaksi VALUES(NULL,".$totalAkhir.",'".$date."','".$alamat."','".$disc."')"); 
	}

	if($query){
		$query2=mysqli_query($db, "SELECT id from transaksi where tanggal='$date' AND  alamat='$alamat' AND total=$totalAkhir AND diskon='$disc'");
		
		while($res = mysqli_fetch_assoc($query2)){
            echo $res['id'];
            break;
        }
			}
	else{
		echo "Something went wrong, try again later";
	}
}
?>

