<?php
include_once "../modelos/Usuario.php";
session_start();

if (!isset($_SESSION['email'])) {
    header("Location:login.html");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST
    $actualizarUsuario = json_decode(file_get_contents('php://input'), false);
    $mensaje = "";
    if (!empty($actualizarUsuario->password)) {
        $actualizarUsuario->password = validarPassword($actualizarUsuario->password);
    }

    
    if ($_SESSION['email'] == $actualizarUsuario->email) {
        Usuario::actualizarUsuario($actualizarUsuario, $_SESSION['id_usuario']);
        $mensaje = "Actualizado correctamente.";
    } else {
        if (Usuario::existeEmail($actualizarUsuario->email)) {
            $mensaje = "Error email ya existe.";
        } else {
            Usuario::actualizarUsuario($actualizarUsuario, $_SESSION['id_usuario']);
            $mensaje = "Actualizado correctamente.";
        }
    }

    echo json_encode($mensaje);
}

function validarPassword($password)
{
    $password = strip_tags($password); // Elimina cualquier caracter HTML o PHP
    $password = htmlspecialchars($password); // Ignora los caracteres especiales

    // Hashea la contraseña
    return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
}
