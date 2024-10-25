<?php
session_start();
if(isset($_SESSION['email'])){
   header("Location:login.php");
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
                <span class="navbar-brand mb-0 h1"><a href="../index.html">POSIBLE DA</a></span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#opciones">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- enlaces -->
                <div class="collapse navbar-collapse justify-content-end" id="opciones">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div><br>
    <form method="post" action="../controllers/validarRegistro.php">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="apellido" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="email" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="password1">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de nacimiento</label><br>
                        <input type="date" id="fecha" name="fecha" required><br>
                    </div>
                </div>
                <div class="col-lg-2">
                    <label for="rol">Rol</label><br>
                    <select class="form-select" id="rol" name="rol" aria-label="Default select example" required>
                        <option selected value="usuario">Usuario</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>