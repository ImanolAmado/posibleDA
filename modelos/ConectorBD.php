<?php    

    class ConectorBD {
    
    private $host='localhost';
    private  $nombreBD = 'libros';
    private $usuario = 'test';
    private $password = 'pass';
       
    
    function conectar(){  
    
        try {
        $conexion = new PDO("mysql:host=$this->host;dbname=$this->nombreBD",$this->usuario,$this->password);
   
        return $conexion;  

        } catch (PDOException $e) {
        echo "Error en la conexión ".$e->getMessage();
        }
    }

}
?>