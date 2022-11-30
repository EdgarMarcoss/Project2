<?php

//Recogemos la contraseña de login.php y la encriptamos en sha256 para que en nuestra base de datos reconozca
try{
    require_once '../model/conexion.php';
    $pass = $_POST['pass'];
    $pass = hash('sha256', $pass);

    //verificamos si el usuario no lleva ningun caracter raro, que podría ocasionar a un SQL INJECTION
    //$user=mysqli_real_escape_string($conexion,$_POST['mail']);
    $user = $_POST['mail'];
    // selecionamos en la base de datos los datos introducidos arriba para comprobar si existen
    $stmt = $pdo->prepare("select * from tbl_usuarios where email_usuario=? and password_usuario=?");
    $stmt->bindParam(1,$user);
    $stmt->bindParam(2,$pass);
    $stmt->execute();
    $num=$stmt->rowCount();

    //Si existen creamos la session, si no enviamos a login.php 
    if ($num==1){
        session_start();
        $_SESSION['user'] = $user;
        echo "<script>location.href='../view/restaurante.php'</script>";
    }else{
        echo "<script>location.href='../index.php?error=1'</script>";
    }

}catch(Exception $e){
    echo "<script>location.href='../index.php?error=2'</script>";
}