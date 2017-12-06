<?php
require_once("conn.php");
$db_handle = new DBController();
if(!empty($_GET["courseNumber"])) {
	$result = mysql_query("DELETE FROM Courses WHERE courseNumber=".$_GET["courseNumber"]);
	if(!empty($result)){
		header("Location:index.php");
	}
}
?>