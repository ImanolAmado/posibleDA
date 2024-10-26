<?php
session_start();
include_once "../modelos/Usuario.php";


if($_SERVER["REQUEST_METHOD"]=="POST"){   
    
    $mensajeError="";
    
    if(empty ($_POST['email']) || empty ($_POST['pass'])){

        $mensajeError="¡Error! Ningún campo del login puede estra vacío";   
              
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
                $idEncontrado = $resultado['id_usuario'];

        
                if (password_verify($passIntroducido,$passwordEncontrado)){                        
                    $_SESSION['email']=$emailEncontrado;
                    $_SESSION['usuario']=$usuarioEncontrado;
                    $_SESSION['id_usuario']=$idEncontrado;
                    $_SESSION['rol']=$rolEncontrado;
                                        
                    header("Location: ../vistas/home.php");    
                    exit();     
           
                } else $mensajeError="¡Error! password incorrecto";  

            } else $mensajeError="¡Error! email no existe";
        
        } else $mensajeError="¡Error! formato de email incorrecto";
    }
    

    // Si el login no ha sido correcto, volvemos al login
    // y sacamos alerta en pantalla     
    echo "<script>let respuesta=window.alert('$mensajeError');
          location.href ='../vistas/home.php';    
    </script>";   
     

}
function emailValido($email){
    $email=htmlspecialchars($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    } else {                
        return false;
    }    
}
