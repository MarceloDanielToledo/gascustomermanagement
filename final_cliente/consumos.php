<?php
session_start();
if(isset($_SESSION['id'])){
  ?>
  <!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" href="styles.css">
      <title>Camuzzi Gas - Home</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Mis consumos</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="domicilio.php">Mis domicilios <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tickets.php">Tengo un problema</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Cerrar sesión</a>
              </li>
          </ul>
          <span class="navbar-text">
            Camuzzi Gas S.A
          </span>
        </div>
      </nav>
      <?php
  $consumos = [];
  $id_usuario = $_SESSION['id'];
	include("conectabdlocal.php");
	$consultaPreparada = mysqli_prepare($link, "SELECT c.id_consumo,c.id_usuario,c.id_domicilio,dom.direccion,c.consumo,c.mes
  FROM consumo c JOIN domicilio dom ON dom.id_domicilio = c.id_domicilio
  WHERE c.id_usuario = $id_usuario ORDER BY c.mes");	
                    
	if ($consultaPreparada) {
		mysqli_stmt_execute($consultaPreparada);			
		mysqli_stmt_bind_result($consultaPreparada, $id_consumo, $id_usuario,$id_domicilio,$direccion,$consumo,$mes);	
		while (mysqli_stmt_fetch($consultaPreparada)) {
			array_push($consumos, [
				'id_domicilio' => $id_domicilio,
        'id_usuario' => $id_usuario,
        'id_domicilio' => $id_domicilio,
        'direccion' => $direccion,
        'consumo' => $consumo,
        'mes' => $mes,
			]);
		}
		mysqli_close($link);
	} else {
		die("<pre>".mysqli_error($link).PHP_EOL.$query."</pre>");
	}	 
?>
<div class="container">
<h2>Mis consumos registrados </h2><br>
<?php
  if (empty($consumos)){
    echo "No hay consumos registrados por el momento";
  }
	foreach ($consumos as $index => $consumos) {
?>
		<div><b> Dirección: </b> <?php echo $consumos['direccion'] ?></div>
    <div><b> Consumo: </b> <?php echo $consumos['consumo'];echo " kWh"?></div>
    <div><b> Mes: </b> <?php echo $consumos['mes'] ?></div>
    <br>

	
<?php } ?>
<?php  
?>

<div>
<form id="ticket" METHOD="POST" ACTION="grafico.php">
            <div>
                <input type="submit"class="button" name="ingresar" value="Ver grafico de consumos">
            </div>
      </form>

</div>
  
  
  
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
    <footer>
        
    </footer>
  </html>


<?php
}
else {
  header("Location: login.php");
} 
?>