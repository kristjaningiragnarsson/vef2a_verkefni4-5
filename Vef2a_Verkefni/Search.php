<?php
if(empty($_SESSION['firstName']))//hérna nær hann i firstName fra login siðunni
		header('Location: Search.php');
	require_once("perpage.php");	
	require_once("conn.php");
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	
	$courseNumber = "";
	$courseName = "";
	
	$queryCondition = "";
	if(!empty($_POST["search"])) {
		foreach($_POST["search"] as $k=>$v){
			if(!empty($v)) {

				$queryCases = array("courseNumber","courseName");
				if(in_array($k,$queryCases)) {
					if(!empty($queryCondition)) {
						$queryCondition .= " AND ";
					} else {
						$queryCondition .= " WHERE ";
					}
				}
				switch($k) {
					case "courseNumber":
						$courseNumber = $v;
						$queryCondition .= "courseNumber LIKE '" . $v . "%'";//leitar af courseNumber
						break;
					case "courseName":
						$courseName = $v;
						$queryCondition .= "courseName LIKE '" . $v . "%'";//leitar af coursename
						break;
				}
			}
		}
	}
	$orderby = " ORDER BY courseNumber desc"; // raðar eftir coursenumber
	$sql = "SELECT * FROM Courses " . $queryCondition;//nær í allt
	$href = 'Search.php';					
		
	$perPage = 2; 
	$page = 1;
	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}
	$start = ($page-1)*$perPage;
	if($start < 0) $start = 0;
		
	$query =  $sql . $orderby .  " limit " . $start . "," . $perPage; //fer eftir limitið á perpage functioninu
	$result = $db_handle->runQuery($query);
	
	if(!empty($result)) {
		$result["perpage"] = showperpage($sql, $perPage, $href);
	}
?>
<html>
	<head>
	<title>Search</title>
	<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		
    <div id="toys-grid">      
			<form name="frmSearch" method="post" action="Search.php">
			<div class="search-box">
			<p><input type="text" placeholder="courseNumber" name="search[courseNumber]" class="demoInputBox" value="<?php echo $courseNumber; ?>"	/>
			<input type="text" placeholder="courseName" name="search[courseName]" class="demoInputBox" value="<?php echo $courseName; ?>"	/>
			<input type="submit" name="go" class="btnSearch" value="Search">
			<input type="reset" class="btnSearch" value="Reset" onclick="window.location='Search.php'"></p>
			</div>
			
			<table cellpadding="10" cellspacing="1">
        <thead>
					<tr>
          <th><strong>courseNumber</strong></th>
          <th><strong>courseName</strong></th>          
          <th><strong>courseCredits</strong></th>
					<th><strong>einkunn</strong></th>
					<th><strong>Action</strong></th>
					
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($result as $k=>$v) {
						if(is_numeric($k)) {
					?>
          <tr>
					<td><?php echo $result[$k]["courseNumber"]; ?></td>//echoar allt fra database student
					<?php echo $result[$k]["courseName"]; ?></td>
					<td><?php echo $result[$k]["courseCredits"]; ?></td>
					<td><?php echo $result[$k]["einkunn"]; ?></td>
					
					<td>//herna er delet og edit 
					<a class="btnEditAction" href="edit.php?id=<?php echo $result[$k]["einkunn"]; ?>">Edit</a> <a class="btnDeleteAction" href="delete.php?action=delete&id=<?php echo $result[$k]["einkunn"]; ?>">Delete</a>
					</td>
					</tr>
					<?php
						}
					}
					if(isset($result["perpage"])) {
					?>
					<tr>
					<td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
					</tr>
					<?php } ?>
				<tbody>
			</table>
			</form>	
		</div>
	</body>
</html>
