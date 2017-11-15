<!-- create action login -->
<?php
require_once("../connection/connection.php");
session_start();
if (isset($_POST["btn_forgot"])) {
	$email = $_POST["email"];
	$sql = "SELECT * FROM user WHERE email='$email'";
	$query = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($query);
	if($num_rows == 0 || $email==" "){
		echo '<script type="text/javascript">alert("Sorry Email is Exist!")</script>';
	}
	else{
		$pass = rand(1000, 10000);
		$to = $email;
		$subject = "Hi!";
		$body = "Hi,\n\nHow are you?";
		$from = "From: iGreenHouse";
		if (mail($to, $subject, $body, $from)) {
			mail($to, $subject, $body, $from);
			echo("<p>Email successfully sent!</p>");
		} else {
			echo("<p>Email delivery failed…</p>");
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
				<li><a style="color: #95a5a6; float: right;" href="/index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			</div>
		</div>
	</nav>

	<form action="forgot_password.php" method="POST">
		<h2>Forgot Password</h2>
		<p>
			<label for="email" class="floatLabel">Email</label>
			<input id="email" name="email" type="email">
		</p>
		<input type="submit" value="Sent" id="submit" name="btn_forgot">
	</p>
	<p>
		<a href="../view/login.php">Login</a>
	</p>

</form>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/index.js"></script>
</body>
</html>
