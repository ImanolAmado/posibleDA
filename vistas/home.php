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
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="coleccion">
  <label class="form-check-label" for="defaultCheck1">
    En mi Colección
  </label>
</div>
<select class="custom-select" id="seleccion">
  <option selected>Selecciona!</option>
  <option value="leidos">Leídos</option>
  <option value="leyendo">Leyendo</option>
  <option value="porLeer">Por leer</option>
  <option value="wishlist">Wishlist</option>
  <option value="abandonados">Abandonados</option>
  <option value="todos">Todos</option>
</select>
<input type="button" id="aplicarFiltro" value="filtrar">
</div>

<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-start ms-5 gap-3">
    <!-- Espacio para pintar nuestra colección de libros -->
    </div>
</div>
<script src="js/misLibros.js"></script> 
<?php include "footer.php";?>