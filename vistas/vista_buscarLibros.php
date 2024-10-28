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
          <!-- fila búsqueda -->
        
            <div class="d-flex align-items-center justify-content-center w-100 p-3">           
                <label for="libro" class="custom-select mx-2">Búsqueda</label>
                <input type="text" class="custom-select mx-2" id="libro" name="libro" required>
                <input type="button" id="miBoton" value="¡vamos!" class="btn btn-primary"><br><br>
            </div>       
       
        </nav>
    </div>
</div>
<br><br>  
<!-- clase container -->
<div class="container">  
    
    <div id="tarjeta">    
    <!-- Aquí va la tarjeta con el libro -->    
    </div>

</div> <!--Cierre container -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../vistas/js/vista_buscarLibros.js"></script>
<?php
include "footer.php";
?>