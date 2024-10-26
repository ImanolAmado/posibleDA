<?php

include_once "ConectorBD.php";
class Libro {   
    private $titulo;
    private $editorial;
    private $fecha_publicacion;
    private $sinopsis;
    private $img_libro;
    private $id_google;
    private $mas_informacion;  
    private $autores;

    function __construct($titulo, $editorial, $fecha_publicacion, 
    $sinopsis, $img_libro, $id_google, $mas_informacion, $autores){      
        $this->titulo = $titulo;
        $this->editorial = $editorial;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->sinopsis = $sinopsis;
        $this->img_libro = $img_libro;
        $this->id_google = $id_google;
        $this->mas_informacion = $mas_informacion;
        $this->autores = $autores;
    }

    // getters y setters   

    function getTitulo(){
        return $this->titulo;
    }

    function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    function getEditorial(){
        return $this->editorial;
    }

    function setEditorial($editorial){
        $this->editorial = $editorial;
    }

    function getFecha_publicacion(){
        return $this->fecha_publicacion;
    }

    function setFecha_publicacion($fecha_publicacion){
        $this->fecha_publicacion = $fecha_publicacion;
    }

    function getSinopsis(){
        return $this->sinopsis;
    }

    function setSinopsis($sinopsis){
        $this->sinopsis = $sinopsis;
    }

    function getImg_libro(){
        return $this->img_libro;
    }

    function setImg_libro($img_libro){
        $this->img_libro = $img_libro;
    }

    function getMas_informacion(){
        return $this->mas_informacion;
    }

    function setMas_informacion($mas_informacion){
        $this->mas_informacion = $mas_informacion;
    }

    function getId_google(){
        return $this->id_google;
    }

    function setId_google($id_google){
        $this->id_google = $id_google;
    }

    function getAutores(){
        return $this->autores;
    }

    function setAutores($autores){
        $this->autores=$autores;
    }


    /////////// FUNCIONES CRUD ///////////

    // Función que añade un libro nuevo a la base de datos.
    // se tiene en cuenta si el autor o autores existen con
    // anterioridad para el insert
    static function anadirLibro(Libro $libro, $id_usuario){
    
     $conectorBD = new ConectorBD();
     $conexion = $conectorBD->conectar();

     // Sentencia SQL para insertar un libro nuevo
     $sql = "insert into libro (titulo, editorial, fecha_publicacion, sinopsis, img_libro, id_google, mas_informacion)".
     " values(:titulo, :editorial, :fecha_publicacion, :sinopsis, :img_libro, :id_google, :mas_informacion)";

     $stmt = $conexion->prepare($sql);
     
     // vincular parámetros     
     $stmt->bindParam(':titulo', $libro->titulo);
     $stmt->bindParam(':editorial', $libro->editorial);
     $stmt->bindParam(':fecha_publicacion', $libro->fecha_publicacion);
     $stmt->bindParam(':sinopsis', $libro->sinopsis);
     $stmt->bindParam(':img_libro', $libro->img_libro);
     $stmt->bindParam(':id_google', $libro->id_google);
     $stmt->bindParam(':mas_informacion', $libro->mas_informacion);
     $stmt->execute();   

        
     // Obtenemos la última 'key' insertada (la del libro)
     // https://www.php.net/manual/en/pdo.lastinsertid.php
     $id_libro = $conexion->lastInsertId();

     // Sentencia SQL para vincular un usuario con su libro
     $sql2 = "insert into usuario_libro (id_usuario, id_libro) values (:id_usuario, :id_libro)";          

     $stmt2 = $conexion->prepare($sql2);
     $stmt2->bindParam(':id_usuario', $id_usuario);
     $stmt2->bindParam(':id_libro', $id_libro);
     $stmt2->execute(); 

    
    // Solo nos quedaría insertar el / los autores
    // Primero necesitamos saber si existen en la tabla de autores.

    // Sentencia SQL para buscar el id de un autor (si existe)
    $sql3 = "select id_autor from autor where nombre_autor=:nombre_autor";

    // Debemos buscar por todo el array de autores
    for ($i=0; $i<count($libro->autores); $i++){

    $id_autor=null;
    $stmt3 = $conexion->prepare($sql3);
    $stmt3->bindParam(':nombre_autor', $libro->autores[$i]);
    $stmt3->execute();     
    
    while($row=$stmt3->fetch(PDO::FETCH_ASSOC)){       
       $id_autor = $row['id_autor'];     
    }

    if($id_autor == null){
        // El autor no existe, hay que insertarlo
        // Sentencia SQL para vincular un usuario con su libro
        $sql4 = "insert into autor (nombre_autor) values (:nombre_autor)";
        $stmt4 = $conexion->prepare($sql4);
        $stmt4->bindParam(':nombre_autor', $libro->autores[$i]);
        $stmt4->execute(); 
        $id_autor = $conexion->lastInsertId();       
    }

    // Ya podemos insertar la relación libro_autor
        $sql5 = "insert into libro_autor (id_libro, id_autor) values (:id_libro, :id_autor)";
        $stmt5 = $conexion->prepare($sql5);
        $stmt5->bindParam(':id_libro', $id_libro);
        $stmt5->bindParam(':id_autor', $id_autor);
        $stmt5->execute();       
    }    

    }


    // Función que comprueba si un libro existe en la base de datos

    static function existeLibro($id_google){

    $conectorBD = new ConectorBD();
    $conexion = $conectorBD->conectar();

    // Sentencia SQL para comprobar si existe un libro en la BD
    $sql = "select id_google from libro where id_google=:id_google";
    $stmt = $conexion->prepare($sql);
    
    // vincular parámetros     
    $stmt->bindParam(':id_google', $id_google);
   
    $stmt->execute();  
    $id=0;
    
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
       
       $id = $row['id_google'];
     
    }
     
    if($id == null){
           return false;
       }else{
           return true;
       }    
   }


   // Función que comprueba si un usuario ya tiene un libro que intenta
   // agregar.

   static function existeLibroUsuario($id_google, $id_usuario){

    $conectorBD = new ConectorBD();
    $conexion = $conectorBD->conectar();

    // Buscamos si ya existe el libro para ese usuario
    $sql = "select id_libro, id_usuario from usuario_libro natural join libro natural join usuario where id_google=:id_google and id_usuario=:id_usuario";
    $stmt = $conexion->prepare($sql);
    
    // vincular parámetros     
    $stmt->bindParam(':id_google', $id_google);
    $stmt->bindParam(':id_usuario', $id_usuario);

    $stmt->execute();  
    $id=null;
    
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
       
       $id = $row['id_usuario'];
            
    }

    // Si el id=null significa que e libro existe 
    // pero el usuario no lo tiene. Lo agregamos.     
    if($id == null){       
        $sql2 = "select id_libro from libro where id_google=:id_google"; 
        $stmt2 = $conexion->prepare($sql2);
        $stmt2->bindParam(':id_google', $id_google);
        $stmt2->execute();
        
        while($row=$stmt2->fetch(PDO::FETCH_ASSOC)){
       
            $id_libro = $row['id_libro'];
          
        }

        // ahora que tenemos el id_libro y el id_usuario
        // insertamos registro en usuario_libro

        $sql3 = "insert into usuario_libro (id_usuario, id_libro) values (:id_usuario, :id_libro)"; 
        $stmt3 = $conexion->prepare($sql3);
        $stmt3->bindParam(':id_libro', $id_libro);
        $stmt3->bindParam(':id_usuario', $id_usuario);
        $stmt3->execute();
        return "Libro insertado correctamente";

    } else return "Ese libro ya está en tu lista";

   }

    static function obtenerimagenLibro(){
    $conectorBD = new ConectorBD();
    $conexion = $conectorBD->conectar();

    $sql = "select titulo, fecha_publicacion, editorial, img_libro from libro";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

}




?>