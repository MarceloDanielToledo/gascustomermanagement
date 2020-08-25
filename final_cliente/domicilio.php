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
      <title>Camuzzi Gas - Mi domicilio</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" witch>
        <a class="navbar-brand" href="#">Mi domicilio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php"> Home <span class="sr-only">(current)</span></a>
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
  $domicilios = [];
  $id_usuario = $_SESSION['id'];
	include("conectabdlocal.php");
	$consultaPreparada = mysqli_prepare($link, "SELECT id_domicilio, id_usuario, direccion 
										FROM domicilio WHERE id_usuario = $id_usuario");	
	if ($consultaPreparada) {
		mysqli_stmt_execute($consultaPreparada);			
		mysqli_stmt_bind_result($consultaPreparada, $id_domicilio, $id_usuario,$direccion);	
		while (mysqli_stmt_fetch($consultaPreparada)) {
			array_push($domicilios, [
				'id_domicilio' => $id_domicilio,
				'id_usuario' => $id_usuario,
				'direccion' => $direccion,
			]);
		}
		mysqli_close($link);
	} else {
		die("<pre>".mysqli_error($link).PHP_EOL.$query."</pre>");
	}	 
?>
<div class="container">
<h2>Mis domicilios registrados </h2><br>
<?php
  if (empty($domicilios)){
    echo "No hay domicilios registrados por el momento";
  }
	foreach ($domicilios as $index => $domicilios) {
?>

		<div><b> Id_Domicilio: </b> <?php echo $domicilios['id_domicilio'] ?></div>
		<div><b> Dirección: </b> <?php echo $domicilios['direccion'] ?></div>
    <br>

	
<?php } ?>
<?php  
?>
  	</div>
      <div class="container">
      <h2>Registrar domicilio</h2>

      <form id="ticket" METHOD="POST" ACTION="insertar_domicilio.php">
            <div>
                <input type="text" name="direccion" class="inputnumber" placeholder="Ingrese dirección de nuevo domicilio" id="direccion" required>
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