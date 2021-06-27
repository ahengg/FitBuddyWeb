<?php
ob_start();
session_start();
include "connect.php";


$id = $_SESSION['user_id'];
$q = mysqli_query($db, "UPDATE user SET member = 'Y' WHERE id = $id");

if($q){
	$_SESSION['user_member'] = 'Y';
	echo "Congratulations! you're now a member";
}else{
	echo "Something went wrong, please try again later";
}

?>