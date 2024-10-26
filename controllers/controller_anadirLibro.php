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
    
    $id_google = $input->id_google;
    $titulo = $input->titulo;
    $sinopsis = $input->descripcion;       
    $masInfo = $input->masInfo;
    $fecha = $input->fecha;
    $editorial = $input->editorial;  
    $img_libro = $input->imagen;  
    $autores = [];

    for ($i=0; $i<count($input->autores); $i++){
        $autores[$i] = $input->autores[$i];
    }

    $libro = new Libro($titulo,$editorial,$fecha,$sinopsis,$img_libro,$id_google,$masInfo,$autores);
    $mensajes=""; 
        
    
    $id_usuario = $_SESSION['id_usuario'];

    
    // Antes de insertar, debemos comprobar si ya existe en la DB
    if(Libro::existeLibro($id_google)){

      // El libro existe en la BD, comprobamos que el mismo usuario no intenta
      // añadir el mismo libro.
      $mensaje = Libro::existeLibroUsuario($id_google, $id_usuario);  
          
    } else { 

    // Libro no existe, insertar nuevo registro
    Libro::anadirLibro($libro, $id_usuario);
    $mensaje = "Libro insertado correctamente";
    }

    
    // Responder 
      echo json_encode($mensaje);

    } else {
    // Datos inválidos
    http_response_code(400);
    echo json_encode(["error" => "Datos inválidos"]);
    
}    

    
?>
