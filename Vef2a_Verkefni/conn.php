<?php
session_start();

// Define database
define('dbhost', '127.0.0.1');
define('dbuser', 'root');
define('dbpass', 'XX.visor.XX23');
define('dbname', 'ProgressTracker_V2');

// Connecting database
try {
	$connect = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

?>
