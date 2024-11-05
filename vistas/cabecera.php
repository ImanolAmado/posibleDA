<?php
$paginaActual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">   
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   
    <title>Document</title>
    <style>
        .mb-0 {
            margin-left: 50px !important;
        }

        .nav-link {
            margin-right: 40px !important;
        }
        .active-link {
            background-color: #b0ddfd !important; 
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-md" style="background-color: #e3f2fd;">
                <span class="navbar-brand mb-0 h1 me-5">POSIBLE DA</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#opciones">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- enlaces -->
                <div class="collapse navbar-collapse justify-content-end" id="opciones">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link  <?= $paginaActual == 'home.php' ? 'active-link' : '' ?>" href="home.php">Colección</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $paginaActual == 'vista_buscarLibros.php' ? 'active-link' : '' ?>" href="vista_buscarLibros.php">Añadir libro</a>
                        </li>
                    <!-- Si se loguea un ADMIN, menú diferente -->
                        <?php
                        if($_SESSION['rol']=="admin"){?>
                        <li class="nav-item">
                            <a class="nav-link <?= $paginaActual == 'todosLosUsuarios.php' ? 'active-link' : '' ?>" href="todosLosUsuarios.php">Editar usuario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $paginaActual == 'anadirImagen.php' ? 'active-link' : '' ?>" href="anadirImagen.php">Añadir imagen de perfil</a>
                        </li>
                        <?php } ?>  
                        <!-- Fin MENÚ admin -->
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link" href="../controllers/logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
  
   