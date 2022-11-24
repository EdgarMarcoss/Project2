<?php
session_start();
   
require_once '../model/reserva.php';

$sala = $_POST['sala'];

Reserva::crearReservaLib($sala);

echo"<script>window.location.href = '../view/sala.php' </script>";

