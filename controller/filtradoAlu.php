<?php

require_once '../model/usuario.php';


if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
}else{
    $nombre = '';
}

$listaReserva=Usuario::getUsuariosCam($nombre);



echo json_encode($listaReserva);