<?php
session_start();
include_once "../modelos/Usuario.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input = json_decode(file_get_contents('php://input'), false);

        $mensaje = "";
        if (emailValido($input->email)) {
            if (Usuario::existeEmail($input->email)) {
                $mensaje = "Error email ya existe.";
            } else {
                $resultado = Usuario::registro($input);

                $mensaje = "Actualizado correctamente.";
            }
        }
    }
    echo json_encode($mensaje);


function emailValido($email)
{
    $email = htmlspecialchars($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
