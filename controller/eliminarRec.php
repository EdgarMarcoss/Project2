<?php

require_once "../model/mobiliario.php";

$id = $_POST['id'];

Mobiliario::eliminarMobiliario($id);

echo "Success";