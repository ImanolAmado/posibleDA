<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .mb-0 {
            margin-left: 50px !important;
        }

        .nav-link {
            margin-right: 40px !important;
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
                            <a class="nav-link" href="#coleccion">Colección</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#reseñas">Mis reseñas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#añadirLibro">Añadir libro</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div><br>
    <div class="row">
        <div class="col lg-4"></div>
        <div class="col lg-4">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Libros" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col lg-4"></div>
    </div><br>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3"><h3>Populares</h3></div>
        <div class="col-lg-8"></div>
    </div>
    
</body>

</html>