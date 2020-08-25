<?php
session_start();
if(isset($_SESSION['id'])){
	if (isset($_POST['problema'])){
		$problema = $_POST['problema'];
		$fecha = $_POST['fecha'];
			if ($problema == htmlspecialchars($problema) && $problema == strip_tags($problema) &&
					$fecha == htmlspecialchars($fecha) && $fecha == strip_tags($fecha)) {
				if(is_string($problema) && is_string($fecha)) {
					include("conectabdlocal.php");
					$consultaPreparada = mysqli_prepare($link, "INSERT INTO ticket (id_ticket,id_usuario, problema, estado, fecha,resolucion) values(?, ?, ?, ?, ?,?)");
					if ($consultaPreparada) {	
                        $id_usuario = $_SESSION['id'];		
                        $resolucion = "SIN RESOLVER";
                        $idticket= "";
						mysqli_stmt_bind_param($consultaPreparada, 'iisss',$idticket, $id_usuario, $problema, $resolucion, $fecha,$idticket);				
						mysqli_stmt_execute($consultaPreparada);			
					} else {
						die("<pre>".mysqli_error($link).PHP_EOL.$query."</pre>");
					}
					mysqli_close($link);

                    echo "Ticket guardado!";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=tickets.php" ); 
                    

				}else {
                    echo "Error en el formato de los campos o falto completar alguno, intente nuevamente";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=tickets.php" ); 
				} 
			}else {
                echo "Error en sanitizar los campos";
                echo "<br>";
                echo "Redireccionando..";
                header( "refresh:3;url=tickets.php" ); 
			}
	} else {
        echo "Variables no seteadas";
        echo "<br>";
        echo "Redireccionando..";
        header( "refresh:3;url=tickets.php" ); 
	}	
} else {
    header("Location: login.php");
    
}			 
?>