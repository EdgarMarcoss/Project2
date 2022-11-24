<?php
session_start();
if(empty($_SESSION['user'])){
    echo "<script>location.href='../index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'cabezera.html'; ?>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <script src="../js/carga.js"></script>
    <title>Restaurante</title>
</head>
<body class="img-back">
    <div class="loader-page"></div>

    <nav>
        <h3>Nuestras páginas</h3>
    </nav>
    <a class="log-out" aria-current="page" href="../controller/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    <div class="background">
        <div class="contenido restaurante">
            <!-- Mostrar todos los sitios/salas -->
            <div >
                <a href="camareros.php"><button>Camareros</button></a>
            </div>
            <div >
                <a href="mantenimiento.php"><button>Mantenimiento</button></a>
            </div>
            
            <div >
                <a href="restaurante.php"><button>Restaurante</button></a>
            </div>
        </div>
        <div class="color-back ">
            <div class="modal">
                
            </div>
        </div>
    </div>   