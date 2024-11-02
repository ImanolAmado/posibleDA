<?php
include_once "../modelos/Usuario.php";

session_start();

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = json_decode(file_get_contents('php://input'), false);
    $mensaje = "";
    if (isset($id_usuario)) {
        Usuario::eliminarUsuario($id_usuario);
        $mensaje = "Usuario eliminado correctamente";
    } else {
        $mensaje = "No se ha podido eliminar el ususario";
    }
    echo json_encode($mensaje);
}
