<?php

    require_once '../model/reserva.php';  
    $id = $_POST['id'];    
    
    Reserva::eliminarReserva($id);
    echo "Success";
    
 



