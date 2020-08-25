<?php
session_start();
include("conectabdlocal.php");
$id_usuario = $_SESSION['id'];
$sql = "SELECT id_consumo,id_usuario,consumo, mes FROM consumo WHERE id_usuario = $id_usuario ORDER BY consumo";
$res = $link->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['mes', 'consumo'],
          <?php
            if(mysqli_num_rows($res)>0){
              while($row = mysqli_fetch_array($res)){
                echo "['".$row['mes']."','".$row['consumo']." kWh'],";
              }
              
            }
          ?>


         // ['2014', 1000],
         // ['2015', 1500],

        ]);

        var options = {
          chart: {
            title: 'Consumo del hogar',
            subtitle: 'Gamuzzi Gas - Consumo del hogar en meses',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

</head>
<body>
<li class="nav-item active">
              <a class="nav-link" href="consumos.php"> Volver a consumos <span class="sr-only"></span></a>
            </li>
<div id="columnchart_material" style="width: 800px; height: 500px;"></div>

</body>
</html>