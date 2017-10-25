<?php
include("../session/check_login_session.php");
if (isset($_SESSION["username"])) {
	if ($_SESSION['isadmin'] != 0) {
		header('Location: /view/dashboard_admin.php');
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>iGreenHouse</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/style/dashboard_manager.css">

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="#myPage">iGreenHouse</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#monitor">MONITOR</a></li>
					<li><a href="#contact">CONTACT</a></li>
					<li><a href="../view/reset_password.php">RESET-PASSWORD</a></li>
					<li><a href="/session/logout_session.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Container (Monitor Section) -->
	<div id="monitor" class="container-fluid bg-grey">
		<h2 class="text-center">MONITOR</h2>
		<div class="row text-center">
		    <div class="col-sm-6">
		        <h2 style="background-color: #fff; padding: 2em; color: #e74c3c">Temperator: <?php echo $temp ?>&#8451;</h2>
		    </div>
		    <div class="col-sm-6">
		        <h2 style="background-color: #fff; padding: 2em; color: #3498db">Humidity: <?php echo $humi ?>%</h2>
		    </div>
		</div>
	</div>	

	<!-- Container (Contact Section) -->
	<div id="contact" class="container-fluid bg-grey">
		<h2 class="text-center">CONTACT</h2>
		<div class="row">
			<div class="col-sm-5">
				<p>Contact us and we'll get back to you within 24 hours.</p>
				<p><span class="glyphicon glyphicon-map-marker"></span> DaNang, VietNam</p>
				<p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p>
				<p><span class="glyphicon glyphicon-envelope"></span> igreenhouse.customercare@gmail.com</p>
			</div>
			<div class="col-sm-7 slideanim">
				<div class="row">
					<div class="col-sm-6 form-group">
						<input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
					</div>
					<div class="col-sm-6 form-group">
						<input class="form-control" id="email" disabled="disabled" name="email" placeholder="Email" type="email" required>
					</div>
				</div>
				<textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
				<div class="row">
					<div class="col-sm-12 form-group">
						<input class="btn btn-default pull-right" type="submit" name="Submit" value="Sent"></input>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
