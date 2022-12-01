<?php
require_once '../model/mobiliario.php';
session_start();

$datos = array();
$hora = $_POST['hora'];
$dates = [$_SESSION['id_sala'], $hora];

$consulta = Mobiliario::getMobiliario($dates);


echo json_encode($consulta); 
