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
$delete = $_REQUEST['delete'];

if (isset($delete)) {
	echo '
	<div class="popup">
	<h4 style="color: #e74c3c">Do you want to Delete it?</h4>
	<div class="text-right">
	<a href="dashboard_admin.php" class="btn btn-cancel">Cancel</a>
	<a href="dashboard_admin.php?id='.$delete.'" class="btn btn-danger" name="ok">Ok</a>
	</div>
	</div>';
}

$id = $_REQUEST['id'];
if (isset($id)) {
	$sql = "DELETE FROM tb_account WHERE username = '$id'";
	mysqli_query($conn, $sql);
	header('Location: /view/dashboard_admin.php');
}

$_SESSION['username'] = "y";
?>

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
		<div><a style="color: #3498db;" href="reset_password.php">Reset Password</a></div>
	</div>

	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="margin-left: 30px">
		<table class="table table-success table-inverse	">
			<thead>
				<tr>
					<th>Username</th>
					<th>Password</th>
					<th>Position</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Setting</th>
				</tr>
				<div style="width: 100%; margin: 10px" class="text-right"><button class="btn btn-info" style="width: 70px; height: 40px" onclick="location.href='/view/add_member.php';">Add</button></div>
			</thead>
			<tbody>
				<?php while($row = $query->fetch_array(MYSQLI_ASSOC)): ?>
					<tr>
						<td><?= $id = $row['username'] ?></td>
						<td><?= "*************" ?></td>
						<td><?= $row['level']==1 ? 'admin' : 'manager' ?></td>
						<td><?= $row['email'] ?></td>
						<td><?= $row['phone'] ?></td>
						<td>
							<?php echo '
							<a href="/view/add_member.php?un='.$id.'&edit=y" class="btn btn-success">Edit</a>' ?>
							<?php echo '
							<a href="/view/dashboard_admin.php?delete='.$id.'" class="btn btn-danger">Delete</a>'; ?>
							
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</body>
</html>