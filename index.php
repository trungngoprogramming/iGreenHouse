<?php
require_once("connection/connection.php");
session_start();
if (isset($_SESSION["username"])) {
  {
    if ($_SESSION['isadmin'] == 0) {
      header('Location: view/dashboard_manager.php');
    }
    else {
      header('Location: view/dashboard_admin.php');
    }
  }
}
?>

<!-- create action login -->
<?php
if (isset($_REQUEST["btn_login"])) {
  $username = $_REQUEST["username"];
  $password = $_REQUEST["password"];

    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
    //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
  $username = strip_tags($username);
  $username = addslashes($username);
  $password = strip_tags($password);
  $password = addslashes($password);

  if ($username == ""){
    echo '<script type="text/javascript">alert("Username cannot empty")</script>';
  }
  elseif ($password == "") {
    echo '<script type="text/javascript">alert("Password cannot empty")</script>';
  }
  else{
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows == 0) {
      echo '<script type="text/javascript">alert("Username or Password is wrong!")</script>';
    }
    else{
      $level = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND level = 0";
      $query = mysqli_query($conn, $level);
      $num_rows = mysqli_num_rows($query);
      if ($num_rows == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['isadmin'] = 1;
        header('Location: /view/dashboard_admin.php');  
      }
      else{
        $_SESSION['username'] = $username;
        $_SESSION['isadmin'] = 0;
        header('Location: /view/dashboard_manager.php');
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>iGreenHouse</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Cabin:700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="style/grayscale.min.css" rel="stylesheet">
  <link rel="icon" href="imgs/leaf.ico"/>

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"> <img src="imgs/leaf.ico" width="30px" height="30px"> iGreenHouse</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#login">LOGIN</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Intro Header -->
  <header class="masthead">
    <div class="intro-body">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h1 class="brand-heading">iGreenHouse</h1>
            <p class="intro-text">Welcome to iGreenHouse</p>
            <a href="#login" class="btn btn-circle js-scroll-trigger">
              <i class="fa fa-angle-double-down animated"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- LOGIN Section -->
  <section id="login" class="content-section text-center">
    <form action="index.php" method="POST">
      <h2>Sign In</h2>
      <p>
        <label for="username" class="floatLabel">Username</label>
        <input id="username" name="username" type="text">
      </p>
      <p>
        <label for="password" class="floatLabel">Password</label>
        <input id="password" name="password" type="password">
      </p>
      <p>
        <input type="submit" value="Login" id="submit" name="btn_login">
      </p>
      <p>
        <a href="../view/forgot_password.php">Forgot Password</a>
      </p>
    </form>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container text-center">
      <p>Develop by Team 12</p>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/grayscale.min.js"></script>

</body>

</html>
