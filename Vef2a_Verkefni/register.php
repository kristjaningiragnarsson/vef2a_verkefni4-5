<?php
	require 'conn.php';

	if(isset($_POST['register'])) {
		$errMsg = '';

		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$userName = $_POST['userName'];
		$userPassword = $_POST['userPassword'];
		$email = $_POST['email'];

		if($firstName == '')
			$errMsg = 'setja inn firstName';
		if($lastName == '')
			$errMsg = 'setja inn lastName';
		if($userName == '')
			$errMsg = 'setja inn userName';
		if($userPassword == '')
			$errMsg = 'setja inn password';
		if($email == '')
			$errMsg = 'setja inn email';
		
		
		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO Students (firstName,lastName , userName, userPassword, email) VALUES (:firstName, :lastName, :userName, :userPassword, :email)');
				$stmt->execute(array(
					':firstName' => $firstName,
					':lastName' => $lastName,
					':userName' => $userName,
					':userPassword' => $userPassword,
					':email' => $email
					));
				header('Location: register.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		$errMsg = 'innskráning er rétt nú geturu skráð þig inn<a href="login.php">skrá inn</a>';
	}
?>

<html>
<head>
<title>skráning</title>
<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css"><!--tengir við main.css-->
</head>

<body>
<header>Upplýsingar um notenda</header>
				<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			<div class="box2">
				<form action="" method="post">
					<p>FirstName</p><input type="text" name="firstName" placeholder="firstName" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName'] ?>" autocomplete="off" class="box"/><br /><br />
					<p>LastName</p><input type="text" name="lastName" placeholder="lastName" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName'] ?>" autocomplete="off" class="box"/><br /><br />
					<p>username</p><input type="text" name="userName" placeholder="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName'] ?>" autocomplete="off" class="box"/><br /><br />
					<p>password</p><input type="userPassword" name="userPassword" placeholder="userPassword" value="<?php if(isset($_POST['userPassword'])) echo $_POST['userPassword'] ?>" class="box" /><br/><br />
					<p>email</p><input type="text" name="email" placeholder="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off" class="box"/><br /><br />
					<input type="submit" name='register' value="Register" class='submit'/><br />
				</form>
				</div>
			<footer>Kristján ingi ragnarsson<a href="#top">Back to top of page</a></footer><!--fer til link top-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="script.js"></script>
</body>
</html>
