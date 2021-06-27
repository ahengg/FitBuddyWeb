<?php
    global $db; 
    $db = mysqli_connect("127.0.0.1","root","","proyek"); 
    
    if(!$db){ 
        die("ERROR: Could not connect. ").mysqli_connect_error();
    }
?>