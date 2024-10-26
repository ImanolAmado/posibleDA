<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
    exit();
}


include "cabecera.php";
?>



<?php
include "footer.php";
?>