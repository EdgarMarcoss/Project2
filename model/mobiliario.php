<?php
// $sala=$_POST['sala'];
// echo $sala;
class Mobiliario {
    //ATRIBUTOS
    private $id; 
    private $numero_mobiliario;
    private $tipo_mobiliario;
    private $id_sala;
    private $estado_mobiliario;
    

    public function __construct() {
   
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
     * Get the value of numero_mobiliario
     */ 
    public function getNumero_mobiliario()
    {
        return $this->numero_mobiliario;
    }

    /**
     * Set the value of numero_mobiliario
     *
     * @return  self
     */ 
    public function setNumero_mobiliario($numero_mobiliario)
    {
        $this->numero_mobiliario = $numero_mobiliario;

        return $this;
    }

    /**
     * Get the value of tipo_mobiliario
     */ 
    public function getTipo_mobiliario()
    {
        return $this->tipo_mobiliario;
    }

    /**
     * Set the value of tipo_mobiliario
     *
     * @return  self
     */ 
    public function setTipo_mobiliario($tipo_mobiliario)
    {
        $this->tipo_mobiliario = $tipo_mobiliario;

        return $this;
    }

    /**
     * Get the value of id_sala
     */ 
    public function getId_sala()
    {
        return $this->id_sala;
    }

    /**
     * Set the value of id_sala
     *
     * @return  self
     */ 
    public function setId_sala($id_sala)
    {
        $this->id_sala = $id_sala;

        return $this;
    }

    /**
     * Get the value of estado_mobiliario
     */ 
    public function getEstado_mobiliario()
    {
        return $this->estado_mobiliario;
    }

    /**
     * Set the value of estado_mobiliario
     *
     * @return  self
     */ 
    public function setEstado_mobiliario($estado_mobiliario)
    {
        $this->estado_mobiliario = $estado_mobiliario;

        return $this;
    }

    public static function getMobiliario($dates){  

        include 'conexion.php';
        $hora = $dates[1];
        $sala = $dates[0];
        $where = "and m.id NOT IN ( SELECT id_mobiliario from tbl_reserva where fecha_reserva = '$hora' );";
        $sql="SELECT m.id,m.numero_mobiliario, m.img_mobiliario, m.estado_mobiliario FROM tbl_mobiliario m INNER JOIN tbl_salas s ON m.id_sala=s.id where id_sala=$sala $where";  
        $listaMobiliario = mysqli_query($conexion, $sql);         
        return $listaMobiliario->fetch_all(MYSQLI_ASSOC);
        
    }

    public static function getMobiliarioEst(){  

        include 'conexion.php';
        $sql="SELECT s.nombre_sala,id_mobiliario,count(m.id) as `Mid`,m.numero_mobiliario,m.id_sala FROM tbl_mobiliario m INNER JOIN tbl_reserva r ON m.id=r.id_mobiliario INNER JOIN tbl_salas s ON s.id=m.id_sala  Group by id_mobiliario,id_sala";  
        $listaMobiliario2 = mysqli_query($conexion, $sql);         
        return $listaMobiliario2->fetch_all(MYSQLI_ASSOC);

    }

    public static function crearMobiliario($numero,$capacidad,$sala){
        require_once "conexion.php";
        $result = $pdo->prepare("SELECT * FROM `tbl_salas` WHERE `nombre_sala` = ?");
        $result->bindParam(1, $sala);
        $result->execute();
        $resultado = $result->fetch(PDO::FETCH_ASSOC);


        $sql="INSERT INTO `tbl_mobiliario` (`numero_mobiliario`, `tipo_mobiliario`, `estado_mobiliario`, `capacidad_mesa`, `img_mobiliario`, `id_sala`) VALUES (?,'mesa','libre',?,'mesa4.png',?);";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $numero);
        $consulta->bindParam(2, $capacidad);
        $consulta->bindParam(3, $resultado['id']);
        $consulta->execute();
    }

    public static function editarMobiliario($id,$numero,$capacidad,$sala){
        require_once "conexion.php";
        $result = $pdo->prepare("SELECT * FROM `tbl_salas` WHERE `nombre_sala` = ?");
        $result->bindParam(1, $sala);
        $result->execute();
        $resultado = $result->fetch(PDO::FETCH_ASSOC);


        $sql="UPDATE `tbl_mobiliario` SET `numero_mobiliario` = ?, `capacidad_mesa` = ?, `id_sala` = ? WHERE `tbl_mobiliario`.`id` = ?;";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $numero);
        $consulta->bindParam(2, $capacidad);
        $consulta->bindParam(3, $resultado['id']);
        $consulta->bindParam(4, $id);
        $consulta->execute();
    }

    public static function eliminarMobiliario($id){
        require_once "conexion.php";
        $consulta = $pdo->prepare("DELETE FROM tbl_mobiliario WHERE id = :id");
        $consulta->bindParam(':id', $id);
        $consulta->execute();
    }
   
}