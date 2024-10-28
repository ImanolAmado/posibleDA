<?php
include_once "../modelos/Libro.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.html");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST
    $id_libro = json_decode(file_get_contents('php://input'), false);

    $libro = Libro::editarLibro($id_libro, $_SESSION['id_usuario']);

    if($libro==null){
        // Responder 
        echo json_encode("No se han encontrado libros");
        }
        else echo json_encode($libro);

}