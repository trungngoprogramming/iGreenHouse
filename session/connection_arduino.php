<?php
    include("../connection/connection.php");
?>

<?php
    $temp = $_REQUEST["temp"];
    $humi = $_REQUEST["humi"];
    $sql = "INSERT INTO tempLog (temp, humi) VALUES ('$temp', $humi)";
    mysqli_query($conn, $sql);
?>
