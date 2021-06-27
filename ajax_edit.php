<?php
ob_start();
session_start();
include "connect.php";


$id = $_SESSION["user_id"];
$name = $_POST["name"];
$email = $_POST["email"];
$country = $_POST["country"];
$password = $_POST["password"];
$encrypt = md5("$password");

$sql = mysqli_query($db, "UPDATE user SET nama='".$name."', email='".$email."', country='".$country."', password='".$encrypt."' WHERE id=".$id);

if($sql){
 echo "Profile Updated";
}else{
 echo "Something went wrong, please try again later";
}

?>