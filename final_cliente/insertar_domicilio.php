<?php
session_start();
if(isset($_SESSION['id'])){
	if (isset($_POST['direccion'])){
		$direccion = $_POST['direccion'];
			if ($direccion == htmlspecialchars($direccion) && $direccion == strip_tags($direccion)) {
				if(is_string($direccion)) {
					include("conectabdlocal.php");
					$consultaPreparada = mysqli_prepare($link, "INSERT INTO domicilio (id_domicilio,id_usuario,direccion) values(?, ?, ?)");
					if ($consultaPreparada) {	
                        $id_usuario = $_SESSION['id'];		
                        $iddomicilio= "";
						mysqli_stmt_bind_param($consultaPreparada, "iis",$iddomicilio, $id_usuario, $direccion);				
                        mysqli_stmt_execute($consultaPreparada);				
					} else {
						die("<pre>".mysqli_error($link).PHP_EOL.$query."</pre>");
					}
					mysqli_close($link);

                    echo "Domicilio guardado!";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=domicilio.php" ); 
                    

				}else {
                    echo "Error en el formato de los campos o falto completar alguno, intente nuevamente";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=domicilio.php" ); 
				} 
			}else {
                echo "Error en sanitizar los campos";
                echo "<br>";
                echo "Redireccionando..";
                header( "refresh:3;url=domicilio.php" ); 
			}
	} else {
        echo "Variables no seteadas";
        echo "<br>";
        echo "Redireccionando..";
        header( "refresh:3;url=domicilio.php" ); 
	}	
} else {
    header("Location: login.php");
    
}			 
?>