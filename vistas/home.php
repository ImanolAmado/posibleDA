<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.html");
    exit();
}


include "cabecera.php";
?>
 <div class="row">
        <div class="col-lg-12">
             <!-- Color diferente ADMIN -->
             <nav class="navbar navbar-expand-sm"            
            <?php if($_SESSION['rol']=="admin"){?>
                 style="background-color: #0dcaf0;">
                <?php } else {?>
                    style="background-color: #d63384;">
                <?php } ?>   
                <!-- Fin definición colores -->           
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#opciones">
                    <span class="navbar-toggler-icon"></span>
                </button>
                 <!-- enlaces -->
                 <div class="collapse navbar-collapse justify-content" id="opciones">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ms-5">
                            <a class="nav-link" href="#coleccion">Colección</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Lecturas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Leídos</a></li>
                                <li><a class="dropdown-item" href="#">Leyendo</a></li>
                                <li><a class="dropdown-item" href="#">Por leer</a></li>
                                <li><a class="dropdown-item" href="#">Wishlist</a></li>
                                <li><a class="dropdown-item" href="#">Abandonados</a></li>
                                <li><a class="dropdown-item" href="#">Todos</a></li>
                            </ul>
                        </li>                     
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Libros" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
        </div>


<?php include "footer.php";?>