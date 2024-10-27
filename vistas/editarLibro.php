<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos de la solicitud POST
    $input = json_decode(file_get_contents('php://input'), false);

    // Construimos el objeto "libro" a editar
    
    $titulo = $input->titulo;
    $editorial = $input->editorial;
    $fecha_publicacion = $input->fecha_publicacion;
    $sinopsis = $input->sinopsis;
    $img_libro = $input->$img_libro;
    $mas_informacion = $input->mas_informacion;
    $estado = $input->estado;
    $coleccion = $input->coleccion;
}

include "cabecera.php";
?>

<h5><?php echo $titulo ?></h5>



<?php
include "footer.php";
?>