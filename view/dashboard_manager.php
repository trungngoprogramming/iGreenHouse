<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
	 header('Location: ../view/login.php');
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
					<li><a style="color: #95a5a6; float: right;" href="../session/logout.php" name="btn-logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</div>
			</div>
		</nav>
	</body>
</html>