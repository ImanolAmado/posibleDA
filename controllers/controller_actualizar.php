<?php
include_once "../modelos/Libro.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST
    $actualizarLibro = json_decode(file_get_contents('php://input'), false);

    Libro::actualizarLibro($actualizarLibro, $_SESSION['id_usuario']);
  
        
    echo json_encode("Actualizado correctamente.");    

}