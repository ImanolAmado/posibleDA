<?php
include_once "ConectorBD.php";

class Usuario
{
    private $id_usuario;
    private $nombre;
    private $apellido;
    private $fecha_nacimiento;
    private $email;
    private $password;
    private $img_perfil;
    private $rol;

    function __construct($id_usuario, $nombre, $apellido, $fecha_nacimiento, $email, $password, $img_perfil, $rol)
    {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->email = $email;
        $this->password = $password;
        $this->img_perfil = $img_perfil;
        $this->rol = $rol;
    }

    //Getters y Setters

    function getId_usuario()
    {
        return $this->id_usuario;
    }
    function getNombre()
    {
        return $this->nombre;
    }
    function getApellido()
    {
        return $this->apellido;
    }
    function getFecha_nacimiento()
    {
        return $this->fecha_nacimiento;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getImg_perfil()
    {
        return $this->img_perfil;
    }
    function getRol()
    {
        return $this->rol;
    }
    function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    function setFecha_nacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    function setEmail($email)
    {
        $this->email = $email;
    }
    function setPassword($password)
    {
        $this->password = $password;
    }
    function setImg_perfil($img_perfil)
    {
        $this->img_perfil = $img_perfil;
    }
    function setRol($rol)
    {
        $this->rol = $rol;
    }


    ///////// FUNCIONES CRUD //////////////

    // Login de usuario
    static function loginUsuario($emailIntroducido)
    {
        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();
        
        // Consulta SQL login
        $sql = "select id_usuario, nombre, email, password, rol from usuario where email = :email";

        $stmt = $conexion->prepare($sql);

        // vincular parámetros     
        $stmt->bindParam(':email',  $emailIntroducido);

        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $resultado;
        
    }
}

?>