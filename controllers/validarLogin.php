<?php
session_start();
include_once "../modelos/Usuario.php";
include_once "../modelos/Log.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){   
    
    $mensajeError="";   
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['email']) || isset($input['pass'])) {
      
        if(emailValido($input['email'])){   

            $emailIntroducido =  $input['email'];           
            $passIntroducido = $input['pass'];               

            $resultado = Usuario::loginUsuario($emailIntroducido);

            // Si resultado es null, email no existe en la BBDD
            if($resultado!=null){

                $passwordEncontrado = $resultado['password'];
                $emailEncontrado = $resultado['email'];
                $rolEncontrado = $resultado['rol'];
                $usuarioEncontrado = $resultado['nombre'];
                $idEncontrado = $resultado['id_usuario'];
                $userPicEncontrado = $resultado['img_perfil'];
        
                if (password_verify($passIntroducido,$passwordEncontrado)){                        
                    $_SESSION['email']=$emailEncontrado;
                    $_SESSION['usuario']=$usuarioEncontrado;
                    $_SESSION['id_usuario']=$idEncontrado;
                    $_SESSION['rol']=$rolEncontrado;
                    $_SESSION['userPic']=$userPicEncontrado;

                    // En este punto, el acceso es válido por lo que es buen momento para
                    // registrar nuestro log de "últimos accesos".

                    $fecha = date("Y-m-d");

                    Log::logUltimosAccesos($_SESSION['id_usuario'], $fecha);
                                        
                    echo json_encode(["success" => true, "message" => "Login válido"]);
                    exit();
           
                } else $mensajeError="¡Error! password incorrecto";  

            } else $mensajeError="¡Error! email no existe";
        
        } else $mensajeError="¡Error! formato de email incorrecto";
   
    } else $mensajeError = "Ningún campo del login puede estar vacío";    
        
    echo json_encode(["success" => false, "error" => $mensajeError]);
}

function emailValido($email){
    $email=htmlspecialchars($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    } else {                
        return false;
    }    
}
