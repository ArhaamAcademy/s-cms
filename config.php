<?php

$dbhost = 'localhost';
$dbname = 'mycms';
$dbuser = 'root';
$dbpass = '';

try {
	$db = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
	echo "Connection error".$e->getMessage();
}

//mysql_connect('localhost','root','') or die('Cannot connect to the server....!');
//mysql_select_db('login_pdo') or die('Database cannot find...!');

?>