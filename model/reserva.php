<?php

class Reserva {
    //ATRIBUTOS
    private $id; 
    private $fecha_reserva;
    private $fecha_desocupacion;
    private $id_usuario;
    private $id_mobiliario;   

    public function __construct($id, $fecha_reserva, $fecha_desocupacion,$id_usuario, $id_mobiliario) {
        $this->id = $id; //1º id referencia a atr, 2º a contructor
        $this->fecha_reserva = $fecha_reserva;
        $this->fecha_desocupacion = $fecha_desocupacion;
        $this->id_usuario = $id_usuario;       
        $this->id_mobiliario = $id_mobiliario;      
        
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
     * Get the value of fecha_reserva
     */ 
    public function getFecha_reserva()
    {
        return $this->fecha_reserva;
    }

    /**
     * Set the value of fecha_reserva
     *
     * @return  self
     */ 
    public function setFecha_reserva($fecha_reserva)
    {
        $this->fecha_reserva = $fecha_reserva;

        return $this;
    }

    /**
     * Get the value of fecha_desocupacion
     */ 
    public function getFecha_desocupacion()
    {
        return $this->fecha_desocupacion;
    }

    /**
     * Set the value of fecha_desocupacion
     *
     * @return  self
     */ 
    public function setFecha_desocupacion($fecha_desocupacion)
    {
        $this->fecha_desocupacion = $fecha_desocupacion;

        return $this;
    }

    /**
     * Get the value of id_usuario
     */ 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */ 
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of id_mobiliario
     */ 
    public function getId_mobiliario()
    {
        return $this->id_mobiliario;
    }

    /**
     * Set the value of id_mobiliario
     *
     * @return  self
     */ 
    public function setId_mobiliario($id_mobiliario)
    {
        $this->id_mobiliario = $id_mobiliario;

        return $this;
    }   

    /**
    * Esta funcion te devuelve la lista de reserva y no le pasa ningun parametro
    */

    public static function getReservaFin($id = '', $fecha_res = '', $fecha_des = '', $nombre_reserva = '', $sala = '', $mesa = '', $camarero = ''){     
        require_once "conexion.php";    
        if(empty($id) and empty($fecha_res) and empty($fecha_des) and empty($nombre_reserva) and empty($sala) and empty($mesa) and empty($camarero)){
            $where=''; 
         }else{
            $where="and r.id like '%".$id."%' and r.fecha_reserva like '%".$fecha_res."%' and r.fecha_desocupacion like '%".$fecha_des."%' and r.nombre_reserva like '%".$nombre_reserva."%' and s.nombre_sala like '%".$sala."%' and m.numero_mobiliario like '%".$mesa."%' and u.nombre_usuario like '%".$camarero."%' "; 
         }
        $sql="SELECT r.id,r.fecha_reserva,r.fecha_desocupacion,r.nombre_reserva,s.nombre_sala,u.nombre_usuario,m.numero_mobiliario FROM tbl_reserva r INNER JOIN tbl_usuarios u ON r.id_usuario=u.id INNER JOIN tbl_mobiliario m ON m.id=r.id_mobiliario INNER JOIN tbl_salas s ON m.id_sala=s.id where r.fecha_desocupacion < CURRENT_TIMESTAMP()  $where ORDER BY r.fecha_desocupacion DESC";  
        $listaReserva = mysqli_query($conexion, $sql);
        $listaReserva=$listaReserva->fetch_all(MYSQLI_ASSOC); 
        return $listaReserva;      
    }
    public static function getReservaActual($id = '', $fecha_res = '', $fecha_des = '', $nombre_reserva = '', $sala = '', $mesa = '', $camarero = ''){
        require_once "conexion.php";    
        if(empty($id) and empty($fecha_res) and empty($fecha_des) and empty($nombre_reserva) and empty($sala) and empty($mesa) and empty($camarero)){
            $where=''; 
        }else{
            $where="and r.id like '%".$id."%' and r.fecha_reserva like '%".$fecha_res."%' and r.fecha_desocupacion like '%".$fecha_des."%' and r.nombre_reserva like '%".$nombre_reserva."%' and s.nombre_sala like '%".$sala."%' and m.numero_mobiliario like '%".$mesa."%' and u.nombre_usuario like '%".$camarero."%' "; 
        } 
        
        $sql="SELECT r.id,r.fecha_reserva,r.fecha_desocupacion,r.nombre_reserva,s.nombre_sala,u.nombre_usuario,m.numero_mobiliario FROM tbl_reserva r INNER JOIN tbl_usuarios u ON r.id_usuario=u.id INNER JOIN tbl_mobiliario m ON m.id=r.id_mobiliario INNER JOIN tbl_salas s ON m.id_sala=s.id where r.fecha_desocupacion > CURRENT_TIMESTAMP()  $where ORDER BY r.fecha_reserva DESC";  
        $listaReserva = mysqli_query($conexion, $sql);
        $listaReserva=$listaReserva->fetch_all(MYSQLI_ASSOC);  
        return $listaReserva;      
    }          
    
    public static function crearReserva($correo,$nombre_reserva, $id_mesa,$hora = ''){

        if ($nombre_reserva != ''){
        require_once "conexion.php";
            $sql1="SELECT id FROM tbl_usuarios WHERE email_usuario = '$correo'";
            $id=mysqli_query($conexion,$sql1);
            $id=$id->fetch_all(MYSQLI_ASSOC)[0]['id'];

            

            if(!empty($hora)){
                $fecha = mysqli_query($conexion,"SELECT DATE_ADD(date_format('$hora','%Y-%m-%d %H:00:00'), INTERVAL 1 HOUR) as 'fecha';"); 
                $fecha=$fecha->fetch_all(MYSQLI_ASSOC)[0]['fecha'];

                if($hora<=date("Y-m-d H:i:s")){
                    return false;
                }else{
                    $sql="INSERT INTO tbl_reserva (nombre_reserva,id_usuario,id_mobiliario,fecha_desocupacion,fecha_reserva) VALUES (?,?,?,?,?);";
                    $stmt=mysqli_stmt_init($conexion);
                    mysqli_stmt_prepare($stmt,$sql);
                    mysqli_stmt_bind_param($stmt,"siiss",$nombre_reserva,$id, $id_mesa,$fecha,$hora);
                    mysqli_stmt_execute($stmt);
                }

            }else{
                $fecha = mysqli_query($conexion,"SELECT DATE_ADD(date_format(current_timestamp(),'%Y-%m-%d %H:00:00'), INTERVAL 1 HOUR) as 'fecha';"); 
                $fecha=$fecha->fetch_all(MYSQLI_ASSOC)[0]['fecha'];

                $sql="INSERT INTO tbl_reserva (nombre_reserva,id_usuario,id_mobiliario,fecha_desocupacion) VALUES (?,?,?,?);";
                $stmt=mysqli_stmt_init($conexion);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"siis",$nombre_reserva,$id, $id_mesa,$fecha);
                mysqli_stmt_execute($stmt);
                $sql =("UPDATE `tbl_mobiliario` SET `estado_mobiliario` = 'ocupado' WHERE `id`=?");
                $stmt=mysqli_stmt_init($conexion);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"i",$id_mesa);
                mysqli_stmt_execute($stmt);

                mysqli_stmt_close($stmt);
            }
            
        }
        
        
    }

    public static function cambiarSilla($num,$id){


        require_once "conexion.php";

            $sql =("UPDATE `tbl_mobiliario` SET `capacidad_mesa` = $num where  `id` = $id");
            $stmt=mysqli_stmt_init($conexion);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
        
        
    }

    public static function crearReservaLib($sala){


        require_once "conexion.php";

            $sql =("UPDATE `tbl_mobiliario` SET `estado_mobiliario` = 'libre' where `estado_mobiliario` = 'ocupado' and id_sala = $sala");
            $stmt=mysqli_stmt_init($conexion);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
        
        
    }

    public static function crearReservaTotal($sala){


        require_once "conexion.php";

            $sql =("UPDATE `tbl_mobiliario` SET `estado_mobiliario` = 'ocupado' where `estado_mobiliario` = 'libre' and id_sala = $sala");
            $stmt=mysqli_stmt_init($conexion);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
        
        
    }

    public static function eliminarReserva($id){
        require_once 'conexion.php';   
    
        try{
            $pdo->beginTransaction();
            $consulta=$pdo->prepare("SELECT id_mobiliario FROM tbl_reserva WHERE id = :id");
            $consulta->bindParam(':id',$id);  
            $consulta->execute();
            $idM = $consulta->fetch(PDO::FETCH_ASSOC)['id_mobiliario'];  
            
            $consulta=$pdo->prepare("DELETE FROM tbl_reserva WHERE id = :id");
            $consulta->bindParam(':id',$id);  
            $consulta->execute();  

            $result = $pdo->prepare("UPDATE tbl_mobiliario SET estado_mobiliario = 'libre' WHERE tbl_mobiliario.id = ? ");
            $result->bindParam(1,$idM);
            $result->execute();

            $pdo->commit();
            return true;
        }catch(Exception $e){
            $conexion->rollback();
            echo "Error: ".$e->getMessage();
            return false;
        } 
    }
    
    public static function compruebaEstado(){     
        require_once 'conexion.php';
        $datos = array();
        $result = $pdo->prepare("SELECT r.id,r.fecha_reserva,max(r.fecha_desocupacion),IF(max(r.fecha_desocupacion)<CURRENT_TIMESTAMP(), 'Fin', 'Pendiente') as 'Estado', IF(max(r.fecha_desocupacion)>CURRENT_TIMESTAMP() and max(r.fecha_reserva)<CURRENT_TIMESTAMP(), 'Actualmente', 'No actualmente') as 'Actual', r.nombre_reserva,s.nombre_sala,u.nombre_usuario,m.numero_mobiliario,r.id_mobiliario FROM tbl_reserva r INNER JOIN tbl_usuarios u ON r.id_usuario=u.id INNER JOIN tbl_mobiliario m ON m.id=r.id_mobiliario INNER JOIN tbl_salas s ON m.id_sala=s.id group by r.id_mobiliario;  ");
        $result->execute();
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ( $resultado as $row ){
            if($row['Estado'] == 'Fin'){
                $result = $pdo->prepare("UPDATE tbl_mobiliario SET estado_mobiliario = 'libre' WHERE tbl_mobiliario.id = ? and (estado_mobiliario != 'libre' or estado_mobiliario = 'mantenimiento')");
                $result->bindParam(1,$row['id_mobiliario']);
                $result->execute();
            }else if($row['Estado'] == 'Pendiente'){
                if($row['Actual'] == 'Actualmente'){
                    $result = $pdo->prepare("UPDATE tbl_mobiliario SET estado_mobiliario = 'ocupado' WHERE tbl_mobiliario.id = ? ");
                    $result->bindParam(1,$row['id_mobiliario']);
                    $result->execute();
                }else if($row['Actual'] == 'No actualmente'){
                    $result = $pdo->prepare("UPDATE tbl_mobiliario SET estado_mobiliario = 'libre' WHERE tbl_mobiliario.id = ? ");
                    $result->bindParam(1,$row['id_mobiliario']);
                    $result->execute();
                }
            }
            
            $datos[] = $row['id_mobiliario'];
        }
        return $datos;    
    } 


}