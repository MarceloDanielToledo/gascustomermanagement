<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="validar.js"></script>
    <title>Camuzzi - Registro</title>
</head>
<body>
    
    <div class="containerlogin">
        <div class="login">
            <h1>Registro</h1>
        </div>
        <div class="formulario">
            <form id="cajaformulario" METHOD="POST" ACTION="validar_registro.php">
            <div>
                <input type="text" name="nombre" class="inputnumber" placeholder="Ingrese su Nombre" id="id" required>
            </div>
            <div>
                <input type="text" name="apellido" class="inputnumber" placeholder="Ingrese su Apellido" id="id" required>
            </div>
            <div>
                <input type="number" name="dni" class="inputnumber" placeholder="Ingrese su DNI" id="dni" required>
            </div>
            <div>
                <input type="password" name="pass" class="inputnumber" placeholder="Ingrese su Password" id="pass" required>
            </div>
            <div>
                <input type="password" name="pass2" class="inputnumber" placeholder="Repita su Password" id="pass2" required>
            </div>
            		<!-- Error Text -->
		    <div id="error2">
            <label for=""></label>
            </div>
            <div>
                <img src="captcha.php" width="250" height="50" class="img-polaroid" /><br><br>
            </div>
            <div>
                <input type="text" name="tmptxt" id="tmptxt" class="inputcaptcha" placeholder="Ingrese captcha" required>
            </div>
            <div>
                <input type="submit" class="button" id="botonlogin" name="login" value="Ingresar" onsubmit="return validarFormulario()">
            </div>
            </form>
            
        </div>
    </div>


</body>
</html>