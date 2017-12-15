<?php
require_once("../connection/connection.php");
session_start();
if (!isset($_SESSION["username"])) {
  return;
}

$get = $_GET['act'];

if ($get =="getInfo") {
  $sql = "SELECT * FROM tb_parameterLog ORDER BY ID DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  if ($row != null ) {
    echo json_encode($row);
  }else {
    echo json_encode(array("code" =>500,"message"=>"Error"));
  }
}

?>
