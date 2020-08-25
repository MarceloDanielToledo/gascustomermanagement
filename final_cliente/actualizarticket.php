<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['tipo'] == 'admin'){
      include("conectabdlocal.php");	
      $idticket=($_GET['no']);
	if (isset($_POST['resolucion'])){
		$resolucion = $_POST['resolucion'];
		$id = $_SESSION['id'];
			if ($resolucion == htmlspecialchars($resolucion) && $resolucion == strip_tags($resolucion)) {
				if(is_string($resolucion) && is_string($resolucion) && is_string($resolucion)) {
                    include("conectabdlocal.php");
                    $resuelto="RESUELTO";
					$consultaPreparada = mysqli_prepare($link, "UPDATE ticket set estado = ?, resolucion = ? where id_ticket = ?");
					if ($consultaPreparada) {			
						mysqli_stmt_bind_param($consultaPreparada, 'ssi', $resuelto, $resolucion, $idticket);
						mysqli_stmt_execute($consultaPreparada);			
					} else {
						die("<pre>".mysqli_error($link).PHP_EOL.$query."</pre>");
					}

                    echo "Se actualizo correctamente";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=homeadmin.php" ); 

				}else {
                    echo "Error en el formato de los campos o falto completar alguno, intente nuevamente";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=homeadmin.php" ); 
				} 
			}else {
                echo "Error en sanitizar los campos";
                echo "<br>";
                echo "Redireccionando..";
                header( "refresh:3;url=homeadmin.php" ); 
			}
	} else {
        echo "Variables no seteadas";
        echo "<br>";
        echo "Redireccionando..";
        header( "refresh:3;url=homeadmin.php" ); 
	}	
} else {
    echo "No tiene permisos para realizar la accion";
    echo "<br>";
    echo "Redireccionando..";
    header( "refresh:3;url=login.php" ); 
}			 
?>
