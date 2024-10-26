<?php
class ConectorBD{
    private $host = 'localhost';
    private $nombreBD = 'libro';
    private $usuario = 'test';
    private $password = 'pass';

    function conectar(){
        try{
            $conexion = new PDO("mysql:host=$this->host;dbname=$this->nombreBD",$this->usuario, $this->password);
            return $conexion;
        }catch (PDOException $e){
            echo 'Error en la conexion '.$e->getMessage();
        }
    }
}

?>