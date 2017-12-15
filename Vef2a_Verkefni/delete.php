<?php
require_once("conn.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["courseNumber"])) {//deletar hlutinum sem er selectað
	$result = mysql_query("DELETE FROM Courses WHERE courseNumber=".$_GET["courseNumber"]);
	if(!empty($result)){
		header("Location:Search.php");
	}
}
?>