<?php
require_once("../connection/connection.php");
if (isset($_REQUEST['btn_reset'])) {
	$username = $_REQUEST['username'];
	$old_password = $_REQUEST['old-password'];
	$password = $_REQUEST['new-password'];
	$confirm = $_REQUEST['confirm-password'];
	$username = strip_tags($username);
	$username = addslashes($username);
	$password = strip_tags($password);
	$password = addslashes($password);
	if ($username == ""){
		echo '<script type="text/javascript">alert("Username cannot empty")</script>';
	}
	elseif ($old_password == "") {
		echo '<script type="text/javascript">alert("Old Password cannot empty")</script>';
	}

	elseif ($password == "") {
		echo '<script type="text/javascript">alert("Password cannot empty")</script>';
	}

	elseif ($confirm == "") {
		echo '<script type="text/javascript">alert("Confirm Password cannot empty")</script>';
	}
	else{
		$sql = "SELECT * FROM tb_account WHERE username = '$username' AND password='$old_password'";
		$query = mysqli_query($conn, $sql);
		$num_rows = mysqli_num_rows($query);
		if ($num_rows == 0) {
			echo '<script type="text/javascript">alert("Username is not Exist or Old Password is Wro!")</script>';
		}
		else{
			if ($password == $confirm) {
				$sql = "UPDATE tb_account SET password='$password' WHERE username='$username'";
				$query = mysqli_query($conn, $sql);
					echo '<script type="text/javascript">alert("Reset Password is Success")</script>';
			}
			else{
				echo '<script type="text/javascript">alert("New Password and Confirm Password is not the same")</script>';
			}
		}
	}
}
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>iGreenHouse</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/style/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/style/custom.css">  
</head>

<body>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="nav navbar-nav navbar-right top-header">
				<li><a style="color: #95a5a6; float: right;" href="/view/dashboard_manager.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			</div>
		</div>
	</nav>

	<form action="reset_password.php" method="POST">
		<h2>RESET PASSWORD</h2>
		<p>
			<label for="username" class="floatLabel">Username</label>
			<input id="username" name="username" type="text">
		</p>
		<p>
			<label for="password" class="floatLabel">Old Password</label>
			<input id="password" name="old-password" type="password">
		</p>
		<p>
			<label for="password" class="floatLabel">New Password</label>
			<input id="password" name="new-password" type="password">
		</p>
		<p>
			<label for="password" class="floatLabel">Confirm Password</label>
			<input id="password" name="confirm-password" type="password">
		</p>
		<p>
			<input type="submit" value="RESET" id="submit" name="btn_reset">
		</p>
	</form>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script  src="js/index.js"></script>
</body>
</html>