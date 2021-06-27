<?php
ob_start();
session_start();
require_once 'connect.php';
if(isset($_POST['nama1']) && isset($_POST['harga1']) && isset($_POST['idt'])&& isset($_POST['id']) && isset($_POST['qty1'])){
	$nama=$_POST['nama1'];
	$id=$_POST['id'];
	$qty=$_POST['qty1'];
	$harga=$_POST['harga1'];
	$idt=$_POST['idt'];
	$query=mysqli_query($db, "INSERT INTO detail_transaksi VALUES(NULL,".$id.",".$idt.",'".$nama."',".$qty.",".$harga.")");

	if($query){
		echo "bisa";
	}
	else{
		echo "Something went wrong, try again later";
	}
}


else{
	echo "asd";
}
?>