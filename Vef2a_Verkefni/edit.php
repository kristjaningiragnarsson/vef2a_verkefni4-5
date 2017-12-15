<?php
require_once("conn.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["submit"])) {//updetar einkunn
	$result = mysql_query("UPDATE Courses set courseNumber = '".$_POST["courseNumber"]."', courseName = '".$_POST["courseName"]."', courseCredits= '".$_POST["courseCredits"]."', einkunn = '".$_POST["einkunn"]."' WHERE  id=".$_GET["id"]);
	if(!$result){
		$message = "Problem in Editing! Please Retry!";
	} else {
		header("Location:Search.php");
	}
}
//nær i coursenumber
$result = $db_handle->runQuery("SELECT * FROM Courses WHERE courseNumber='" . $_GET["courseNumber"] . "'");
?>
<link href="style.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function validate() {//fullt af litum fyrir backgroundið
	var valid = true;	
	$(".demoInputBox").css('background-color','');
	$(".info").html('');
	
	if(!$("#courseNumber").val()) {
		$("#courseNumber-info").html("(required)");
		$("#courseNumber").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#courseName").val()) {
		$("#courseName-info").html("(required)");
		$("#courseName").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#courseCredits").val()) {
		$("#courseCredits-info").html("(required)");
		$("#courseCredits").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#einkunn").val()) {
		$("#einkunn-info").html("(required)");
		$("#einkunn").css('background-color','#FFFFDF');
		valid = false;
	}	
	
	}	
	return valid;//hér fyrir neðan skrifar hann allt infoið
}
</script>
<form name="frmToy" method="post" action="" id="frmToy" onClick="return validate();"
<div id="mail-status"></div>
<div>
<label style="padding-top:20px;">courseNumber</label>
<span id="courseNumber-info" class="info"></span><br/>
<input type="text" name="courseNumber" id="courseNumber" class="demoInputBox" value="<?php echo $result[0]["courseNumber"]; ?>">
</div>
<div>
<label>courseName</label>
<span id="courseName-info" class="info"></span><br/>
<input type="text" name="courseName" id="courseName" class="demoInputBox" value="<?php echo $result[0]["courseName"]; ?>">
</div>
<div>
<label>courseCredits</label> 
<span id="courseCredits-info" class="info"></span><br/>
<input type="text" name="courseCredits" id="courseCredits" class="demoInputBox" value="<?php echo $result[0]["courseCredits"]; ?>">
</div>
<div>
<label>einkunn</label> 
<span id="einkunn-info" class="info"></span><br/>
<input type="text" name="einkunn" id="einkunn" class="demoInputBox" value="<?php echo $result[0]["einkunn"]; ?>">
</div>
<div>
<input type="submit" name="submit" id="btnAddAction" value="Save" />
</div>
</div>
