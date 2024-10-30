<?php
include_once "../modelos/Usuario.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST

    $usuario = Usuario::editarUsuario($_SESSION['id_usuario']);

    if($usuario==null){
        // Responder 
        echo json_encode("No se han encontrado libros");
        }
        else echo json_encode($usuario);

}