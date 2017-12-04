<?php
include("../session/connection_arduino.php");
include("../connection/connection.php");
include("../session/check_login_session.php");
if (isset($_SESSION["username"])) {
	if ($_SESSION['isadmin'] != 0) {
		header('Location: /view/dashboard_admin.php');
	}
}
?>

<?php

if (isset($_REQUEST['submit'])) {
	echo "hello";
	if (isset($_REQUEST['fan'])) {
		$fan = 1;
		echo "aaa";
	}

	if (isset($_REQUEST['pump'])) {
		$pump = 1;
		echo "bbb";
	}

	header("Location: /view/control.php?fan=$fan&pump=$pump");
}

if (isset($_GET['fan'])) {
		echo '
		<div class="popup">
			<h4 style="color: #e74c3c">Customize Setting is Success!</h4>
			<div class="text-right">
				<a href="control.php" class="btn btn-danger" name="ok">Ok</a>
			</div>
		</div>
	';
}

$fan = $_GET["fan"]; 
$fantextfile = "FANstate.txt"; 

$pump = $_GET["pump"];
$pumptextfile = "PUMPstate.txt";

$fileLocation = "$fantextfile";
$fh = fopen($fileLocation, 'w   ') or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
$stringToWrite = "$fan"; // Write either 1 or 0 depending on request from index.php 
fwrite($fh, $stringToWrite); // Writes it to the .txt file 
fclose($fh);

$fileLocation = "$pumptextfile";
$fh = fopen($fileLocation, 'w   ') or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
$stringToWrite = "$pump"; // Write either 1 or 0 depending on request from index.php 
fwrite($fh, $stringToWrite); // Writes it to the .txt file 
fclose($fh); 

$temp = $_REQUEST['temp'];
$humi = $_REQUEST['humi'];
if (isset($_REQUEST['txt_submit'])) {
	header("Location: /view/control.php?temp=$temp&humi=$humi&auto=y");
}

if (isset($_GET['temp'])) {
		echo '
		<div class="popup">
			<h4 style="color: #e74c3c">Auto Setting is Success!</h4>
			<div class="text-right">
				<a href="control.php?auto=y" class="btn btn-danger" name="ok">Ok</a>
			</div>
		</div>
	';
}

$txt_temp = $_GET['temp'];
$temptextfile = "TEMPstate.txt";

$txt_humi = $_GET['humi'];
$humitextfile = "HUMIstate.txt"; 

$fileLocation = "$temptextfile";
$fh = fopen($fileLocation, 'w   ') or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
$stringToWrite = "$temp"; // Write either 1 or 0 depending on request from index.php 
fwrite($fh, $stringToWrite); // Writes it to the .txt file 
fclose($fh);

$fileLocation = "$humitextfile";
$fh = fopen($fileLocation, 'w   ') or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
$stringToWrite = "$humi"; // Write either 1 or 0 depending on request from index.php 
fwrite($fh, $stringToWrite); // Writes it to the .txt file 
fclose($fh);

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
	<link rel="stylesheet" href="/style/toggle_button.css">

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
					<li><a href="dashboard_manager.php">MONITOR</a></li>
					<li><a href="../view/reset_password.php">RESET-PASSWORD</a></li>
					<li><a href="/session/logout_session.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Container (Monitor Section) -->
	<div id="monitor" class="container-fluid bg-grey">
		<meta http-equiv="refresh" content="2">
		<h2 class="text-center">CONTROL</h2>
		<div class="row text-center">
			<div class="col-sm-6">
				<h2 style="background-color: #fff; padding: 2em; color: #e74c3c">Temperator: <?php echo $row["temp"]; $temp ?>&#8451;</h2>
				<!-- <label class="switch">
					<input type="checkbox">
					<span class="slider round"></span>
					<h3 style="margin-top: 40px">FAN</h3>
				</label> -->
			</div>
			<div class="col-sm-6">
				<h2 style="background-color: #fff; padding: 2em; color: #3498db">Humidity: <?php echo $row["humi"]; ?>%</h2>
				<!-- <label class="switch">
					<input type="checkbox">
					<span class="slider round"></span>
					<h3 style="margin-top: 40px">PUMP</h3>
				</label> -->
			</div>
		</div>
	</div>

	<div>
		<div>
			<?=

			!isset($_GET['auto']) ?

			'
			<a href="control.php?auto=y" class="btn btn-lg btn-success">Auto</a>
			'

			:

			'<a href="control.php" class="btn btn-lg btn-success">Customize</a>'

			?>
			
		</div>
		<?= 

		isset($_GET['auto']) ? 
		'
		<form action="control.php" method="POST">
			<div class="row text-center">
				<input type="text" class="btn btn-lg" name="temp" placeholder="Temperature">
				<input type="text" class="btn btn-lg" name="humi" placeholder="Humidity">
				<button name="txt_submit" class="btn btn-lg btn-success">OK</button>
			</div>
		</form>
		'

		:

		'<form action="control.php" method="POST">
			<div class="row text-center">
				<div class="col-sm-6">
					<label class="switch">
						<input type="checkbox" name="fan">
						<span class="slider round"></span>
						<h3 style="margin-top: 40px">FAN</h3>
					</label>
				</div>
				<div class="col-sm-6">
					<label class="switch">
						<input type="checkbox" name="pump">
						<span class="slider round"></span>
						<h3 style="margin-top: 40px">PUMP</h3>
					</label>
				</div>
				<div class="text-center">
					<label class="switch">
						<button class="btn btn-lg btn-success" name="submit">OK</button>
					</label>
				</div>
			</div>
		</form>
		'
		?>
		
	</div>

</body>
</html>
