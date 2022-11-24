<?php

    //require_once '../components/cabecera.html';

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulario.css">
    <title>Formulario</title>
</head>
<body>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="box">
  <form class="form" method="POST" action="../controller/crearcontroller.php">
    <h2>Usuario</h2>
    
    <div class="flex">
      <div class="inputBox">
      <span>Nombre</span> 
        <input type="text" required= "required" name="nombre" id="nombre"/>  
             
        <i></i>
      </div>

      <div class="inputBox">
      <span>Apellido</span>
        <input type="text" required="required" name="apellido" id="apellido">
        <i></i>
      </div>
    </div>

    <div class="">
      <div class="inputBox">
      <span>Correo</span>
        <input type="email" required="required" name="correo" id="correo"></input>
        <i></i>
      </div>

      <div class="inputBox">
      <span>Password</span>
        <input type="text" required="required" name="pass" id="pass"></input>
        <i></i>
      </div>

      <div class="inputBox">
      <span>Telefono</span>
        <input type="text" required="required" name="tel" id="tel"></input>
        <i></i>
      </div>

      <div class="inputBox">
      <span>DNI</span>
        <input type="text" required="required" name="dni" id="dni"></input>
        <i></i>
      </div>

      
    </div>    
    <button type="submit" id="send">Crear</button>

<script src="../js/alerts-server.js"></script>
</body>
</html>