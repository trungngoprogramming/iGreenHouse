<?php 
	include ("../session/check_login_session.php");
	include("../connection/connection.php");
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

	<form action="login.php" method="POST">
		<h2>RESET PASSWORD</h2>
		<p>
			<label for="username" class="floatLabel">Username</label>
			<input id="username" name="username" disabled="disabled" type="text" value= <?php echo $_SESSION['username'] ?>>
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
			<input type="submit" value="Login" id="submit" name="btn_reset">
		</p>
	</form>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script  src="js/index.js"></script>
</body>
</html>