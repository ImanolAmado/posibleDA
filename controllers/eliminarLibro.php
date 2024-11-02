<?php
include_once "../modelos/Libro.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST
    $input = json_decode(file_get_contents('php://input'), false);

    // Cogemos las variables que nos interesan
    
    $id_libro = $input->id_libro;    
    $id_usuario = $input->id_usuario;

    Libro::eliminarLibro($id_libro, $id_usuario);

    // Responder   
    echo json_encode("Libro eliminado");   
    
}