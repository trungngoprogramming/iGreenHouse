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

$sql = "SELECT * FROM tb_parameterLog ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<?php

if (isset($_REQUEST['submit'])) {
	$_SESSION['auto'] = 'n';
	if (isset($_REQUEST['fan'])) {
		$_SESSION['fan'] = 1;
		$fan = $_SESSION['fan'];		
	}

	if (!isset($_REQUEST['fan'])) {
		$_SESSION['fan'] = 0;
		$fan = $_SESSION['fan'];		
	}

	if (isset($_REQUEST['pump'])) {
		$_SESSION['pump'] = 1;
		$pump = $_SESSION['pump'];
	}

	if (!isset($_REQUEST['pump'])) {
		$_SESSION['pump'] = 0;
		$pump = $_SESSION['pump'];
	}
}

// $fan = $_SESSION['fan'];
$fantextfile = "FANstate.txt"; 

// $pump = $_SESSION['pump'];
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


if (isset($_REQUEST['txt_submit'])) {
	$_SESSION['auto'] = 'y';
	if (isset($_POST['t']) || isset($_POST['h'])) {
		$_SESSION['temp'] = $_POST['t'];
		$_SESSION['humi'] = $_POST['h'];
	}
}

$temptextfile = "TEMPstate.txt";

$humitextfile = "HUMIstate.txt"; 

$fileLocation = "$temptextfile";
$fh = fopen($fileLocation, 'w   ') or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
$stringToWrite = $_SESSION['temp']; // Write either 1 or 0 depending on request from index.php 
fwrite($fh, $stringToWrite); // Writes it to the .txt file 
fclose($fh);

$fileLocation = "$humitextfile";
$fh = fopen($fileLocation, 'w   ') or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
$stringToWrite = $_SESSION['humi']; // Write either 1 or 0 depending on request from index.php 
fwrite($fh, $stringToWrite); // Writes it to the .txt file 
fclose($fh);
$auto = $_GET['auto'];
if ($auto='y') {
	$autotextfile = "AUTOstate.txt";
	$fileLocation = "$autotextfile";
	$fh = fopen($fileLocation, 'w   ') or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
	$stringToWrite = $_SESSION['auto']; // Write either 1 or 0 depending on request from index.php 
	fwrite($fh, $stringToWrite); // Writes it to the .txt file 
	fclose($fh);
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
		<!-- <meta http-equiv="refresh" content="2"> -->
		<h2 class="text-center">CONTROL</h2>
		<div class="row text-center">
			<div class="col-sm-6">
				<h2 style="background-color: #fff; padding: 2em; color: #e74c3c">Temperator: <?php echo $row["temp"]; $temp ?>&#8451;</h2>
			</div>
			<div class="col-sm-6">
				<h2 style="background-color: #fff; padding: 2em; color: #3498db">Humidity: <?php echo $row["humi"]; ?>%</h2>
			</div>
		</div>
	</div>

	<div>
		<div>
			<?=

			!$_GET['auto'] == 'y' ?

			'
			<a href="control.php?auto=y" class="btn btn-lg btn-success">Auto</a>
			'

			:

			'<a href="control.php" class="btn btn-lg btn-success">Customize</a>'

			?>
			
		</div>

		<?php if ($_GET['auto'] == 'y'): ?>
			<form action="control.php?auto=y" method="POST">
				<div class="row text-center">
					<input type="text" class="btn btn-lg" name="t" placeholder="Temperature">
					<input type="text" class="btn btn-lg" name="h" placeholder="Humidity">
					<button name="txt_submit" class="btn btn-lg btn-success">OK</button>
				</div>
			</form>
		<?php endif ?>

		<?php if (!$_GET['auto'] == 'y'): ?>
			<form action="control.php" method="POST">
				<div class="row text-center">
					<div class="col-sm-6">
						<label class="switch">
							<?=
							$_SESSION['fan'] == 1 ? 
							'<input type="checkbox" name="fan" checked>'
							:
							'<input type="checkbox" name="fan">'
							?>
							<span class="slider round"></span>
							<h3 style="margin-top: 40px">FAN</h3>
						</label>
					</div>
					<div class="col-sm-6">
						<label class="switch">
							<?=
							$_SESSION['pump'] == 1 ? 
							'<input type="checkbox" name="pump" checked>'
							:
							'<input type="checkbox" name="pump">'
							?>
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
		<?php endif ?>
		
	</div>

</body>
</html>
