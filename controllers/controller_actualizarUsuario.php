<?php
include_once "../modelos/Usuario.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.html");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST
    $actualizarLibro = json_decode(file_get_contents('php://input'), false);

    Usuario::actualizarUsuario($actualizarLibro, $_SESSION['id_usuario']);
  
        
    echo json_encode("Actualizado correctamente.");    

}