<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['tipo'] == 'admin'){
      include("conectabdlocal.php");	
      $iddomicilio=($_GET['no']);
	if (isset($_POST['consumo']) && isset($_POST['mes'])){
        $id_usuario = $_POST['id_user'];
        $id_domicilio = $_POST['id_dom'];
        $id_consumo ="";
        $consumo = $_POST['consumo'];
        $mes = $_POST['mes'];
            if  ($consumo == htmlspecialchars($consumo) && $consumo == strip_tags($consumo) &&
                 $mes == htmlspecialchars($mes) && $mes == strip_tags($mes)) {
                if(is_numeric($consumo) && is_numeric($consumo) && is_numeric($consumo) &&
                    is_numeric($mes) && is_numeric($mes) && is_numeric($mes)) {
                    include("conectabdlocal.php");
					$consultaPreparada = mysqli_prepare($link, "INSERT INTO consumo (id_consumo,id_usuario,id_domicilio, consumo, mes) values(?, ?, ?, ?, ?)");
					if ($consultaPreparada) {			
						mysqli_stmt_bind_param($consultaPreparada, 'iiiii', $id_consumo, $id_usuario, $id_domicilio,$consumo,$mes);
						mysqli_stmt_execute($consultaPreparada);			
					} else {
						die("<pre>".mysqli_error($link).PHP_EOL.$query."</pre>");
					}

                    echo "Se actualizo correctamente";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=consumosadmin.php" ); 

				}else {
                    echo "Error en el formato de los campos o falto completar alguno, intente nuevamente";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=consumosadmin.php" ); 
				} 
			}else {
                echo "Error en sanitizar los campos";
                echo "<br>";
                echo "Redireccionando..";
                header( "refresh:3;url=consumosadmin.php" ); 
			}
	} else {
        echo "Variables no seteadas";
        echo "<br>";
        echo "Redireccionando..";
        header( "refresh:3;url=consumosadmin.php" ); 
	}	
} else {
    echo "No tiene permisos para realizar la accion";
    echo "<br>";
    echo "Redireccionando..";
    header( "refresh:3;url=login.php" ); 
}			 
?>
