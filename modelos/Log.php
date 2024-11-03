<?php

include_once "ConectorBD.php";
class Log {   
    private $fecha;
    private $id_usuario;
    private $pestana;
   

    function __construct($fecha, $id_usuario, $pestana){      
        $this->fecha = $fecha;
        $this->id_usuario = $id_usuario;
        $this->pestana = $pestana;       
    }

    // getters y setters   

    function getFecha(){
        return $this->fecha;
    }

    function setFecha($fecha){
        $this->fecha = $fecha;
    }

    function getId_usuario(){
        return $this->id_usuario;
    }

    function setId_usuario($id_usuario){
        $this->id_usuario=$id_usuario;
    }

    function getPestana(){
        return $this->pestana;
    }

    function setPestana($pestana){
        $this->pestana=$pestana;
    }


    ///////////// FUNCIONES /////////////////


    static function logUltimosAccesos($id_usuario, $fecha){

    $conectorBD = new ConectorBD();
    $conexion = $conectorBD->conectar();

    // Sentencia SQL para insertar log
    $sql = "insert into log.log (id_usuario, fecha) values (:id_usuario, :fecha)";

    $stmt = $conexion->prepare($sql);
     
     // vincular parámetros     
     $stmt->bindParam(':id_usuario', $id_usuario);
     $stmt->bindParam(':fecha', $fecha);     
     $stmt->execute();   

    }

    static function logConsultaPorPestana($pestana, $fecha){

        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();
    
        // Sentencia SQL para insertar log
        $sql = "insert into log.log (pestana, fecha) values (:pestana, :fecha)";
    
        $stmt = $conexion->prepare($sql);
         
         // vincular parámetros     
         $stmt->bindParam(':pestana', $pestana);
         $stmt->bindParam(':fecha', $fecha);     
         $stmt->execute();   
    
        }

}


