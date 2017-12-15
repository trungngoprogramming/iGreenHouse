<?php
    include("../connection/connection.php");
?>

<?php
    $temp = $_REQUEST["temp"];
    $humi = $_REQUEST["humi"];
    $time = 'localtimestamp()';
    $sql = "INSERT INTO tb_parameterLog (temperature, humidity, time_stamp) VALUES ($temp, $humi, $time)";
    mysqli_query($conn, $sql);
?>
