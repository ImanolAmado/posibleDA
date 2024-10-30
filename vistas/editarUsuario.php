<?php
session_start();

if (!isset($_SESSION['email'])) {
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
        </nav>
    </div>
</div>


<?php
include "footer.php";
?>