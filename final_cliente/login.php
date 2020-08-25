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
    <title>Login</title>
</head>
<body>
    
    <div class="containerlogin">

        <div class="login">
            <h1>Login</h1>
        </div>
        <div class="formulario">
            <form id="cajaformulario" METHOD="POST" ACTION="control_login.php">
            <div>
                <input type="number" name="id" class="inputnumber" placeholder="Ingrese su DNI" id="id" required>
            </div>
            <div>
                <input type="password" name="pass" class="inputnumber" placeholder="Ingrese su Password" id="pass" required>
            </div>
            <div>
                <img src="captcha.php" width="250" height="50" class="img-polaroid" /><br><br>
            </div>
            <div>
                <input type="text" name="tmptxt" id="tmptxt" class="inputcaptcha" placeholder="Ingrese captcha" required>
            </div>
            <div>
                <input type="submit"class="button" name="login" value="Ingresar">
            </div>
            </form>
            
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
<footer>
40059111 - 123456 - Daniel <br>
123456789 - admin
<br>
12345678 - 123456 - Leandro
</footer>
</html>