<?php
$level = "SELECT level FROM user WHERE username = '$username' AND password = '$password' AND level = 0";
$query = mysqli_query($conn, $level);
$num_rows = mysqli_num_rows($query);
if ($num_rows == 1) {
	$_SESSION['username'] = $username;
	$isadmin = 0;
	header('Location: /view/dashboard_admin.php');	
}
else{
	$_SESSION['username'] = $username;
	$isadmin = 1;
	header('Location: /view/dashboard_manager.php');
}
?>