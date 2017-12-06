<html>
<head>
<title>skrá inn</title>
<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css"><!--tengir við main.css-->
</head>
	
			<body>
				<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
				
				<header>Login</header>
					
				<section>
				<form action="" method="post"> <!--hérna nær hann í username og password og sendir það up til if(isset($_POST['login'])) -->
		<div class="box2">
						<h2>Username</h2>
			
					<p>username</p><input type="text" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName'] ?>" autocomplete="off" class="box"/><br /><br />
		</div>
		<div class="box2">
		
		<h2>password</h2>
			<p>password</p><input type="userPassword" name="userPassword" value="<?php if(isset($_POST['userPassword'])) echo $_POST['userPassword'] ?>" autocomplete="off" class="box" /><br/>
		</div>
		<div class="box2">
		<input type="submit" name='login' value="Login" class='submit'/><br />
		</div>
				</form>
		</section>
				<footer>Kristján ingi ragnarsson<a href="#top">Back to top of page</a></footer><!--fer til link top-->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
		</body>

</html>
<?php
	require 'conn.php';

	if(isset($_POST['login'])) {
		$errMsg = '';

		// nær i upplysingar frá database
		$userName = $_POST['userName'];
		$userPassword = $_POST['userPassword'];
		$encrypt = crypt( $userPassword );//encryptar password
		if($userName == '')//ef það er ekki skrifað rétt kemur error
			$errMsg = 'Enter userName';
		if($userPassword == '')
			$errMsg = 'Enter userPassword';

		if($errMsg == '') {
			try {
				$stmt = $connect->prepare('SELECT studentID, firstName, lastName, userName, userPassword, email FROM Students WHERE userName = :userName');//nær i allt data frá database þar sem username er
				$stmt->execute(array(
					':userName' => $userName
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if($data == false){
					$errMsg = "Notandi $userName er ekki til.";
				}
				else {//hérna skýrir hann hvað dataið frá databasinum í session
					if($userPassword == $data['userPassword']) {
						$_SESSION['firstName'] = $data['firstName'];
						$_SESSION['lastName'] = $data['lastName'];
						$_SESSION['userName'] = $data['userName'];
						$_SESSION['userPassword'] = $data['userPassword'];
						$_SESSION['email'] = $data['email'];
						header('Location: admin.php');//sendir þig til admin siðuna
						exit;
					}
					else
						$errMsg = 'Password not match.';
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
?>