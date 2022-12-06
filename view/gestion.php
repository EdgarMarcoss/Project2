<?php
session_start();
error_reporting(0);
include '../model/usuario.php';                      
$listaUsuarios=Usuario::getTipoUsuario($_SESSION['user']);

if ($listaUsuarios[0]['personal_usuario']!='admin'){
    echo "<script>location.href='./restaurante.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once './cabezera.html'; ?>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <script src="../js/carga.js"></script>
</head>
<body>
    <div class="loader-page"></div>

    <div class="btn-group">
        <div class="nav-norm">
            <button type="button" value="usuarios" id="usuarios" class="btn btn-default active">Usuarios</button>
            <button type="button" value="recursos" id="recursos" class="btn btn-default">Recursos</button>
        </div>
        <ul class="nav-resp">
            <li><a href="#desplegable"><i class="fa-solid fa-bars"></i></a>
                <div class="desp-prin-div" id="desplegable">
                    <ul class="desp-prin">
                        <li class="cerrar-desp"><a href="#"><i class="fa-solid fa-xmark"></i></a></li>
                        <li><a href="#"><button type="button" value="activa" id="activa2" class="btn btn-default">Reservas activas</button></a></li>
                        <li><a href="#"><button type="button" value="finalizar" id="finalizar2" class="btn btn-default">Reservas finalizadas</button></a></li>
                        <li><a href="#"><button type="button" name="estadis" value="estadis" id="estadis2" class="btn btn-default">Estadísticas</button></a></li>
                        <li><a href="./restaurante.php"><button class="btn btn-default">Salir</button></a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <a href="./restaurante.php" class="log nav-norm"><i class="icono fa-regular fa-circle-left"></i></a>

    <div class="background b-reserva">
        <div class="contenido tabla-res">
            <table class="table" style="text-align: center;" id="test">
                <thead>

                    <tr id="filtroU">
                        <form id="filterU" class="d-flex" role="search">
                            <th scope="col"><input class="form-control me-2" type="search" name="idU" placeholder="Id" aria-label="Search"></th>
                            <th scope="col"><input class="form-control me-2" type="search" name="tipoU" placeholder="Tipo de usuario" aria-label="Search"></th>
                            <th scope="col"><input class="form-control me-2" type="search" name="correoU" placeholder="Correo" aria-label="Search"></th>
                            <th scope="col"><input class="form-control me-2" type="search" name="dniU" placeholder="DNI" aria-label="Search"></th>
                        </form>
                        <th scope="col" colspan="2"><button id="filtrarU"  class="btn btn-filtro">Buscar</button></th>
                    </tr>
                    <tr id="filtroR">
                        <form id="filterR" class="d-flex" role="search">
                            <th scope="col"><input class="form-control me-2" type="search" name="idR" placeholder="Id" aria-label="Search"></th>
                            <th scope="col"><input class="form-control me-2" type="search" name="tipo_mobiliarioR" placeholder="Nombre de mesa" aria-label="Search"></th>
                            <th scope="col"><input class="form-control me-2" type="search" name="salaR" placeholder="Sala" aria-label="Search"></th>
                            <th scope="col"><input class="form-control me-2" type="search" name="capacidadR" placeholder="Capacidad" aria-label="Search"></th>
                        </form>
                        <th scope="col" colspan="2"><button id="filtrarR"  class="btn btn-filtro">Buscar</button></th>
                    </tr>
                    
                    <tr id="usuariosL">
                        <th>id</th>
                        <th>Tipo de usuario</th>
                        <th>Correo</th>
                        <th>DNI</th>
                        <th>Acciones</th>        
                    </tr>
                    <tr id="recursosL">
                        <th>Id</th>
                        <th>Nombre de mesa</th>
                        <th>Sala</th>
                        <th>Capacidad de mesa</th>
                        <th>Acciones</th>        
                    </tr>
                </thead>
                <tbody id="tablaVer">
                                
                </tbody>
        
            </table>
        </div>
    </div>
    <br>
    <div class="btn-crear" id="crearU">
        <a href="#idModal"><button>Crear</button></a>
    </div>
    <div class="btn-crear" id="crearR">
        <a href="#idModalR"><button>Crear</button></a>
    </div>
	</div>
    <div id="idModalR" class="modal"> 
        <div class="modal__contentR">
            <form id=registrar_recursos onsubmit=return false>
            <div>
                <label for="">Número de la mesa</label>
                <input id="numero" type="text" name="numero" required >
            </div>
            <div>
                <label for="">Capacidad de la mesa</label>
                <input id="capacidad" type="text" name="capacidad" required >
            </div>
            <div>
                <label for="">Sala de la mesa</label>
                <select name="salaMesa" id="salaMesa">
                    <option value="terraza_1">Terraza 1</option>
                    <option value="terraza_2">Terraza 2</option>
                    <option value="comedor_1">Comedor 1</option>
                    <option value="comedor_2">Comedor 2</option>
                    <option value="privada_1">Privada 1</option>
                    <option value="privada_2">Privada 2</option>
                </select> 
            </div>
            <!-- <div>
                <label for="">Foto de la mesa</label>
                <input type="file" name="fotoM" id="fotoM">
            </div> -->
            <br>
            <input type="hidden" name="recurso" id="recurso" value="recurso">
            </form>
            <p id="mensajeRec"></p>
            <input type="submit"  id="submitRecurso" class="btn-login" value="Registrar" >
            <a href="#" id="cerrar" class="modal__close">&times;</a> 
        </div> 
    </div> 
    <div id="idModal" class="modal"> 
        <div class="modal__content">
            <form id=registrar_user onsubmit=return false>
            <div>
                <label for="">Tipo de usuario</label>
                <select name="tipoUser" id="tipoUser">
                    <option value="camarero">Camarero</option>
                    <option value="mantenimiento">Mantenimiento</option>
                    <option value="admin">Admin</option>
                </select> 
            </div>
            <div>
                <label for="">Nombre</label>
                <input id="nombre" type="text" name="nombre" required >
            </div>
            <div>
                <label for="">Apellido</label>
                <input id="ape" type="text" name="ape" required >
            </div>
            <div>
                <label for="">Correo</label>
                <input id="mail" type="mail" name="correo" required >
            </div>
            <div>
                <label for="">Teléfono</label>
                <input id="telf" type="text" name="telf" required >
            </div>
            <div>
                <label for="">DNI</label>
                <input id="nif" type="text" name="dni" required >
            </div>
            <div>
                <label for="">Password</label>
                <input id="password" type="password" name="password" required >
            </div>
            <br>
            </form>
            <input type="submit"  id="submitUser" class="btn-login" value="Registrar" >
            <a href="#" id="cerrar" class="modal__close">&times;</a> 
        </div> 
    </div> 
    <style> #idModal { z-index: 999; visibility: hidden; opacity: 0; position: absolute; top: 0; right: 0; bottom: 0; left: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0, 0.8); transition: all .4s; } #idModal:target { visibility: visible; opacity: 1; } .modal__content { border-radius: 4px; position: relative; width: 300px; height: 500px; background: #ffffff; padding: 1em 2em; } .btn-modal{ background-color: #fff; } .modal__close { position: absolute; top: 10px; right: 10px; color: #585858; text-decoration: none; } </style>
    <style> #idModalR { z-index: 999; visibility: hidden; opacity: 0; position: absolute; top: 0; right: 0; bottom: 0; left: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0, 0.8); transition: all .4s; } #idModalR:target { visibility: visible; opacity: 1; } .modal__contentR { border-radius: 4px; position: relative; width: 300px; height: 300px; background: #ffffff; padding: 1em 2em; } .btn-modal{ background-color: #fff; } .modal__close { position: absolute; top: 10px; right: 10px; color: #585858; text-decoration: none; } </style>  
</body>
<div id="editaUser" class="modal"> 
        <div class="modal__content">
        <form id=editar_user onsubmit="return false"> 
            <div>
                <label for="">Editar Usuario</label>
                <select name="tipoUser" id="editTipoUser">
                    <option value="camarero">Camarero</option>
                    <option value="mantenimiento">Mantenimiento</option>
                    <option value="admin">Admin</option>
                </select> 
            </div>
            <div>
                <label for="">Nombre</label>
                <input id="editnombre" type="text" name="nombre" required >
            </div>
            <div>
                <label for="">Apellido</label>
                <input id="editape" type="text" name="ape" required >
            </div>
            <div>
                <label for="">Correo</label>
                <input id="editmail" type="mail" name="correo" required >
            </div>
            <div>
                <label for="">Teléfono</label>
                <input id="edittelf" type="text" name="telf" required >
            </div>
            <div>
                <label for="">DNI</label>
                <input id="editnif" type="text" name="dni" required >
            </div>
            <div>
                <label for="">Password</label>
                <input id="editpassword" type="password" name="password" >
            </div>
            <input type="hidden" name="idp" id="idp" value="">
            <br>
            <input type="submit"  id="submitEdit" class="btn-login" value="Editar" >
            </form>
            <a href="#" id="cerrar" class="modal__close">&times;</a> 
        </div> 
    </div> 
    <style> #editaUser { z-index: 999; visibility: hidden; opacity: 0; position: absolute; top: 0; right: 0; bottom: 0; left: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0, 0.8); transition: all .4s; } #editaUser:target { visibility: visible; opacity: 1; } .modal__content { border-radius: 4px; position: relative; width: 300px; height: 500px; background: #ffffff; padding: 1em 2em; } .btn-modal{ background-color: #fff; } .modal__close { position: absolute; top: 10px; right: 10px; color: #585858; text-decoration: none; } </style> 
</div>
    <div id="editR" class="modal"> 
        <div class="modal__contentR">
            <form id=editar_recursos onsubmit=return false>
            <div>
                <label for="">Número de la mesa</label>
                <input id="editNumero" type="text" name="numero" required >
            </div>
            <div>
                <label for="">Capacidad de la mesa</label>
                <input id="editCapacidad" type="text" name="capacidad" required >
            </div>
            <div>
                <label for="">Sala de la mesa</label>
                <select name="salaMesa" id="editSalaMesa">
                    <option value="Terraza_1">Terraza 1</option>
                    <option value="Terraza_2">Terraza 2</option>
                    <option value="Comedor_1">Comedor 1</option>
                    <option value="Comedor_2">Comedor 2</option>
                    <option value="Privada_1">Privada 1</option>
                    <option value="Privada_2">Privada 2</option>
                </select> 
            </div>
            <!-- <div>
                <label for="">Foto de la mesa</label>
                <input type="file" name="fotoM" id="fotoM">
            </div> -->
            <br>
            <input type="hidden" name="recurso" id="recurso" value="recurso">
            <input type="hidden" name="idRec" id="idRec" value="">
            </form>
            <p id="mensajeRecEd"></p>
            <input type="submit"  id="editRecurso" class="btn-login" value="Editar" >
            <a href="#" id="cerrar" class="modal__close">&times;</a> 
        </div> 
    </div>
    <style> #editR { z-index: 999; visibility: hidden; opacity: 0; position: absolute; top: 0; right: 0; bottom: 0; left: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0, 0.8); transition: all .4s; } #editR:target { visibility: visible; opacity: 1; } .modal__contentR { border-radius: 4px; position: relative; width: 300px; height: 300px; background: #ffffff; padding: 1em 2em; } .btn-modal{ background-color: #fff; } .modal__close { position: absolute; top: 10px; right: 10px; color: #585858; text-decoration: none; } </style>  
</div> 
<script src="../js/gestion.js"></script>
<script src="../js/filtros.js"></script>
<script src="../js/validacion.js"></script>
</html>