<?php
include_once "ConectorBD.php";

class Usuario
{
    private $id_libro;
    private $titulo;
    private $editorial;
    private $fecha_publicacion;
    private $sinopsis;
    private $img_libro;
    private $id_google;
    private $mas_informacion;

    function __construct($id_libro, $titulo, $editorial, $fecha_publicacion, $sinopsis, $img_libro, $id_google, $mas_informacion)
    {
        $this->id_libro = $id_libro;
        $this->titulo = $titulo;
        $this->editorial = $editorial;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->sinopsis = $sinopsis;
        $this->img_libro = $img_libro;
        $this->id_google = $id_google;
        $this->mas_informacion = $mas_informacion;
    }

    //Getters y Setters

    function getId_libro()
    {
        return $this->id_libro;
    }
    function gettitulo()
    {
        return $this->titulo;
    }
    function geteditorial()
    {
        return $this->editorial;
    }
    function getFecha_publicacion()
    {
        return $this->fecha_publicacion;
    }
    function getsinopsis()
    {
        return $this->sinopsis;
    }
    function getimg_libro()
    {
        return $this->img_libro;
    }
    function getid_google()
    {
        return $this->id_google;
    }
    function getmas_informacion()
    {
        return $this->mas_informacion;
    }
    function setId_libro($id_libro)
    {
        $this->id_libro = $id_libro;
    }
    function settitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    function seteditorial($editorial)
    {
        $this->editorial = $editorial;
    }
    function setFecha_publicacion($fecha_publicacion)
    {
        $this->fecha_publicacion = $fecha_publicacion;
    }
    function setsinopsis($sinopsis)
    {
        $this->sinopsis = $sinopsis;
    }
    function setimg_libro($img_libro)
    {
        $this->img_libro = $img_libro;
    }
    function setid_google($id_google)
    {
        $this->id_google = $id_google;
    }
    function setmas_informacion($mas_informacion)
    {
        $this->mas_informacion = $mas_informacion;
    }


    ///////// FUNCIONES CRUD //////////////

    // Login de usuario
    static function loginUsuario($sinopsisIntroducido)
    {
        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();
        
        // Consulta SQL login
        $sql = "select id_libro, titulo, sinopsis, img_libro, mas_informacion from usuario where sinopsis = :sinopsis";

        $stmt = $conexion->prepare($sql);

        // vincular parámetros     
        $stmt->bindParam(':sinopsis',  $sinopsisIntroducido);

        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $resultado;
        
    }
}

?>