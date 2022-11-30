<?php
error_reporting(0);
require_once "../model/conexion.php";

if($_POST['edit']){
    $id = $_POST['id'];
    $consulta = $pdo->prepare("SELECT m.id,s.nombre_sala,m.numero_mobiliario,m.capacidad_mesa FROM tbl_mobiliario m INNER JOIN tbl_salas s ON s.id=m.id_sala where m.id = :id");
    $consulta->bindParam(':id', $id);

    $consulta->execute();

    $consulta=$consulta->fetch(PDO::FETCH_ASSOC);
    echo json_encode($consulta);
}else{
    $id = $_POST['id'];

    $consulta = $pdo->prepare("SELECT * FROM tbl_usuarios where id = :id");
    $consulta->bindParam(':id', $id);

    $consulta->execute();

    $consulta=$consulta->fetch(PDO::FETCH_ASSOC);
    echo json_encode($consulta);
}

