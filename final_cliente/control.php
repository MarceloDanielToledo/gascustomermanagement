<?php
session_start();

if (isset($_POST['id']) && $_POST['tmptxt'] == $_SESSION['tmptxt'])
{
        $id=$_POST['id'];
        $url="http://localhost/Parcial2_servidor/public/usuario/$id";
        $data=json_decode(file_get_contents("$url"), true );
        $_SESSION['id']=$id;
        $_SESSION['nombre'] = $data["nombre"];
        $_SESSION['apellido'] = $data["apellido"];
        $_SESSION['dni'] = $data["dni"];
    //header("Location: home.php");
    echo $data["dni"];
    echo $data["nombre"];

}else
{
    echo "if 1";
    //header("Location: login.php");
}
 