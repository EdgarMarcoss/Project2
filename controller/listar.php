<?php
error_reporting(0);
require_once "../model/conexion.php";

$datos=array();

if($_POST['tipo']== 'usuarios'){
    if(empty($_POST['idU']) and empty($_POST['tipoU']) and empty($_POST['correoU']) and empty($_POST['dniU'])){

        $consulta = $pdo->prepare("SELECT * FROM tbl_usuarios");
    
        $consulta->execute();
    }else{
        if(isset($_POST['idU'])){
            $id = $_POST['idU'];
        }else{
            $id = '';
        }
        if(isset($_POST['correoU'])){
            $correo = $_POST['correoU'];
        }else{
            $correo = '';
        }
        if(isset($_POST['dniU'])){
            $dni = $_POST['dniU'];
        }else{
            $dni = '';
        }
        if(isset($_POST['tipoU'])){
            $tipoU = $_POST['tipoU'];
        }else{
            $tipoU = '';
        }
        $where = "WHERE `id` LIKE '".$id."%' and `email_usuario` LIKE '".$correo."%' and `personal_usuario` LIKE '".$tipoU."%' and `dni_usuario` LIKE '%".$dni."%'";

        $consulta = $pdo->prepare("SELECT * FROM tbl_usuarios $where");
        
        $consulta->execute();
    }
}else if($_POST['tipo']=='recursos'){
    if(empty($_POST['idR']) and empty($_POST['tipo_mobiliarioR']) and empty($_POST['salaR']) and empty($_POST['capacidadR'])){

        $consulta = $pdo->prepare("SELECT s.nombre_sala,m.tipo_mobiliario,m.id,m.numero_mobiliario,m.capacidad_mesa FROM tbl_salas s INNER JOIN tbl_mobiliario m ON m.id_sala=s.id");
    
        $consulta->execute();
    }else{
        if(isset($_POST['idR'])){
            $id = $_POST['idR'];
        }else{
            $id = '';
        }
        if(isset($_POST['tipo_mobiliarioR'])){
            $tipo_mobiliarioR = $_POST['tipo_mobiliarioR'];
        }else{
            $tipo_mobiliarioR = '';
        }
        if(isset($_POST['salaR'])){
            $salaR = $_POST['salaR'];
        }else{
            $salaR = '';
        }
        if(isset($_POST['capacidadR'])){
            $capacidadR = $_POST['capacidadR'];
        }else{
            $capacidadR = '';
        }
        $where = "WHERE m.id LIKE '".$id."%' and m.numero_mobiliario LIKE '".$tipo_mobiliarioR."%' and m.capacidad_mesa LIKE '".$capacidadR."%' and s.nombre_sala LIKE '%".$salaR."%'";
    
        $consulta = $pdo->prepare("SELECT s.nombre_sala,m.tipo_mobiliario,m.id,m.numero_mobiliario,m.capacidad_mesa FROM tbl_salas s INNER JOIN tbl_mobiliario m ON m.id_sala=s.id $where");
        
        $consulta->execute();
}}



    while($element=$consulta->fetch(PDO::FETCH_ASSOC)){
        $datos[]=$element;
    }
    echo json_encode($datos); 
    
