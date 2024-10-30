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
            <?php if ($_SESSION['rol'] == "admin") { ?>
            style="background-color: #0dcaf0; height: 80px;">
        <?php } else { ?>
            style="background-color: #d63384; height: 80px;">
        <?php } ?>
        <!-- Fin definición colores -->
        </nav>
    </div>
</div>
<br>
<div class="container-fluid">
    <h1 id="titulo"></h1>
    <form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="apellido">Apellido: </label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="apellido" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="example@gmail.com" required>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="password1">Password: </label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="password2">Confirmar password: </label>
                        <input type="password" class="form-control" id="confirm-pass" name="confirm-pass" placeholder="confirm-password" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                <label for="rol">Rol: </label>
                    <select class="form-control" id="rol" name="rol" aria-label="Default select example" required>
                        <option value="usuario">Usuario</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <br>
            <button type="button" id="guardar" name="guardar" class="btn btn-primary">Guardar</button>
            <button type="button" id="cancelar" name="cancelar" class="btn btn-secondary">Cancelar</button>
    </form>
</div>
<br>
<script src="js/editarUsuario.js"></script>

<?php
include "footer.php";
?>