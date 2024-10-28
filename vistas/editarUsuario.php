<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
    exit();
}


include "cabecera.php";
?>
<br>
<div class="container-fluid">
    <h1 id="titulo"></h1>
    <form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="nombre" id="nombre" name="nombre" placeholder="nombre" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group ">
                        <label for="apellido">Apellido: </label>
                        <input type="text" class="apellido" id="apellido" name="apellido" placeholder="apellido" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" class="email" id="email" name="email" aria-describedby="emailHelp" placeholder="example@gmail.com" required>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="password1">Password: </label>
                        <input type="password" class="password" id="pass" name="pass" placeholder="Password" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label for="rol">Rol: </label>
                    <select class="rol" id="rol" name="rol" aria-label="Default select example" required>
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