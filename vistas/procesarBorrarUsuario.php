<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
    exit();
}
include_once "../modelos/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id_usuario = $_POST['id']; 
    $usuario = Usuario::obtenerUsuarioPorId($id_usuario); 
} else {
    header("Location: todosLosUsuarios.php"); 
    exit();
}
include "cabecera.php";
?>            
<br>
<div class="container-fluid">
    <form method="post" >
    <h4>Eliminar usuario</h4><br><br>
    <h5>Nombre: <?php echo htmlspecialchars($usuario->nombre); ?></h5>
    <h5>Email: <?php echo htmlspecialchars($usuario->email); ?></h5>
    <h5>Rol: <?php echo htmlspecialchars($usuario->rol); ?></h5><br>

    <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($usuario->id_usuario); ?>">

    <button class="btn btn-primary"><a href="todosLosUsuarios.php" style="text-decoration: none; color:white">Cancelar</button>
    <button id="eliminarUsuario" class="btn btn-danger">Eliminar</button><br><br>s
    </form>

    </div>
    <script src="js/eliminarUsuario.js"></script>
    <?php

include "footer.php";
?> 