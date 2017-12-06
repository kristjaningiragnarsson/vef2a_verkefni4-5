<?php//admin siðan
	require 'conn.php';
	if(empty($_SESSION['firstName']))//hérna nær hann i firstName fra login siðunni
		header('Location: login.php');
?>

<html>
<head>
<title>notendasiða</title>
<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css"><!--tengir við main.css-->
</head>
<body>
<header>velkominn <?php echo $_SESSION['firstName']; ?> <br> <!-- hérna kemur nafn af notanda og svo linkar--></header>
		
		
		
		<section>
		<div class="box2">
				<h2>update</h2>
			<p>
				<a href="Search.php">Leita</a> <br>
			</p>
		</div>
		<div class="box2">
		
		<h2>skrá út</h2>
			<a href="logout.php">skrá út</a>
		</div>
		
		</section>
		<footer>Kristján ingi ragnarsson <a href="#top">Back to top of page</a></footer><!--fer til link top-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
</body>
</html>
