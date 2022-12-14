<?php
session_start();
if(empty($_SESSION['user'])){
    echo "<script>location.href='../index.php'</script>";
}
if (isset($_POST['sala'])) {
    $_SESSION['id_sala'] = $_POST['sala'];
    $_SESSION['nsala'] = $_POST['nsala'];
}

include 'cabezera.html';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <script src="../js/carga.js"></script>
    <title>Sala</title>
</head>
<body class="img-back">
    <div class="loader-page"></div>
    <nav>
        <h3><?php echo $_SESSION['nsala'] ?></h3>
    </nav>
    <a href="restaurante.php" class="volver-btn"><i class="icono fa-solid fa-circle-left"></i></a>
    <div class="fondo-mesas">
            <div class="reservar_hora">
                <input type="date" id="calendario" value="" />
                <select name="turnoReserva" id="turnoReserva">
                    <option value="Comidas">Comidas</option>
                    <option value="Cenas">Cenas</option>
                </select>
                <select name="horaReserva" id="horaReserva">
                    
                </select>
                <button type="submit" id="reservaActivar" class="button">Filtrar reserva</button>
                <button type="submit" id="resetReserva" class="button">Reset</button>
            </div>
        <div class="limites" id="limites">
        </div>

    </div>
    <?php
    include '../model/usuario.php';                      
    $listaUsuarios=Usuario::getTipoUsuario($_SESSION['user']);
    if (isset($_POST['submit'])){
        if ($_POST['estado'] == 'mantenimiento') { 

        if ($listaUsuarios[0]['personal_usuario']=='mantenimiento'){?>
        <div id="libre" class="modalmask">
        <div class="contenido modalbox">
        <a href="" title="Close" class="close">X</a>
            <h2 class="login-text"><span>Finalizar Incidencia</span></h2>                    
                
            <form action="../controller/eliminarincidencia.php" method="post" class="form-res" onsubmit="return valid()">
                <input type="hidden" name="mesa" value="<?php echo $_POST['id_mobi'] ?>" id="id_mesa">
                <div class="reservar">

                    <select name="motivo" id="final-reserva">
                        <option value="finalizar" default>Finalizar</option>
                       
                    </select>
                  
             
                    <!-- <p id="mensaje2"></p> -->
                </div>

                <input type="submit"  id="submit" class="btn-login" value="Enviar" >
            </form>
        </div>
    </div>
    <?php
    }}else{ 
    
    if ($listaUsuarios[0]['personal_usuario']=='camarero' and $_SESSION['hora'] != 'undefined'){?>
        <div id="libre" class="modalmask">
            <div class="contenido modalbox">
            <a href="" title="Close" class="close">X</a>
                <h2 class="login-text"><span>Crear</span></h2>           
                
                    <form action="../controller/crearreserva.php" method="post" onsubmit="return valid()">
                        <input type="hidden" name="mesa" value="<?php echo $_POST['id_mobi'] ?>" id="id_mesa">
                        <div class="reservar">
                        
                            
                                <select name="motivo" id="final-reserva">
                                    <option value="reserva" default>Reserva</option>
                                    <option value="incidencia">Incidencia</option>
                                </select> 
                                <div id="reserva-campo">
                                    <label for="">Nombre Reserva</label><br>
                                    <input type="text" name="reserva">
                                    <br>
                                </div>
                                <input type="hidden" name="hora" value="<?php echo $_SESSION['hora'] ?>" id="hora">
                                <div id="incidencia-campo">
                                    <label for="">Motivo Incidencia</label><br>
                                    <input type="text-area" name="incidencia">
                                    <br>
                                </div>
                                        
                        </div>
                        <input type="submit"  id="submit" class="btn-login" value="Crear" >
                    </form>         
                
            </div>
        </div>
        <?php
    }else if($listaUsuarios[0]['personal_usuario']=='camarero' and $_POST['estado'] == 'libre'){?>
        <div id="libre" class="modalmask">
            <div class="contenido modalbox">
            <a href="" title="Close" class="close">X</a>
                <h2 class="login-text"><span>Crear</span></h2>           
                
                    <form action="../controller/crearreserva.php" method="post" onsubmit="return valid()">
                        <input type="hidden" name="mesa" value="<?php echo $_POST['id_mobi'] ?>" id="id_mesa">
                        <div class="reservar">
                        
                            
                                <select name="motivo" id="final-reserva">
                                    <option value="reserva" default>Reserva</option>
                                    <option value="incidencia">Incidencia</option>
                                </select> 
                                <div id="reserva-campo">
                                    <label for="">Nombre Reserva</label><br>
                                    <input type="text" name="reserva">
                                    <br>
                                </div>
                                <input type="hidden" name="hora" value="<?php echo $_SESSION['hora'] ?>" id="hora">
                                <div id="incidencia-campo">
                                    <label for="">Motivo Incidencia</label><br>
                                    <input type="text-area" name="incidencia">
                                    <br>
                                </div>
                                        
                        </div>
                        <input type="submit"  id="submit" class="btn-login" value="Crear" >
                    </form>         
                
            </div>
        </div>
        <?php
    }
     }};?>
</body>
<script src="../js/horario.js"></script>
</html>