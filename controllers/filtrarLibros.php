<?php
include_once "../modelos/Libro.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.html");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST
    $input = json_decode(file_get_contents('php://input'), false);

    // Construimos el objeto "libro"
    
    $coleccion = $input->coleccion;
    $seleccion = $input->seleccion;

    echo "Coleccion:".$coleccion." seleccion:.$seleccion.";

    
}




