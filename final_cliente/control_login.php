<?php
session_start();

# Validaciones de seguridad para todo ingreso
if (isset($_POST['login'])) {	
    if ($_POST['tmptxt'] == $_SESSION['tmptxt']){
		if (isset($_POST['id']) && isset($_POST['pass'])) {
			$user = $_POST['id'];
            $pass = $_POST['pass'];
            // Protección para SQL INJECTION
			if ($user == htmlspecialchars($user) && 
				$user == strip_tags($user) &&
				$pass == htmlspecialchars($pass) &&
				$pass == strip_tags($pass)) {
				
				include("conectabd.php");
				// Consultas preparadas en SQLI
				$consulta_preparada = mysqli_prepare($link, "SELECT idusuario,nombre,apellido,dni,pass FROM usuario WHERE dni = ?");				
				mysqli_stmt_bind_param($consulta_preparada, 's', $user);				
				mysqli_stmt_execute($consulta_preparada);				
				$res = $consulta_preparada->get_result();				
				$row = $res->fetch_assoc();

				# Si password que ingresamos en el formulario
				# coincide con el hash que tiene el password de la base de datos
				if ($row>0 && password_verify($pass,$row['pass'])) {
                    // REST
                    $id=$row['idusuario'];
                    $url="http://localhost/Parcial2_servidor/public/usuario/$id";
                    $data=json_decode(file_get_contents("$url"), true );
                    $_SESSION['id']=$id;
                    $_SESSION['nombre'] = $data["nombre"];
                    $_SESSION['apellido'] = $data["apellido"];
                    $_SESSION['dni'] = $data["dni"];
                    $_SESSION['tipo'] = $data["tipo"];
                    if($_SESSION['tipo']=="admin"){
                        header("Location: homeadmin.php");
                    }
                    else{
                        header("Location: home.php");
                    }
                    
				} else {
                    // WRONG PASS
                    echo "Datos incorrectos!";
                    echo "<br>";
                    echo "Redireccionando..";
                    header( "refresh:3;url=login.php" ); 
				        }
			} else {
                // Posible sql injection
                echo "Datos ingresados no validos!";
                echo "<br>";
                echo "Redireccionando..";
                header( "refresh:3;url=login.php" ); 

			}
		} else {
            echo "No se ingreso DNI y Contraseña!";
            echo "<br>";
            echo "Redireccionando..";
            header( "refresh:3;url=login.php" ); 
        } 
        }
        else{
            echo "Captcha incorrecto!";
            echo "<br>";
            echo "Redireccionando..";
            header( "refresh:3;url=login.php" ); 
        }
} 

else {
    header("Location: login.php");
}


?>