<?php
session_start();
if(empty($_SESSION['user'])){
    echo "<script>location.href='../index.php'</script>";
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once './cabezera.html'; 
    include '../model/usuario.php';                      
    $listaUsuarios=Usuario::getUsuariosCam();
    ?>
    
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <script src="../js/carga.js"></script>
</head>
<body>
    <div class="loader-page"></div>

    <div class="btn-group">
        <div class="nav-norm">
            <button type="button" value="activa" id="activa" class="btn btn-default">Camareros</button>
        </div>
        <ul class="nav-resp">
            <li><a href="#desplegable"><i class="fa-solid fa-bars"></i></a>
                <div class="desp-prin-div" id="desplegable">
                    <ul class="desp-prin">
                        <li class="cerrar-desp"><a href="#"><i class="fa-solid fa-xmark"></i></a></li>
                        <li><a href="#"><button type="button" value="activa" id="activa2" class="btn btn-default">Reservas activas</button></a></li>
                        <li><a href="./restaurante.php"><button class="btn btn-default">Salir</button></a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <a href="./restaurante.php" class="log nav-norm"><i class="fa-regular fa-circle-left"></i></a>
    

    <div class="background b-reserva">
        <div class="contenido tabla-res">
            <table  style="text-align: center;" id="test">
                <thead>
                <tr>
                        <form id="filter" class="d-flex" role="search">
                            <th scope="col"><input class="form-control me-2" type="search" id="nombre" placeholder="Nombre" aria-label="Search"></th>
                        </form>
                        <th scope="col" colspan="2"><button onclick="filtrar()"  class="btn btn-info">Buscar</button></th>
                </tr>
                    
                    <tr>
                        <th>id</th>
                        <th>Tipo Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>       
                        <th>Email</th>   
                        <th>Número</th> 
                        <th>DNI</th>            
                    </tr>
                </thead>
                <tbody id="tablaVer">
                <?php
                    foreach ($listaUsuarios as $registro){
                ?>
                <tr>
                        <td><?php echo"{$registro['id']}";?></td>
                        <td><?php echo"{$registro['personal_usuario']}";?></td>
                        <td><?php echo"{$registro['nombre_usuario']}";?></td>
                        <td><?php echo"{$registro['apellido_usuario']}";?></td>
                        <td><?php echo"{$registro['email_usuario']}";?></td>
                        <td><?php echo"{$registro['telefono_usuario']}";?></td>
                        <td><?php echo"{$registro['dni_usuario']}";?></td>
                </tr> 
                <?php } ?>
                </tbody>
        
            <script>
                const filtrar = async () =>{

                    var nombre = document.getElementById('nombre').value;

                    var bodyFormData = new FormData();

                    bodyFormData.append('nombre', nombre);
                    

                    const resul = await axios({
                        method: 'post',
                        url: '../controller/filtradoAlu.php',
                        data: bodyFormData
                    });

                    data = document.getElementById('tablaVer');
                    data.innerHTML = '';
                    for (let i = 0; i < resul.data.length; i++) {
                        data.innerHTML += `
                        <tr>
                        <td>${resul.data[i]['id']}</td>
                        <td>${resul.data[i]['personal_usuario']}</td>
                        <td>${resul.data[i]['nombre_usuario']}</td>
                        <td>${resul.data[i]['apellido_usuario']}</td>
                        <td>${resul.data[i]['email_usuario']}</td>
                        <td>${resul.data[i]['telefono_usuario']}</td>
                        <td>${resul.data[i]['dni_usuario']}</td>
                        </tr>
                        `
                    }
                    document.getElementById('filter').reset();
                }
                
                
            </script>
            </table>
        </div>
    </div>
</body>
</html>