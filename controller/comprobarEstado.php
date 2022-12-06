<?php

require_once '../model/reserva.php';

if($_POST['estado'] == 'Correcto'){
    print_r(Reserva::compruebaEstado());
}