<?php 

include("../session/check_login_session.php");
include("../connection/connection.php");

if (isset($_SESSION["username"])) {
	if ($_SESSION['isadmin'] != 1) {
		header('Location: /view/dashboard_manager.php');
	}
}



 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Add account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Add account</h2>
  <form>
    <div class="form-group">
      <label for="usr">Name:</label>
      <input type="text" class="form-control" id="usr">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd">
      <p></p>
     <div class="form-group">
      <label for="eml">Email:</label>
      <input type="email" class="form-control" id="eml">
      <p></p>
      <button class="btn btn-info" id="submit">Submit</button>
    </div>
  </form>
</div>

</body>
</html>