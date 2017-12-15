<?php
include("../connection/connection.php");
$per_page = 10;
if(isset($_GET['page'])) {
  $page=$_GET['page'];
}
$start = ($page-1)*$per_page;
$sql = "SELECT * FROM tb_parameterLog ORDER BY ID DESC LIMIT $start,$per_page";
$query_set = mysqli_query($conn, $sql);

?>

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
      <?php
      while($row = mysqli_fetch_array($query_set)): ?>
        <tr>
          <td><?= $id = $row['temperature'] ?></td>
          <td><?= $id = $row['humidity'] ?></td>
          <td><?= $id = $row['time_stamp'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
