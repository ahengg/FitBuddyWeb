<?php
    ob_start();
    session_start();
    include "connect.php";

    $q = mysqli_query($db, "SELECT * FROM makanan");

    $arr=[];
	while($res = mysqli_fetch_assoc($q)){
	    array_push($arr, $res);
	}

    echo json_encode($arr);

?>