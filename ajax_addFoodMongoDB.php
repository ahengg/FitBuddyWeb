<?php
ob_start();
session_start();
include "connect.php";

if(isset ($_POST["amount"]) && isset($_POST["food"]) && isset($_POST['tanggal'])){
    $amount = $_POST["amount"];
    $food = $_POST["food"];
    $tanggal = $_POST["tanggal"];
    
    $q = mysqli_query($db, "SELECT * FROM makanan WHERE id=$food");
   	
   	while($res = mysqli_fetch_assoc($q)){
		    $kalori = $res["kalori"]*$amount;
		    $karbohidrat = $res["karbohidrat"]*$amount;
		    $protein = $res["protein"]*$amount;
		    $lemak = $res["lemak"]*$amount;
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
     $documents=$m->executeQuery('fitbuddy.detailmakanan', $query);
     $cal=array();
     $simp=0;
     foreach($documents as $document){
                $document = json_decode(json_encode($document),true);
                $wow=$document['id_detail_makanan'];
                if($simp<(int)$wow){
                    $simp=(int)$wow;
                }
                
    };
    $simp=$simp+1;
    $simp=(string)$simp;
    
    echo $simp;
    //
     $doc=[
    'id_detail_makanan' => $simp,
       'id_user' => $id,
        'id_makanan' => $food,'jumlah_porsi' => $amount,'total_kal' => $kalori,'total_karb' => $karbohidrat,'total_lemak' => $lemak,'total_prot' => $protein,'tanggal' => $tanggal
    ];
    $bulk->insert($doc);
    $manager = new MongoDB\Driver\Manager($DB_CONNECTION_STRING);
    $result = $manager->executeBulkWrite('fitbuddy.detailmakanan', $bulk);
    
}
else{
    echo "Something went wrong, try again later";
}

?>