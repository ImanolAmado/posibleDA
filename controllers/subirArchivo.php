<?php
include_once "../modelos/Usuario.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
    exit();
}


// Se comprueba que el método de envío sea "POST"
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        // Si el campo está definido y no hay errores ('error'===0)...
        if(isset($_FILES['archivo']) && $_FILES['archivo']['error']===0){

            // Cogemos los datos del objeto $_FILES
            $nombre = $_FILES['archivo']['name'];
            $tipo = $_FILES['archivo']['type'];
            $tamanio = $_FILES['archivo']['size'];
            $rutaTemporal = $_FILES['archivo']['tmp_name'];

            // Variables con nuestros requerimientos
            $tiposPermitidos=['image/jpeg'];
            $tamanioPermitido=2097152;

            // Si el tamaño del archivo es menor que el permitido...
            if($tamanio<=$tamanioPermitido){

                // Si el archivo es jpg...                
                if(in_array($tipo, $tiposPermitidos)){

                    // Para construir el nombre del archivo, necesitamos
                    // llamar a la base de datos. El nombre será "pic + numero de foto"

                    $numeroFoto = Usuario::cogerPics(); 
                    $numero = count($numeroFoto) + 1;
                    
                    // Concatenamos ruta y nombre
                    $destino="../resources/img/userPics/pic".$numero.".jpg";

                    // Subimos archivo
                    if(move_uploaded_file($rutaTemporal, $destino)){

                    // llamada a la base de datos para guadar el nuevo pic
                        Usuario::guadarPic($destino);
                    
                        // mensaje de todo ok
                        echo "El archivo se ha subido correctamente";

                    } else echo "Se ha producido un error al subir archivo";

                } else echo "¡Error! El tipo de archivo no es correcto";
            } else echo"¡Error! El archivo supera el tamaño máximo";

        } else  echo "¡Error, campo vacío o error desconocido!";
    }
