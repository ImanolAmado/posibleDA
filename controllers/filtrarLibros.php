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

    // Construimos el objeto "libro"
    
    $coleccion = $input->coleccion;
    $estado = $input->estado;
    $id_usuario = $_SESSION['id_usuario'];

    $misLibros = Libro::obtenerMisLibrosFiltrados($coleccion, $estado, $id_usuario);

    if($misLibros==null){
    // Responder 
    echo json_encode("No se han encontrado libros");
    }
    else echo json_encode($misLibros);
    
}




