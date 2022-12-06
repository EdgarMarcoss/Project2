<?php
require_once '../model/mobiliario.php';
session_start();

$datos = array();

if($_POST['hora']){
    $_SESSION['hora'] = $_POST['hora'];
}
$hora = $_POST['hora'];
$dates = [$_SESSION['id_sala'], $hora];

$consulta = Mobiliario::getMobiliario($dates);


echo json_encode($consulta); 
