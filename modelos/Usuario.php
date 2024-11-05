<?php
include_once "ConectorBD.php";

class Usuario
{
    private $id_usuario;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $img_perfil;
    private $rol;

    function __construct($id_usuario, $nombre, $apellido, $email, $password, $img_perfil, $rol)
    {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
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
        $sql = "select id_usuario, nombre, email, password, rol, img_perfil from usuario where email = :email";

        $stmt = $conexion->prepare($sql);

        // vincular parámetros     
        $stmt->bindParam(':email',  $emailIntroducido);

        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $resultado;
        
    }

    static function editarUsuario($id_usuario){
        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();    
        
        // Consulta SQL login
        $sql = "select id_usuario, nombre, apellido, email, password, rol from usuario where id_usuario = :id_usuario";

        $stmt = $conexion->prepare($sql);

        // vincular parámetros     
        $stmt->bindParam(':id_usuario',  $id_usuario);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    static function actualizarUsuario($usuario, $id_usuario){
        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();

        $nombre = $usuario->nombre;
        $apellido = $usuario->apellido;
        $email = $usuario->email;
        $password = $usuario->password; 
        $rol = $usuario->rol;

        // Update de la tabla usuario_libro
        $sql = "update usuario set nombre=:nombre, apellido=:apellido, email=:email, password=:password, rol=:rol where id_usuario=:id_usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();   
    }

    static function existeEmail($emailNuevo){
        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();

        $sql = "select email from usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['email'] === $emailNuevo) {
                return true;
            }
        }return false;

    }

    static function registro($usuarioNuevo){
        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();
        $nombre = $usuarioNuevo->nombre;
        $apellido = $usuarioNuevo->apellido;
        $email = $usuarioNuevo->email;
        $password = password_hash($usuarioNuevo->pass, PASSWORD_DEFAULT); 
        $rol = $usuarioNuevo->rol;
        $pic = $usuarioNuevo->pic;

        $sql = "insert into usuario (nombre, apellido, email, password, img_perfil, rol) 
        values(:nombre, :apellido, :email, :password, :pic, :rol)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':pic', $pic);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    static function cogerPics(){
        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();

        $sql = "select id_imagen, user_pic from imagen_usuario";
        $stmt = $conexion->prepare($sql);        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function guadarPic($ruta){
        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();

        $sql = "insert into imagen_usuario (user_pic) values (:user_pic)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':user_pic', $ruta);
        $stmt->execute();
    }

    static function todosLosUsuarios()
    {
        $conectorBD = new ConectorBD();
        $conexion = $conectorBD->conectar();

        // Consulta SQL todos los discos de un usuario concreto
        $sql = "select * from usuario";

        $stmt = $conexion->prepare($sql);

        $stmt->execute();
        $listaUsuarios = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $usuario = new Usuario(               

                $id_usuario = $row['id_usuario'],
                $nombre = $row['nombre'],
                $apellido = $row['apellido'],
                $email = $row['email'],
                $password = $row['password'],
                $img_perfil = $row['img_perfil'],
                $rol = $row['rol'],

            );

            array_push($listaUsuarios, $usuario);
        }

        return $listaUsuarios;
    }

    static function obtenerUsuarioPorId($id_usuario) {
        $conexion = new ConectorBD();
        $conexion = $conexion->conectar();

        $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario"; 
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ); 
    }

    static function eliminarUsuario($id_usuario){
        $conexion = new ConectorBD();
        $conexion = $conexion->conectar();

        // Sentencia SQL para eliminar un usuario
        $sql = "delete from usuario where id_usuario=:id_usuario";

        $stmt = $conexion->prepare($sql);

        // vincular parámetros     
        $stmt->bindParam(':id_usuario', $id_usuario);

        $stmt->execute();
    }
}

?>