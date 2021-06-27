<?php 
if(isset ($_POST["dataQty"]) && isset($_POST["dataHarga"])){
	$dataQty = $_POST["dataQty"];
	$dataHarga = $_POST["dataHarga"];
	$return=$dataHarga* $dataQty;
	
	//var_dump($return);

	echo $return;

}
else if($_POST["dataQty"]==NULL){

 echo 0;
}
?>