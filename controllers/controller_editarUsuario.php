<?php
include_once "../modelos/Usuario.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.html");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST
    $idusuario = json_decode(file_get_contents('php://input'), false);

    $usuario = Usuario::editarUsuario($idusuario);

    if($usuario==null){
        // Responder 
        echo json_encode("No se han encontrado usuario");
        }
        else echo json_encode($usuario);

}