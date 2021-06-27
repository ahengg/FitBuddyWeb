<?php
    ob_start();
	session_start();
	include "connect.php";

    $id = $_POST["id"];

    $q = mysqli_query($db, "delete from detail_makanan where id_detail_makanan=".$id);
    if($q){
        echo "Data deleted!";
    }else{
        echo "Data can't be deleted";
    }

?>