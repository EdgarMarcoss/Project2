<?php
function errorEmail($email){
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error=true;
    }else{
        $error=false;
    }
    return $error;
    
}

function errorNombre($nombre){
    if(!preg_match("/^[a-zA-Z]*$/",$nombre)){
        $error=true;
    }else{
        $error=false;
    }
    return $error;
    
}

function errorNota($nota){
    if(is_numeric($nota)){
        $error=false;
    }else{
        $error=true;
    }  
    return $error;
}

function errorDni($dni){
    $letter = substr($dni, -1);
    $numbers = substr($dni, 0, -1);
  
    if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23, 1) == $letter && strlen($letter) == 1 && strlen ($numbers) == 8 ){
      return false;
    }
    return true;
}

function errorTelefono($telefono){
    return !preg_match('/^[0-9]{9,9}$/', $telefono);
}