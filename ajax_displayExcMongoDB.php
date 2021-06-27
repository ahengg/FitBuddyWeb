<?php
ob_start();
session_start();
$id = $_SESSION['user_id'];

include "connect.php";

if(isset($_POST['tanggal'])){
		$tanggal = $_POST['tanggal'];
	}else{
		//$tanggal = "2021-06-15";
}
 $DB_CONNECTION_STRING="mongodb://localhost:27017/?readPreference=primary&appname=MongoDB%20Compass&ssl=false";
 require_once 'C:\Users\Aheng\vendor\autoload.php';
 $m = new MongoDB\Driver\Manager($DB_CONNECTION_STRING);
 $filter=['id_user'=>$id,'tanggal'=>$tanggal];
 $options = [];	 
 $query = new MongoDB\Driver\Query($filter, $options);
 $documents=$m->executeQuery('fitbuddy.detailexercise', $query);
 $cal=array();
 $arr=[];
 foreach($documents as $document){
		    $document = json_decode(json_encode($document),true);
			$wow=$document['id_exercise'];
	
			$q = mysqli_query($db, 
			"SELECT nama_exercise
		 	FROM exercise WHERE id=$wow");	
		 	while($res = mysqli_fetch_assoc($q)){
		    array_push($document, $res);
			}	    
	    	array_push($cal, $document) ;

}

echo json_encode($cal);

?>