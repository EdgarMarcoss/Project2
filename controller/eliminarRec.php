<?php

require_once "../model/conexion.php";

$id = $_POST['id'];

$consulta = $pdo->prepare("DELETE FROM tbl_mobiliario WHERE id = :id");
$consulta->bindParam(':id', $id);
$consulta->execute();

echo "Success";