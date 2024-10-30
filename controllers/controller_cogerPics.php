<?php
include_once "../modelos/Usuario.php";
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.html");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {   

    $userPics = Usuario::cogerPics();          
    echo json_encode($userPics);    

}