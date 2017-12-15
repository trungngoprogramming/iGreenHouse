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

if (isset($_REQUEST['time_submit'])) {
	$_SESSION['timer'] = $_REQUEST['hours'];
	$date = date("d-m-Y H:i:s", strtotime($_SESSION['timer']));
	$fan = $_REQUEST['fs'];
	$pump = $_REQUEST['ps'];
	if ($fan == "On") {
		$fs = 1;
	}

	if ($fan == "Off") {
		$fs = 0;
	}

	if ($pump == "On") {
		$ps = 1;
	}

	if ($pump == "Off") {
		$ps = 0;
	}

	$_SESSION['fan'] = $fs;
	$_SESSION['pump'] = $ps;
}

if (isset($_SESSION['hide'])) {
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
}

?>

<?php

if (isset($_REQUEST['delete-log'])) {

	$sql = "DELETE FROM tb_parameterLog";
	$query = mysqli_query($conn, $sql);
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
	<link rel="stylesheet" href="/style/style.css">
	<script type="text/javascript" src="ajax_pagination.php"></script>

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
			<div id="demo" name="demo"></div>
			<div>
				<form class="form-group" method="POST" action="time.php">
					<p><input type="hidden" id="hide" name="hide"></p>
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

					<button class="btn btn-success" style="margin-bottom: 5px" name="time_submit">OK</button>
				</form>
			</div>
		</div>
	</div>


	<div class="container">
		<?php
		$per_page = 10;
		$sql = "SELECT * FROM tb_parameterLog";
		$query = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($query);
		$pages = ceil($count/$per_page)
		?>
		<div id="content_container"></div>
		<div class="pagination">
			<ul id="paginate">
				<?php
				for($i=1; $i<=$pages; $i++)	{
					echo '<li class="pagi" id="'.$i.'">'.$i.'</li>';
				}
				?>
			</ul>
		</div>
	</div>


<form action="time.php" method="post" accept-charset="utf-8">
	<button class="btn btn-danger" name="delete-log">Delete log</button>
</form>


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

		// Set the date we're counting down to
		var timer = "<?= $_SESSION['timer'] ?>";
		var countDownDate = new Date(timer).getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		  // Get todays date and time
		  var now = new Date().getTime();

		  // Find the distance between now an the count down date
		  var distance = countDownDate - now;

		  // Time calculations for days, hours, minutes and seconds
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		  // Display the result in the element with id="demo"
		  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
		  + minutes + "m " + seconds + "s ";

		  // If the count down is finished, write some text
		  if (distance < 0) {
		  	clearInterval(x);
		  	document.getElementById("demo").innerHTML = "Success!";
		  	<?php $_SESSION['hide'] = "hide"; ?>
		  }
		  // if (a == 1) {stop();}
		}, 1000);
	</script>
</body>
</html>
