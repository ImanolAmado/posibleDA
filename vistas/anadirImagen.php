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
        <div class="ms-5"> <!-- imagen perfil usuario -->
            <img src="<?php echo $_SESSION['userPic'];?>" height="60px" alt="imagen usuario">
        </div>
         <!-- Input para subir imágenes -->
        <div class="d-flex flex-wrap align-items-center justify-content-center w-100 p-3">             
            <button type="button" id="addPic" class="btn btn-primary custom-select mx-2">añadir</button>
            <input type="file" id="imagen" name="imagen">         
        </div>
        </nav>
    </div>
</div>
<br><br>

<div class="container" class="container-fluid">  
    
    <div id="tarjeta" class="d-flex flex-wrap justify-content-start ms-5 gap-3">    
    <!-- Aquí va la tarjeta con las fotos de usuario -->    
    </div>

</div> <!--Cierre container -->


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/anadirUserPic.js"></script>
<?php
include "footer.php";
?>