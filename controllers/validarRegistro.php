<?php
session_start();
include_once "../modelos/Usuario.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){   
    
    $mensajeError="";
    
    $mensajeError="";
    if(empty ($_POST['email']) || empty ($_POST['pass']) || empty ($_POST['nombre']) || empty ($_POST['apellido']) || empty ($_POST['rol'])){

<<<<<<< HEAD
        $mensajeError= "¡Error! Ningún campo del login puede estar vacío";   
=======
        $mensajeError = "¡Error! Ningún campo del login puede estar vacío";   
>>>>>>> d696a27cec7d2a6bff83b1a6fee15540b35035fc
              
    } else {

        if(emailValido($_POST['email'])){
        
            $emailIntroducido =  $_POST['email'];          
       
            $passIntroducido = $_POST['pass'];      
        
            // para hashear contraseñas:
            // https://onlinephp.io/password-hash    

            $resultado = Usuario::loginUsuario($emailIntroducido);

            // Si resultado es null, email no existe en la BBDD
            if($resultado!=null){

                $passwordEncontrado = $resultado['password'];
                $emailEncontrado = $resultado['email'];
                $rolEncontrado = $resultado['rol'];
                $usuarioEncontrado = $resultado['nombre'];
                $apellidoEncontrado = $resultado['apellido'];

        
                if (password_verify($passIntroducido,$passwordEncontrado)){                        
                    $_SESSION['email']=$emailEncontrado;
                    $_SESSION['usuario']=$usuarioEncontrado;
                    $_SESSION['id_usuario']=$idEncontrado;
                    $_SESSION['rol']=$rolEncontrado;
<<<<<<< HEAD
                    $_SESSION['apellido']=$apellidoEncontrado;                    
                    
                    header("Location: ../vistas/paginaUsuario.php");    
                    exit();     
           
                } else $mensajeError= "Lo siento password no coincide";  

            } else $mensajeError= "No existe ese email en la base de datos";
        
        } else $mensajeError= "Formato de email incorrecto";
=======
                    $_SESSION['apellido']=$apellidoEncontrado;

                    header("Location: ../vistas/paginaUsuario.php");    
                    exit();     
           
                } else $mensajeError = "Lo siento password no coincide";  

            } else $mensajeError = "No existe ese email en la base de datos";
        
        } else $mensajeError = "Formato de email incorrecto";
>>>>>>> d696a27cec7d2a6bff83b1a6fee15540b35035fc
    }

    echo $mensajeError;
}
function emailValido($email){
    $email=htmlspecialchars($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    } else {                
        return false;
    }    
}
