<?php

session_start();
   
require_once '../model/usuario.php';

$nombre=$_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo']; 
$pass = $_POST['pass']; 
$tel = $_POST['tel']; 
$dni = $_POST['dni'];

$pass = hash('sha256', $pass);


Usuario::crearUsuario($nombre, $apellido, $correo, $pass, $tel, $dni);

echo"<script>window.location.href = '../view/mantenimiento.php' </script>";

