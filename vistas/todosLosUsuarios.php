<?php
session_start();

include_once "../modelos/ConectorBD.php";
include_once "../modelos/Usuario.php";

if (!isset($_SESSION['email'])) {
    header("Location:login.php");
    exit();
}

if ($_SESSION['rol'] !="admin"){
    header("Location:home.php");
    exit();
}




include "cabecera.php";

?>

<div class="container-fluid">
    <br>
        <div class="row">
            <div class="col-lg-12">
                <h2>Editar usuario</h2>
            </div>
        </div>
    <br>

    <!-- Tabla bootstrap -->
    <table class="table">
        <thead>
            <tr>
            <tr>
                <th scope="col" style="width:5%">Id</th>
                <th scope="col" style="width:15%">Rol</th>
                <th scope="col" style="width:15%">Nombre</th>
                <th scope="col" style="width:15%">Apellido</th>
                <th scope="col" style="width:15%">Email</th>
                <th scope="col" style="width:3%">Acciones</th>
                <th scope="col" style="width:3%"></th>
            </tr>
            </tr>
        </thead>
        <tbody>
            <?php
            // Se van creando las celdas en cada iteracción
            $conectorBD = new ConectorBD();
            $conexion = $conectorBD->conectar();
            $listaUsuarios = Usuario::todosLosUsuarios();
            foreach ($listaUsuarios as $usuario) { ?>
                <tr>
                    <td scope="row"><?php echo $usuario->getId_usuario(); ?></td>
                    <td><?php echo $usuario->getRol(); ?></td>
                    <td><?php echo $usuario->getNombre(); ?></td>
                    <td><?php echo $usuario->getApellido(); ?></td>
                    <td><?php echo $usuario->getEmail(); ?></td>                    
                    <td>
                        <form id="f1" method="post" action="procesarBorrarUsuario.php">
                            <input type="hidden" id="id" name="id" value="<?php echo $usuario->getId_usuario(); ?>">
                            <input type="hidden" id="rol" name="rol" value="<?php echo $usuario->getRol(); ?>">
                            <input type="hidden" id="nombre" name="nombre" value="<?php echo $usuario->getNombre(); ?>">
                            <input type="hidden" id="apellido" name="apellido" value="<?php echo $usuario->getapellido(); ?>">
                            <input type="hidden" id="email" name="email" value="<?php echo $usuario->getEmail(); ?>">
                            <input type="hidden" id="password" name="password" value="<?php echo $usuario->getPassword() ?>">
                            <button type="submit"><img src="../resources/img/bin.png" width="20px" height="20px" alt="Foto eliminar"></button>
                        </form>
                    </td>
                    <td>
                        <form id="f2" method="post" action="../vistas/editarUsuario.php">
                            <input type="hidden" id="id" name="id" value="<?php echo $usuario->getId_usuario(); ?>">
                            <input type="hidden" id="rol" name="rol" value="<?php echo $usuario->getRol(); ?>">
                            <input type="hidden" id="nombre" name="nombre" value="<?php echo $usuario->getNombre(); ?>">
                            <input type="hidden" id="apellido" name="apellido" value="<?php echo $usuario->getapellido(); ?>">
                            <input type="hidden" id="email" name="email" value="<?php echo $usuario->getEmail(); ?>">
                            <input type="hidden" id="password" name="password" value="<?php echo $usuario->getPassword() ?>">
                            <button type="submit"><img src="../resources/img/editar.png" width="20px" height="20px" alt="Foto editar"></button>
                        </form>
                    </td>
                </tr>
                <tr>
                <?php }
                ?>
        </tbody>
    </table>
</div>


<?php
include "footer.php";
?>