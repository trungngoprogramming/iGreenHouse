<?php

include("../session/check_login_session.php");
include("../connection/connection.php");

if (isset($_SESSION["username"])) {
	if ($_SESSION['isadmin'] != 1) {
		header('Location: /view/dashboard_manager.php');
	}
}


$sql = "SELECT * FROM tb_account";
$query = mysqli_query($conn, $sql);

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
			<ul class="nav navbar-nav navbar-left top-header col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<li><a style="color: #3fb0ac; float: left;" href="" onclick="return false"><strong>iGreenHouse</strong></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right top-header ">
				<li><a style="color: #95a5a6; float: right;" href="../session/logout_session.php" name="btn-logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 sidenav">
		<div><a style="color: #3498db;" href="">Account</a></div>
		<div><a style="color: #3498db;" href="">Reset Password</a></div>
	</div>

	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="margin-left: 30px">
		
	</div>
</body>
</html>