<?php

class Usuario {
    //ATRIBUTOS
    private $id; 
    private $personal_usuario;
    private $nombre_usuario;
    private $apellido_usuario;
    private $email_usuario;  
    private $password_usuario;
    private $telefono_usuario; 
    private $dni_usuario; 

    public function __construct($id, $personal_usuario, $nombre_usuario,$apellido_usuario, $email_usuario,$password_usuario,$telefono_usuario,$dni_usuario) {
        $this->id = $id; //1º id referencia a atr, 2º a contructor
        $this->personal_usuario = $personal_usuario;
        $this->nombre_usuario = $nombre_usuario;
        $this->apellido_usuario = $apellido_usuario;       
        $this->email_usuario = $email_usuario;
        $this->password_usuario = $password_usuario;       
        $this->telefono_usuario = $telefono_usuario;  
        $this->dni_usuario = $dni_usuario;        
        
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of personal_usuario
     */ 
    public function getPersonal_usuario()
    {
        return $this->personal_usuario;
    }

    /**
     * Set the value of personal_usuario
     *
     * @return  self
     */ 
    public function setPersonal_usuario($personal_usuario)
    {
        $this->personal_usuario = $personal_usuario;

        return $this;
    }

    /**
     * Get the value of nombre_usuario
     */ 
    public function getNombre_usuario()
    {
        return $this->nombre_usuario;
    }

    /**
     * Set the value of nombre_usuario
     *
     * @return  self
     */ 
    public function setNombre_usuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;

        return $this;
    }

    /**
     * Get the value of apellido_usuario
     */ 
    public function getApellido_usuario()
    {
        return $this->apellido_usuario;
    }

    /**
     * Set the value of apellido_usuario
     *
     * @return  self
     */ 
    public function setApellido_usuario($apellido_usuario)
    {
        $this->apellido_usuario = $apellido_usuario;

        return $this;
    }

    /**
     * Get the value of email_usuario
     */ 
    public function getEmail_usuario()
    {
        return $this->email_usuario;
    }

    /**
     * Set the value of email_usuario
     *
     * @return  self
     */ 
    public function setEmail_usuario($email_usuario)
    {
        $this->email_usuario = $email_usuario;

        return $this;
    }

    /**
     * Get the value of password_usuario
     */ 
    public function getPassword_usuario()
    {
        return $this->password_usuario;
    }

    /**
     * Set the value of password_usuario
     *
     * @return  self
     */ 
    public function setPassword_usuario($password_usuario)
    {
        $this->password_usuario = $password_usuario;

        return $this;
    }

    /**
     * Get the value of telefono_usuario
     */ 
    public function getTelefono_usuario()
    {
        return $this->telefono_usuario;
    }

    /**
     * Set the value of telefono_usuario
     *
     * @return  self
     */ 
    public function setTelefono_usuario($telefono_usuario)
    {
        $this->telefono_usuario = $telefono_usuario;

        return $this;
    }

    /**
     * Get the value of dni_usuario
     */ 
    public function getDni_usuario()
    {
        return $this->dni_usuario;
    }

    /**
     * Set the value of dni_usuario
     *
     * @return  self
     */ 
    public function setDni_usuario($dni_usuario)
    {
        $this->dni_usuario = $dni_usuario;

        return $this;
    }


    public static function getTipoUsuario($correo){
        include "conexion.php";
        $sql="SELECT * FROM tbl_usuarios WHERE `email_usuario`='$correo'";
        $listaUsuarios = mysqli_query($conexion, $sql);        
        return $listaUsuarios->fetch_all(MYSQLI_ASSOC);  
    }
    public static function getUsuariosCam($nombre = ''){
        
        //require_once "../controller/config.php";
        include "conexion.php";//conexion con la bd
        if(empty($nombre)){
            $where=''; 
         }else{
            $where="and nombre_usuario like '".$nombre."%' "; 
         }
        //Parte alumno
        $sql="SELECT * FROM tbl_usuarios where personal_usuario = 'camarero' $where";

        $listaUsuarios = mysqli_query($conexion, $sql);        
        return $listaUsuarios->fetch_all(MYSQLI_ASSOC); 
    }
     public static function getUsuariosMan(){
        
        //require_once "../controller/config.php";
        include "conexion.php";//conexion con la bd
        //Parte alumno
        $sql="SELECT * FROM tbl_usuarios where personal_usuario = 'mantenimiento'";

        $listaUsuarios = mysqli_query($conexion, $sql);        
        return $listaUsuarios->fetch_all(MYSQLI_ASSOC); 
    }
    public static function crearUsuario($tipo,$nombre,$apellido,$correo,$pass,$tel,$dni){
        require_once "conexion.php";
        $sql="INSERT INTO tbl_usuarios (personal_usuario,nombre_usuario,apellido_usuario,email_usuario,password_usuario,telefono_usuario,dni_usuario) VALUES (?,?,?,?,?,?,?);";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $tipo);
        $consulta->bindParam(2, $nombre);
        $consulta->bindParam(3, $apellido);
        $consulta->bindParam(4, $correo);
        $consulta->bindParam(5, $pass);
        $consulta->bindParam(6, $tel);
        $consulta->bindParam(7, $dni);
        $consulta->execute();
    }
    public static function editarUsuario($idp,$tipo,$nombre,$apellido,$correo,$pass,$tel,$dni){
        require_once "conexion.php";
        if ($pass != ''){
            $consulta = $pdo->prepare("UPDATE `tbl_usuarios` SET `personal_usuario` = :tipo, `nombre_usuario` = :nombre, `apellido_usuario` = :ape, `email_usuario` = :email, `password_usuario` = :pass, `telefono_usuario` = :telf, `dni_usuario` = :dni WHERE `tbl_usuarios`.`id` = :id ");
            $consulta->bindParam(':id', $idp);
            $consulta->bindParam(':tipo', $tipo);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':ape', $apellido);
            $consulta->bindParam(':email', $correo);
            $consulta->bindParam(':pass', $pass);
            $consulta->bindParam(':telf', $tel);
            $consulta->bindParam(':dni', $dni);
            $consulta->execute();
        }else{
            $consulta = $pdo->prepare("UPDATE `tbl_usuarios` SET `personal_usuario` = :tipo, `nombre_usuario` = :nombre, `apellido_usuario` = :ape, `email_usuario` = :email, `telefono_usuario` = :telf, `dni_usuario` = :dni WHERE `tbl_usuarios`.`id` = :id ");
            $consulta->bindParam(':id', $idp);
            $consulta->bindParam(':tipo', $tipo);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':ape', $apellido);
            $consulta->bindParam(':email', $correo);
            $consulta->bindParam(':telf', $tel);
            $consulta->bindParam(':dni', $dni);
            $consulta->execute();
        }
        
    }
    public static function eliminarUsuario($id){
        require_once "conexion.php";
        $consulta = $pdo->prepare("DELETE FROM tbl_usuarios WHERE id = :id");
        $consulta->bindParam(':id', $id);
        $consulta->execute();
    }
}