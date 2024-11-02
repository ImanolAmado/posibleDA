<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
    exit();
}

include_once "../modelos/Log.php";
// Guardamos la pestaña actual y la fecha para nuestro log
$pestana=basename($_SERVER['PHP_SELF']);
$fecha= $fecha = date("Y-m-d");
Log::logConsultaPorPestana($pestana, $fecha);

include "cabecera.php";
?>
<br>
<div class="container-fluid">
<h1 id="titulo"></h1>
<form>
  <div class="form-group">
    <label for="selectColeccion">Colección</label>
    <select class="form-control" id="selectColeccion">
      <option value="si">Si</option>
      <option value="no">No</option>
    </select>
  </div>
  <div class="form-group">
    <label for="selectEstado">Estado</label>
    <select class="form-control" id="selectEstado">
      <option value="leido">Leído</option>
      <option value="leyendo">Leyendo</option>
      <option value="por leer">Por leer</option>
      <option value="wishlist">Wishlist</option>
      <option value="abandonado">Abandonado</option>
    </select>
  </div>
  <div class="form-group">
    <label for="selectPuntuacion">Puntuación</label>
    <select class="form-control" id="selectPuntuacion">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
  </div>
  
  <div class="form-group">
    <label for="textarea">Review:</label>
    <textarea class="form-control" id="textarea" name="textarea" rows="3"></textarea>
  </div>
  <button type="button" id="guardar" name="guardar" class="btn btn-primary">Guardar</button>
  <button type="button" id="cancelar" name="cancelar" class="btn btn-secondary">Cancelar</button>
</form>
</div>
<br>
<script src="js/editarLibro.js"></script>
<?php
include "footer.php";
?>