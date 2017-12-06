<?php

include("../session/check_login_session.php");
include("../connection/connection.php");

if (isset($_SESSION["username"])) {
	if ($_SESSION['isadmin'] != 1) {
		header('Location: /view/dashboard_manager.php');
	}
}


if(isset($_REQUEST['submit'])){
	$username = $_REQUEST['usr'];
	$password = $_REQUEST['pss'];
	$email 	  = $_REQUEST['eml'];
	$phone    = $_REQUEST['phn'];
	$level    = $_REQUEST['lv'] == 'Admin' ? 1 : 0;
	if (isset($_REQUEST['un'])) {
		$username = $_REQUEST['un'];
		$email = $_REQUEST['eml'];
		$phone = $_REQUEST['phn'];
		$level = $_REQUEST['lv'] == 'Admin' ? 1 : 0;
		$numbersOnly = preg_replace("[^0-9]", "", $phone);
		$numberOfDigits = strlen($numbersOnly);
		if ($numberOfDigits == 10 or $numberOfDigits == 11) {
			$sql = "UPDATE tb_account SET email='$email', phone='$phone', is_admin=$level WHERE username='$username'";
			$query = mysqli_query($conn, $sql);
			echo "$sql";
			echo '<script type="text/javascript">alert("Update Member success!")</script>';

		}
		else {
			echo '<script>alert("Invalid Phone Number")</script>';
		}
	}
	else{
		$numbersOnly = preg_replace("[^0-9]", "", $phone);
		$numberOfDigits = strlen($numbersOnly);
		$count = $_SESSION['count'];
		if ($numberOfDigits == 10 or $numberOfDigits == 11) {
			$sql = "SELECT * FROM tb_account WHERE username='$username';";
			$query = mysqli_query($conn, $sql);
			if ($row = mysqli_fetch_array($query)) {
				echo '<script type="text/javascript">alert("Username is Exist!")</script>';
			}
			else{
				$sql = "INSERT INTO tb_account (username, password, email, phone, is_admin) VALUES ('$username', '$password', '$email', '$phone', $level);";
				$query = mysqli_query($conn, $sql);

				if ($query == TRUE) {
					echo '<script type="text/javascript">alert("Create new Member success!")</script>';
				}
			}
		} 

		else {
			echo '<script>alert("Invalid Phone Number")</script>';
		}
	}
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
			<ul class="nav navbar-nav navbar-left top-header col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<li><a style="color: #3fb0ac; float: left;" href="" onclick="return false"><strong>iGreenHouse</strong></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right top-header ">
				<li><a style="color: #95a5a6; float: right;" href="../session/logout_session.php" name="btn-logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 sidenav">
		<div><a style="color: #3498db;" href="dashboard_admin.php">Account</a></div>
		<div><a style="color: #3498db;" href="">Reset Password</a></div>
	</div>

	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="margin-left: 30px">
		<form method="POST">
			<h2><?= $_REQUEST['un'] ? "Edit Account" : "Add Account"?></h2>
			<p class="form-group">
				<label for="usr" class="floatLabel">Username</label>
				<?=
				$_REQUEST['un'] ? "<input type='text' disabled='disabled' id='usr' name='usr' value='{$_REQUEST['un']}'>" : '<input type="text" id="usr" name="usr">'
				?>

			</p>
			<?= $_REQUEST['un'] ? "" :
			'<p class="form-group">
			<label for="pss" class="floatLabel">Password</label>
			<input type="password" id="pss" name="pss">
			</p>'
			?>
			<p class="form-group">
				<label for="eml" class="floatLabel">Email</label>
				<?= $_REQUEST['un'] ? "<input type='email' id='eml' name='eml' value='{$_REQUEST['em']}'>" : '<input type="email" id="eml" name="eml">'?>
			</p>
			<p class="form-group">
				<label for="eml" class="floatLabel">Phone</label>
				<?= $_REQUEST['un'] ? "<input type='text' id='phn' name='phn' value='{$_REQUEST['pn']}'>" : '<input type="text" id="phn" name="phn">' ?>
			</p>
			<p class="form-group">
				<select class="form-control" id="sel1" name="lv">
					<?= $_REQUEST['ad'] == "admin" ? 
					"<option>Admin</option>
					<option>Manager</option>" :
					"<option>Manager</option>
					<option>Admin</option>"
					?>
				</select>
			</p>
			<p class="text-right"><button class="btn btn-info btn-lg" id="submit" name="submit"><?= $_REQUEST['un'] ? "Update" : "Add" ?></button></p>
		</form>
	</div>
</body>
</html>
