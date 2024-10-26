<?php
session_start();
if(isset($_SESSION['email'])){
    header("Location: ../vistas/home.php");
    exit();
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="js/envioLogin.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   
    
    <title>Login</title>
    <style>
        #titulo{
            margin-top: 15px !important;
        }
        #mensajeError { color: red;}
    </style>
</head>
<body>  

<!-- Login -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h2 id="titulo">Bienvenidos a 'Posible da'</h2><br>
            </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <h5 id="titulo">Iniciar sesión</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                <form class="px-4 py-3">
                    <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                    </div>
                    <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>              
                    </div>
                </form>
                <input type="button" id="botonLogin" class="btn btn-primary" value="Login">
                <input type="button" id="botonVolver" class="btn btn-secondary" value="Volver">                
            </div>        
        <div class="row">
            <div class="col-lg-12">
                <h3 id="mensajeError"></h3>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


<?php
include "footer.php";
?>