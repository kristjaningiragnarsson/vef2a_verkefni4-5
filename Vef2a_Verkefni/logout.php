<?php
	require 'conn.php';//sendir þig til baka i index.php og eyðir sessioninu
	session_destroy();

	header('Location: index.php');
?>
