<?php
ob_start();
session_start();
$bulk = new MongoDB\Driver\BulkWrite;
 $id = $_POST["id"];

 require_once 'C:\Users\Aheng\vendor\autoload.php';
$bulk->delete(['id_detail_exercise' => $id], ['limit' => 0]);
 $DB_CONNECTION_STRING="mongodb://localhost:27017/?readPreference=primary&appname=MongoDB%20Compass&ssl=false";
$manager = new MongoDB\Driver\Manager($DB_CONNECTION_STRING);
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
$result = $manager->executeBulkWrite('fitbuddy.detailexercise', $bulk,$writeConcern);

printf("Deleted  %d document(s)\n", $result->getDeletedCount());

?>