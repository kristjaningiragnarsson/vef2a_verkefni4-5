<?php
session_start();

// skrifar hvað database er
define('dbhost', '127.0.0.1');
define('dbuser', 'root');
define('dbpass', 'XX.visor.XX23');
define('dbname', 'ProgressTracker_V2');

// tengir við database
try {
	$connect = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

?>
