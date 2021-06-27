<?php
ob_start();
session_start();
include "connect.php";

$id = $_SESSION['user_id'];
if(isset($_POST['tanggal'])){
	$tanggal = $_POST['tanggal'];
}else{
	echo "Fail";
}

//FOOD 
$kalori = 0;
$karbohidrat = 0;
$protein = 0;
$lemak = 0;
$DB_CONNECTION_STRING="mongodb://localhost:27017/?readPreference=primary&appname=MongoDB%20Compass&ssl=false";
 require_once 'C:\Users\Aheng\vendor\autoload.php';
 $m = new MongoDB\Driver\Manager($DB_CONNECTION_STRING);
 $filter=['id_user'=>$id,'tanggal'=>$tanggal];
 $options = [];	 
 $query = new MongoDB\Driver\Query($filter, $options);
 $documents=$m->executeQuery('fitbuddy.detailmakanan', $query);

 foreach($documents as $document){
		    $document = json_decode(json_encode($document),true);
			$kalori1 = $document['total_kal'];
			$karbohidrat1 = $document['total_karb'];
			$protein1 = $document['total_prot'];
			$lemak1 = $document['total_lemak'];

			$kalori +=(int)$kalori1;
			$karbohidrat +=(int)$karbohidrat1;
			$protein +=(int)$protein1;
			$lemak +=(int)$lemak1;

}

//EXERCISE
$cal_burned = 0;
 $m = new MongoDB\Driver\Manager($DB_CONNECTION_STRING);
 $filter=['id_user'=>$id,'tanggal'=>$tanggal];
 $options = [];	 
 $query = new MongoDB\Driver\Query($filter, $options);
 $documents=$m->executeQuery('fitbuddy.detailexercise', $query);

 foreach($documents as $document){
		    $document = json_decode(json_encode($document),true);
			$wow=$document['cal_burned'];
	
			$cal_burned+=(int)$wow;


}

//REMAINING
$remaining = $_SESSION['user_goal'] - $kalori + $cal_burned;

//WEIGHT PREDICTION
$goall = $_SESSION["user_goal"];
$cal_now = $goall - $remaining;
if($cal_now > $goall){
	$sub = $cal_now - $goall;
}else{
	$sub = $goall - $cal_now;	
}
$percent = $sub/$goall;
$selisih = $percent * 0.14;
$selisih = round($selisih,2);

if($remaining != $goall){
	if($remaining < 0){
		$prediction = $_SESSION["user_berat"] + $selisih;
	}else{
		$prediction = $_SESSION["user_berat"] - $selisih;
	}
}else{
	$prediction = $_SESSION["user_berat"];
}
$_SESSION["prediction"] = $prediction;

$arr = array(
            "karbohidrat" => $karbohidrat,
            "kalori" => $kalori,
            "protein" => $protein, 
            "lemak" => $lemak,
            "remaining" => $remaining,
            "cal_burned" => $cal_burned,
            "prediction" => $prediction
       );

echo json_encode($arr);

?>