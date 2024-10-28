<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.html");
    exit();
}

include "cabecera.php";
?>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <!-- Color diferente ADMIN -->
        <nav class="navbar navbar-expand-sm"            
        <?php if($_SESSION['rol']=="admin"){?>
            style="background-color: #0dcaf0;">
        <?php } else {?>
            style="background-color: #d63384;">
        <?php } ?>   
        <!-- Fin definición colores -->  
     
         <!-- enlaces -->
         <div class="d-flex flex-wrap align-items-center justify-content-center">
            <ul class="nav me-auto ms-5">
            <li class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle text-dark" href="#" 
               id="coleccionDropdown" role="button" data-bs-toggle="dropdown" 
               aria-expanded="false">Colección</a>
            <ul class="dropdown-menu p-3" aria-labelledby="coleccionDropdown">
                <label for="miColeccion" class="form-label">Selecciona Colección</label>
                <select id="miColeccion" class="form-select">
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </ul>
        </li>            
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" 
                id="lecturas" role="button" data-bs-toggle="dropdown" 
                aria-expanded="false">Lecturas</a>
                    <ul class="dropdown-menu" aria-labelledby="lecturasDropdown">
                        <li><a class="dropdown-item" href="#">Leídos</a></li>
                        <li><a class="dropdown-item" href="#">Leyendo</a></li>
                        <li><a class="dropdown-item" href="#">Por leer</a></li>
                        <li><a class="dropdown-item" href="#">Wishlist</a></li>
                        <li><a class="dropdown-item" href="#">Abandonados</a></li>
                        <li><a class="dropdown-item" href="#">Todos</a></li>
                    </ul>
                </li>                     
            </ul>
            <!-- Barra de búsqueda -->
            <form class="d-flex ms-auto">
                <input class="form-control me-2" type="search" placeholder="Libros" aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </form>
            </div>
        </div>
    </div>   

<div class="d-flex flex-wrap align-items-center justify-content-center">

<label for="coleccion">Colección</label>
<select class="custom-select" id="coleccion" name="coleccion"> 
  <option value="si">Si</option>
  <option value="no">No</option>
  <option value="todos" selected>Todos</option>
</select>

<label for="estado">Estado</label>
<select class="custom-select" id="estado" name="estado"> 
  <option value="leido">Leídos</option>
  <option value="leyendo">Leyendo</option>
  <option value="por leer">Por leer</option>
  <option value="wishlist">Wishlist</option>
  <option value="abandonado">Abandonados</option>
  <option value="todos" selected>Todos</option>
</select>
<input type="button" id="aplicarFiltro" value="filtrar">
</div>

<div class="container-fluid">
    <div id="tarjeta" class="d-flex flex-wrap justify-content-start ms-5 gap-3">
    <!-- Espacio para pintar nuestra colección de libros -->
    </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/misLibros.js"></script> 
<?php include "footer.php";?>