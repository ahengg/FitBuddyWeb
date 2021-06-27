<?php
	session_start();
	$_SESSION["user_email"];

	unset($_SESSION["user_email"]);

	session_unset();
	session_destroy();

	header("location: login.php");

?>