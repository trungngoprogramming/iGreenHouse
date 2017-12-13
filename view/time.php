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

$sql = "SELECT * FROM tb_parameterLog ORDER BY ID DESC";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

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
<body onload="startTime()" id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
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
					<li><a href="control.php">CONTROL</a></li>
					<li><a href="../view/reset_password.php">RESET-PASSWORD</a></li>
					<li><a href="/session/logout_session.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Container (Monitor Section) -->
	<div id="" class="container-fluid bg-grey">
		<!-- <meta http-equiv="refresh" content="2"> -->
		<h2 class="text-center">TIMER</h2>
		<div class="row text-center">
			<div class="col-sm-12" id="txt_date" style="color: #c0392b"></div>
			<div class="col-sm-12" id="txt"></div>
			<div id="demo"></div>
			<div>
				<form class="form-group" method="POST" action="time.php">
					<p>
						<input id="time" type="datetime-local" name="hours">	
					</p>
					<p>
						<label style="margin-right: 14px">Fan</label>
						<?= $_SESSION['fan'] == '1' ?
						'
						<select name="fs">
						<option>On</option>
						<option>Off</option>
						</select>
						'

						:

						'
						<select name="fs">
						<option>Off</option>
						<option>On</option>
						</select>
						'
						?>
					</p>
					
					<p>
						<label>Pump</label>
						<?= $_SESSION['pump'] == '1' ?
						'
						<select name="ps">
						<option>On</option>
						<option>Off</option>
						</select>
						'

						:

						'
						<select name="ps">
						<option>Off</option>
						<option>On</option>
						</select>
						'
						?>
					</p>
					
					<button class="btn btn-success" onclick="getTimer()" style="margin-bottom: 5px" name="time_submit">OK</button>
				</form>
			</div>
		</div>
	</div>
	

	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="margin-left: 30px">
		<table class="table table-success table-inverse">
			<thead>
				<tr>
					<th>Temperature</th>
					<th>Humidity</th>
					<th>Time</th>
				</tr>
			</thead>
			<tbody>
				<?php while($query->fetch_array(MYSQLI_ASSOC)): ?>
					<tr>
						<td><?= $id = $row['temperature'] ?></td>
						<td><?= $id = $row['humidity'] ?></td>
						<td><?= $id = $row['time_stamp'] ?></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>

	<script>
		function startTime() {
			var today = new Date();
			var m = new Date();
			var months = ["Jan","Feb","Mar","Apr","May","Jun"
			,"Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
			var mon = months[(m.getMonth())];
			var day = today.getDate();
			var yrs = today.getFullYear();
			var h = today.getHours();
			var m = today.getMinutes();
			var s = today.getSeconds();
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('txt_date').innerHTML =
			mon + " " + day + ", " + yrs;
			document.getElementById('txt').innerHTML =
			h + ":" + m + ":" + s;
			var t = setTimeout(startTime, 500);
		}
		function checkTime(i) {
		    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		    return i;
		}

		function getTimer(){
			var countDownDate = new Date(document.getElementById('time').value).getTime();
		}

		function Timer(){
			var now = new Date().getTime();
			var distance = countDownDate - now;
			if (distance < 0) {
				document.getElementById('demo').innerHTML = "Hello";
			}
		}

		setInterval(Timer(), 1000);
	</script>
</body>
</html>
