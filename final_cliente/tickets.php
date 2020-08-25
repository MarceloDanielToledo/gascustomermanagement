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
      <title>Camuzzi Gas - Tickets</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" witch>
        <a class="navbar-brand" href="#">Tengo un problema</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php"> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="domicilio.php">Mis domicilios <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="consumos.php">Mis Consumos</a>
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
  $tickets = [];
  $id_usuario = $_SESSION['id'];
	include("conectabdlocal.php");
	$consultaPreparada = mysqli_prepare($link, "SELECT id_ticket, id_usuario, problema, 
										estado, fecha,resolucion FROM ticket WHERE id_usuario = $id_usuario");	
	if ($consultaPreparada) {
		mysqli_stmt_execute($consultaPreparada);			
		mysqli_stmt_bind_result($consultaPreparada, $id_ticket, $id_usuario, $problema, $estado, 
			$fecha,$resolucion);	
		while (mysqli_stmt_fetch($consultaPreparada)) {
			array_push($tickets, [
				'id_ticket' => $id_ticket,
				'id_usuario' => $id_usuario,
				'problema' => $problema,
				'estado' => $estado,
        'fecha' => $fecha,
        'resolucion' => $resolucion,
			]);
		}
		mysqli_close($link);
	} else {
		die("<pre>".mysqli_error($link).PHP_EOL.$query."</pre>");
	}	 
?>
<div class="container">
<h2>Mis problemas reportados </h2><br>
<?php
  if (empty($tickets)){
    echo "No hay tickets registrados por el momento";
  }
	foreach ($tickets as $index => $tickets) {
?>

		<div><b> Id_Ticket: </b> <?php echo $tickets['id_ticket'] ?></div>
		<div><b> Descripción falla: </b> <?php echo $tickets['problema'] ?></div>
		<div><b> Estado de ticket: </b> <?php echo $tickets['estado'] ?> </div>
		<div><b> Fecha: </b> <?php echo $tickets['fecha'] ?> </div>
    <div><b> Resolucion: </b> <?php echo $tickets['resolucion'] ?> </div>
    <br>

	
<?php } ?>
<?php  
?>
  	</div>
      <div class="container">
      <h2>Registrar problema</h2>

      <form id="ticket" METHOD="POST" ACTION="insertar_ticket.php">
      <div>
                <input type="text" name="problema" class="inputnumber" placeholder="Ingrese descripción de problema" id="problema" required>
            </div>
            <div>
                <input type="date" name="fecha" class="inputnumber" placeholder="Ingrese fecha del problema" id="fecha" required>
            </div>
            <div>
                <input type="submit"class="button" name="ingresar" value="Ingresar">
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