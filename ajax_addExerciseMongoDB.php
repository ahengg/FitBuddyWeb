<?php
ob_start();
session_start();
include "connect.php";

if((isset ($_POST["amount"]) && isset($_POST["exercise"]) && isset($_POST['tanggal']))){
    $amount = $_POST["amount"];
    $exercise = $_POST["exercise"];
    $tanggal = $_POST["tanggal"];

    $q = mysqli_query($db, "SELECT * FROM exercise WHERE id=$exercise");
   	
   	while($res = mysqli_fetch_assoc($q)){
		    $kalori = $res["cal_burned"]*$amount;
	}
	$id = $_SESSION['user_id'];
    //Mongo DB 
    $bulk = new MongoDB\Driver\BulkWrite;

    require_once 'C:\Users\Aheng\vendor\autoload.php';

    $DB_CONNECTION_STRING="mongodb://localhost:27017/?readPreference=primary&appname=MongoDB%20Compass&ssl=false";
    //
    $m = new MongoDB\Driver\Manager($DB_CONNECTION_STRING);
     $filter=[];
     $options = [];  
     $query = new MongoDB\Driver\Query($filter, $options);
     $documents=$m->executeQuery('fitbuddy.detailexercise', $query);
     $cal=array();
     $simp=0;
     foreach($documents as $document){
                $document = json_decode(json_encode($document),true);
                $wow=$document['id_detail_exercise'];
                if($simp<(int)$wow){
                    $simp=(int)$wow;
                }
                
    };
    $simp=$simp+1;
    $simp=(string)$simp;
    
    echo $simp;
    //
     $doc=[
    'id_detail_exercise' => $simp,
       'id_user' => $id,
        'id_exercise' => $exercise,'time' => $amount,'cal_burned' => $kalori,'tanggal' => $tanggal
    ];
    $bulk->insert($doc);
    $manager = new MongoDB\Driver\Manager($DB_CONNECTION_STRING);
    $result = $manager->executeBulkWrite('fitbuddy.detailexercise', $bulk);
    
}
else{
    echo "gaga";
}


?>