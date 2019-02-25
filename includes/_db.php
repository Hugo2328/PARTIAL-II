<?php

$server = "209.59.139.37" ;
$db = "equipop4_desarrolloweb";
$user = "equipop4";
$password = "Proyectounid.2019"; 
$mysqli = new mysqli($server, $user, $password, $db);
if ($mysqli->connect_errno) {
    echo "Lo sentimos, este sitio web está experimentando problemas.";
    echo "Error: Fallo al conectarse a MySQL debido a: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    
    exit;
}
/*
try{

    

	$db = new PDO('mysql:host=209.59.139.37; dbname=equipop4_desarrolloweb', 'equipop4', 'Proyectounid.2019');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $ex) {
    echo "An Error occured!"; 
    some_logging_function($ex->getMessage());
}
*/





 ?>