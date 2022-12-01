<?php

require_once '../model/usuario.php';

$id = $_POST['id'];

Usuario::eliminarUsuario($id);

echo "Success";