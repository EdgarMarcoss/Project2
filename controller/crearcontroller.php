<?php

error_reporting(0);
session_start();
   
require_once '../model/usuario.php';
require_once '../model/mobiliario.php';

if($_POST['recurso']){
    $numero = $_POST['numero'];
    $capacidad = $_POST['capacidad'];
    $sala = $_POST['salaMesa'];

    if($_POST['idRec']){
        Mobiliario::editarMobiliario($_POST['idRec'],$numero,$capacidad,$sala);
        echo "Success";
    }else{
        Mobiliario::crearMobiliario($numero,$capacidad,$sala);
        echo "Success";
    }
}else{
    $tipo = $_POST['tipoUser'];
    $nombre=$_POST['nombre'];
    $apellido = $_POST['ape'];
    $correo = $_POST['correo']; 
    $pass = $_POST['password']; 
    $tel = $_POST['telf']; 
    $dni = $_POST['dni'];

    $pass = hash('sha256', $pass);
    if($_POST['idp']){
        Usuario::editarUsuario($_POST['idp'],$tipo, $nombre, $apellido, $correo, $pass, $tel, $dni);
        echo "Success";
    }else{
        Usuario::crearUsuario($tipo, $nombre, $apellido, $correo, $pass, $tel, $dni);
        echo "Success";
    }
}



