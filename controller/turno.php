<?php

require_once "../model/conexion.php";
$datos=array();

$turno = $_POST['turno'];

$consulta = $pdo->prepare("select horas from tbl_horarios where turno_cocina = ?");
$consulta->bindParam(1, $turno);   
$consulta->execute();



while($element=$consulta->fetch(PDO::FETCH_ASSOC)){
    $datos[]=$element;
}
echo json_encode($datos[0]); 