<?php
require_once("../connection/connection.php");
session_start();
if (isset($_SESSION["username"])) {
	{
		if ($_SESSION['isadmin'] == 0) {
			header('Location: ../view/dashboard_manager.php');
		}
		else {
			header('Location: ../view/dashboard_admin.php');
		}
	}
}
?>

<!-- create action login -->
<?php
if (isset($_REQUEST["btn_login"])) {
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];

		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
	$username = strip_tags($username);
	$username = addslashes($username);
	$password = strip_tags($password);
	$password = addslashes($password);

	if ($username == ""){
		echo '<script type="text/javascript">alert("Username cannot empty")</script>';
	}
	elseif ($password == "") {
		echo '<script type="text/javascript">alert("Password cannot empty")</script>';
	}
	else{
		$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
		$query = mysqli_query($conn, $sql);
		$num_rows = mysqli_num_rows($query);
		if ($num_rows == 0) {
			echo '<script type="text/javascript">alert("Username or Password is wrong!")</script>';
		}
		else{
			$level = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND level = 0";
			$query = mysqli_query($conn, $level);
			$num_rows = mysqli_num_rows($query);
			if ($num_rows == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['isadmin'] = 1;
				header('Location: /view/dashboard_admin.php');	
			}
			else{
				$_SESSION['username'] = $username;
				$_SESSION['isadmin'] = 0;
				header('Location: /view/dashboard_manager.php');
			}
		}
	}
}
?>

<html >
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
				<li><a style="color: #95a5a6; float: right;" href="/index.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a></li>
			</div>
		</div>
	</nav>

	<form action="login.php" method="POST">
		<h2>Sign In</h2>
		<p>
			<label for="username" class="floatLabel">Username</label>
			<input id="username" name="username" type="text">
		</p>
		<p>
			<label for="password" class="floatLabel">Password</label>
			<input id="password" name="password" type="password">
		</p>
		<p>
			<input type="submit" value="Login" id="submit" name="btn_login">
		</p>
		<p>
			<a href="../view/forgot_password.php">Forgot Password</a>
		</p>
		
	</form>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script  src="js/index.js"></script>
</body>
</html>
