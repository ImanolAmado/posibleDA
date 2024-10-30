<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
    exit();
}

include "cabecera.php";
?>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <!-- Color diferente ADMIN -->
        <nav class="navbar navbar-expand-sm"            
        <?php if($_SESSION['rol']=="admin"){?>
            style="background-color: #0dcaf0; height: 80px;">
        <?php } else {?>
            style="background-color: #d63384; height: 80px;">
        <?php } ?>   
        <!-- Fin definición colores --> 

        <!--Elementos de navbar, los dos select y el botón centrados -->
        <div class="d-flex flex-wrap align-items-center justify-content-center w-100 p-3">
            <label for="coleccion">Colección</label>
            <select class="custom-select mx-2" id="coleccion" name="coleccion"> 
            <option value="si">Si</option>
            <option value="no">No</option>
            <option value="todos" selected>Todos</option>
            </select>

            <label for="estado">Estado</label>
            <select class="custom-select mx-2" id="estado" name="estado"> 
            <option value="leido">Leídos</option>
            <option value="leyendo">Leyendo</option>
            <option value="por leer">Por leer</option>
            <option value="wishlist">Wishlist</option>
            <option value="abandonado">Abandonados</option>
            <option value="todos" selected>Todos</option>
            </select>
            <button type="button" id="aplicarFiltro" class="btn btn-primary">filtrar</button>           
        </div> 
        </nav>
    </div>
</div>   

<!--                Barra de búsqueda
         <div class="d-flex flex-wrap align-items-center justify-content-center">             
            <form class="d-flex ms-auto">
                <input class="form-control me-2" type="search" placeholder="Libros" aria-label="Search">
                <button id="botonBuscar" class="btn btn-outline-secondary" type="button">Buscar</button>
            </form>
         </div>
-->
        

<br><br>
<div class="container-fluid">
    <div id="tarjeta" class="d-flex flex-wrap justify-content-start ms-5 gap-3">
    <!-- Espacio para pintar nuestra colección de libros -->
    </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/misLibros.js"></script> 
<?php include "footer.php";?>