<?php
$bulk = new MongoDB\Driver\BulkWrite;

 require_once 'C:\Users\Aheng\vendor\autoload.php';

 $DB_CONNECTION_STRING="mongodb://user:user@127.0.0.1:27017/?authSource=admin&compressors=zlib&readPreference=primary&gssapiServiceName=mongodb&appname=MongoDB%20Compass&ssl=false";
 $doc=[
    'id_detail_exercise' => 0,
   'id_user' => $id,
    'id_exercise' => $exercise,'time' => $amount,'cal_burned' => $kalori,'tanggal' => $tanggal
];
$bulk->insert($doc);
$manager = new MongoDB\Driver\Manager($DB_CONNECTION_STRING);
$result = $manager->executeBulkWrite('fitbuddy.detailexercise', $bulk);


?>