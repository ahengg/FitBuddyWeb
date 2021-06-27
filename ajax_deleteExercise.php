<?php
    ob_start();
	session_start();
	include "connect.php";

    $id = $_POST["id"];

    $q = mysqli_query($db, "delete from detail_exercise where id_detail_exercise=".$id);
    if($q){
        echo "Data deleted!";
    }else{
        echo "Data can't be deleted";
    }

?>