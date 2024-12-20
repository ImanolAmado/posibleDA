<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: vistas/home.php");
    exit();
}

include_once "modelos/Libro.php";
$librosPopulares = Libro::obtenerimagenLibro();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Posible da</title>
    <style>
        .mb-0 {
            margin-left: 50px !important;
        }

        .nav-link {
            margin-right: 40px !important;
        }

        .navbar {
            border-bottom: 2px solid #007bff;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-sm" style="background-color: #e3f2fd;">
                <span class="navbar-brand mb-0 h1">POSIBLE DA</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#opciones">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- enlaces -->
                <div class="collapse navbar-collapse justify-content-end" id="opciones">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./vistas/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./vistas/registro.php">Registrar</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div><br>

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-4">
            <h4>Nuestros miembros están leyendo...</h4>
        </div>
        <div class="col-lg-7"></div>
    </div><br>
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-start ms-5 gap-3">
            <?php foreach ($librosPopulares as $libro): ?>
                <div class="card mb-5" style="width: 30%; height: 100%;">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <img src="<?= $libro['img_libro'] ?>" class="img-fluid rounded-start" alt="imagen portada">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body d-flex flex-column mt">
                                <h5 class="card-title"><?= htmlspecialchars($libro['titulo']) ?></h5>
                                <h6 class="card-text">Editorial: <?= htmlspecialchars($libro['editorial']) ?></h6>
                                <h6 class="card-text" style="font-weight:400">Fecha edición: <?= htmlspecialchars($libro['fecha_publicacion']) ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
        <br>
    </div>
    <div class="row">    
        <div class="col-lg-12">
            <h3 class="text-center">¿Qué es Posible da?</h3>
        </div>
    <br><br>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <h5 class="text-center">Posible da es un lugar para hacer un seguimiento de tu historia como lector.
                ¿Qué libros has leído?, ¿Cúales te gustaron más y cúales mantienes aún en tu biblioteca personal? 
                 Manten tu lista de libros actualizada y ordenada.. y no olvides añadir a tu lista de deseos 
                aquellos libros que no puedes esperar a leer.</h5>
        </div>
        <div class="col-lg-2"></div>    
    </div>
    <br><br>
    <div class="row">    
        <div class="col-lg-12">
            <h4 class="text-center">¿Comenzamos?</h4>
        </div>
    <br><br>   
    <div class="row"> 
        <div class="col-lg-12">
            <img src="resources/img/portadas2.jpg"
         width="40%" class="rounded mx-auto d-block" alt="collage de portadas de libros">
        </div>
    </div>  
    
    <div class="row">       
        <div class="col-lg-12">
            <h3 class="text-center">¡Registrate ahora!</h3>
        </div>       
    </div>
    <br><br>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <h5 class="text-center">Nuestro servicio es totalmente gratuito, comienza hoy mismo a disfrutar 
                de las ventajas de ser miembro de Posible Da. 
        </div>
        <div class="col-lg-2"></div>        
    </div>
    
    <?php
    include_once "vistas/footer.php";
    ?>