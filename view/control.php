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

echo $_SESSION['fan'] . ', ' . $_SESSION['pump'];

if (isset($_REQUEST['submit'])) {
	$_SESSION['auto'] = 'n';
	if (isset($_REQUEST['fan'])) {
		$_SESSION['fan'] = '1';
	}

	if (!isset($_REQUEST['fan'])) {
		$_SESSION['fan'] = '0';
	}

	if (isset($_REQUEST['pump'])) {
		$_SESSION['pump'] = '1';
	}

	if (!isset($_REQUEST['pump'])) {
		$_SESSION['pump'] = '0';
	}
}

$fantextfile = "FANstate.txt";

$pumptextfile = "PUMPstate.txt";

$fileLocation = "$fantextfile";
$fh = fopen($fileLocation, 'w   ') or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
$stringToWrite = $_SESSION['fan']; // Write either 1 or 0 depending on request from index.php
fwrite($fh, $stringToWrite); // Writes it to the .txt file
fclose($fh);

$fileLocation = "$pumptextfile";
$fh = fopen($fileLocation, 'w   ') or die("Something went wrong!"); // Opens up the .txt file for writing and replaces any previous content
$stringToWrite = $_SESSION['pump']; // Write either 1 or 0 depending on request from index.php
fwrite($fh, $stringToWrite); // Writes it to the .txt file
fclose($fh);


if (isset($_REQUEST['txt_submit'])) {
	$_SESSION['auto'] = 'y';
	if (isset($_POST['t']) || isset($_POST['h'])) {
		$_SESSION['temp'] = $_POST['t'];
		$_SESSION['humi'] = $_POST['h'];
	}
}

$t = $_SESSION['temp'];
$h = $_SESSION['humi'];

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
	<script type="text/javascript" src="ajax_pagination.js"></script>

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
					<li><a href="time.php">TIMER</a></li>
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
			<div class="col-sm-6" style="background-color: #fff; padding: 2em; color: #e74c3c">
				<h2 style="color: #c0392b">Temperature</h2><h2 style="color: #e74c3c" id="temp"></h2>
			</div>
			<div class="col-sm-6" style="background-color: #fff; padding: 2em; color: #3498db">
				<h2 style="color: #2980b9">Humidity</h2><h2 id="humi" style="color: #3498db"></h2>
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

			'<a href="control.php" class="btn btn-lg btn-success">Manual</a>'

			?>

		</div>

		<?php if ($_GET['auto'] == 'y'): ?>
			<form action="control.php?auto=y" method="POST">
				<div class="row text-center">
					<p>
						<label class="floatLabel">Temperature</label>
						<input id="username" style="width: 50px" name="t" <?= "value='$t'" ?> type="text">
					</p>

					<p>
						<label class="floatLabel">Humidity</label>
						<input id="username" style="width: 50px; margin-left: 23px" name="h" <?= "value='$h'" ?> type="text">
					</p>

					<p>
						<button name="txt_submit" class="btn btn-lg btn-success">OK</button>
					</p>
				</div>
			</form>
		<?php endif ?>

		<?php if (!$_GET['auto'] == 'y'): ?>
			<form action="control.php" method="POST">
				<div class="row text-center">
					<div class="col-sm-6" style="padding: 1em">
						<label class="switch">
							<?=
							$_SESSION['fan'] == '1' ?
							'<input type="checkbox" name="fan" checked>'
							:
							'<input type="checkbox" name="fan">'
							?>
							<span class="slider round"></span>
						</label>
						<h3>FAN</h3>
					</div>
					<div class="col-sm-6" style="padding: 1em">
						<label class="switch">
							<?=
							$_SESSION['pump'] == '1' ?
							'<input type="checkbox" name="pump" checked>'
							:
							'<input type="checkbox" name="pump">'
							?>
							<span class="slider round"></span>
						</label>
						<h3>PUMP</h3>
					</div>
					<div class="text-center">
						<p>
							<button class="btn btn-lg btn-success" name="submit">OK</button>
						</p>
					</div>
				</div>
			</form>
		<?php endif ?>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function() {
				$.get("api.php?act=getInfo",function(result) {
					if(result.code==500) {
						$("#temp").html("Error");

						$("#humi").html("Error");
					}else {
						$("#temp").html(result.temperature + " &#8451");

						$("#humi").html(result.humidity + " %");
					}
				},"json");
			},500);
		});
	</script>
</body>
</html>
