<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/vista_buscarLibros.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>busqueda de libros</title>

<?php include "cabecera.php";?>




   
<!-- clase container -->
<div class="container">
    
    <!-- fila búsqueda -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">           
            <label for="libro">Búsqueda</label>
            <input type="text" id="libro" name="libro" required>
            <input type="button" id="miBoton" value="¡Vamos!"><br><br>
        </div>       
    </div>   

    <div class="row" id="textoResultados">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">   
            <h4>Resultados</h4>
        </div>
    </div><br><br>    
    
    <div id="tarjeta">    
    <!-- Aquí va la tarjeta con el libro -->    
    </div>


</div> <!--Cierre container -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>