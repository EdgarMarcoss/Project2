function listar(){
        var resultado = document.getElementById("tablaVer");
        let tipo = "usuarios";
        var formdata = new FormData();
        formdata.append('tipo',tipo);

        const ajax = new XMLHttpRequest();
        ajax.open('POST','../controller/listar.php');
        ajax.onload= function (){
            if(ajax.status == 200){
                var resul = JSON.parse(ajax.responseText);
                resultado.innerHTML = '';
                for (let i = 0; i < resul.length; i++) {
                    resultado.innerHTML += `
                    <tr>
                    <td>${resul[i]['id']}</td>
                    <td>${resul[i]['personal_usuario']}</td>
                    <td>${resul[i]['email_usuario']}</td>
                    <td>${resul[i]['dni_usuario']}</td>
                    <td>
                        <a href="#editaUser"><button type='button' class='btn btn-success' onclick=Editar('${resul[i]['id']}')><i class="fa-solid fa-pen-to-square"></i></button></a>
                        <button type='button' class='btn btn-danger' onclick=Eliminar('${resul[i]['id']}')><i class="fa-solid fa-trash"></i></button>
                    </td>        
                </tr>
                    `
                }  
            }else{
                resultado.innerText = 'Error';
            }
        }
        ajax.send(formdata);
}

function listarRecursos (filtro){

        let resultado = document.getElementById("tablaVer");
        let tipo = "recursos";
        let formdata = new FormData();
        formdata.append('filtro',filtro);
        formdata.append('tipo',tipo);
        
        const ajax = new XMLHttpRequest();
        ajax.open('POST','../controller/listar.php');
        ajax.onload= function (){
            if(ajax.status == 200){
                var resul = JSON.parse(ajax.responseText);
                resultado.innerHTML = '';
                for (let i = 0; i < resul.length; i++) {
                    resultado.innerHTML += `
                    <tr>
                    <td>${resul[i]['id']}</td>
                    <td>mesa ${resul[i]['numero_mobiliario']}</td>
                    <td>${resul[i]['nombre_sala']}</td>
                    <td>${resul[i]['capacidad_mesa']} personas</td>
                    <td>
                        <a href="#editR"><button type='button' class='btn btn-success' onclick=EditarR('${resul[i]['id']}')><i class="fa-solid fa-pen-to-square"></i></button></a>
                        <input type="hidden" name="editRecurso" id="editRecurso" value="editRecurso">
                        <button type='button' class='btn btn-danger' onclick=EliminarRec('${resul[i]['id']}')><i class="fa-solid fa-trash"></i></button>
                    </td>        
                </tr>
                    `
                }  
            }else{
                resultado.innerText = 'Error';
            }
        }
        ajax.send(formdata);
}


function Eliminar (id){
    Swal.fire({
        title: `<strong>¿Desea eliminar el usuario?</strong>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Eliminar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            let formdata = new FormData();
            formdata.append('id',id);

            const ajax = new XMLHttpRequest();
            ajax.open('POST','../controller/eliminarUser.php');
            ajax.onload= function (){
                if(ajax.status == 200){
                    console.log(ajax.responseText);
                    if(ajax.responseText == 'Success'){
                        Swal.fire('Se ha eliminado el usuario con éxito', '', 'success')
                        listar('');
                    }
                }else{
                    Swal.fire('Algo está fallnado, inténtelo más tarde', '', 'error');
                }
            }
            ajax.send(formdata);
          
        } else if (result.isDenied) {
          Swal.fire('Se ha cancelado la petición', '', 'info')
        }
      })
    
}

function EliminarRec (id){
    Swal.fire({
        title: `<strong>¿Desea eliminar el recurso?</strong>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Eliminar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            let formdata = new FormData();
            formdata.append('id',id);

            const ajax = new XMLHttpRequest();
            ajax.open('POST','../controller/eliminarRec.php');
            ajax.onload= function (){
                if(ajax.status == 200){
                    if(ajax.responseText == 'Success'){
                        Swal.fire('Se ha eliminado el recurso con éxito', '', 'success');
                        listarRecursos('');
                    }
                }else{
                    Swal.fire('Algo está fallando, inténtelo más tarde', '', 'error')
                }
            }
            ajax.send(formdata);
        }else if (result.isDenied) {
            Swal.fire('Se ha cancelado la petición', '', 'info')
        }
    })
}

function Registrar(){
    document.getElementById('mensajeRegNom').innerText = '';
    document.getElementById('mensajeRegApe').innerText = "";
    document.getElementById('mensajeRegMail').innerText = "";
    document.getElementById('mensajeRegTelf').innerText = "";
    document.getElementById('mensajeRegNif').innerText = "";
    document.getElementById('mensajeReg').innerText = '';
    let nombre = document.getElementById('nombre');
    let ape = document.getElementById('ape');
    let mail = document.getElementById('mail');
    let telf = document.getElementById('telf');
    let nif = document.getElementById('nif');
    let password = document.getElementById('password');
    if(nombre.value == '' || ape.value == '' || telf.value == '' || password.value == '' || password.value == '' || mail.value == '' || nif == ''){
        document.getElementById('mensajeReg').innerText = "Revise sus datos vacíos";
        document.getElementById('mensajeReg').style.color = 'red';
        return false;
    }
    else if(!isNaN(nombre.value)){
        document.getElementById('mensajeRegNom').innerText = "Revise sus datos, valores incorrectos";
        document.getElementById('mensajeRegNom').style.color = 'red';
        return false;
    }else if(!isNaN(ape.value)){
        document.getElementById('mensajeRegApe').innerText = "Revise sus datos, valores incorrectos";
        document.getElementById('mensajeRegApe').style.color = 'red';
        return false;
    }else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail.value)){
        document.getElementById('mensajeRegMail').innerText = "Revise sus datos, valores incorrectos";
        document.getElementById('mensajeRegMail').style.color = 'red';
        return false;
    }else if (!/^\d{9}$/.test(telf.value)){
        document.getElementById('mensajeRegTelf').innerText = "Revise sus datos, valores incorrectos";
        document.getElementById('mensajeRegTelf').style.color = 'red';
        return false;
    }else if (!/^(\d{8})([A-Z])$/.test(nif.value)){
        document.getElementById('mensajeRegNif').innerText = "Revise sus datos, valores incorrectos";
        document.getElementById('mensajeRegNif').style.color = 'red';
        return false;
    }else{
        let form = document.getElementById("registrar_user");
        let formdata = new FormData(form);

        const ajax = new XMLHttpRequest();
        ajax.open('POST','../controller/crearcontroller.php');
        ajax.onload= function (){
            console.log(ajax.responseText)
            if(ajax.status == 200){
                if(ajax.responseText == 'Success'){
                    Swal.fire('Se ha creado el usuario con éxito', '', 'success');
                    document.getElementById('cerrar').click()
                    form.reset();
                    listar('');
                }
            }else{
                Swal.fire('Algo está fallando, inténtelo más tarde', '', 'error');
            }
        }
        ajax.send(formdata);
    }
}

function RegistrarRec(){
    let number = document.getElementById("numero");
    let capacidad = document.getElementById("capacidad");
    if(number.value == '' || capacidad.value == ''){
        document.getElementById('mensajeRec').innerText = "Revise sus datos vacíos";
        document.getElementById('mensajeRec').style.color = 'red';
        return false;
    }
    else if(isNaN(number.value) || isNaN(capacidad.value)){
        document.getElementById('mensajeRec').innerText = "Revise sus datos, valores incorrectos";
        document.getElementById('mensajeRec').style.color = 'red';
        return false;
    }else{
        let form = document.getElementById("registrar_recursos");
        let formdata = new FormData(form);

        const ajax = new XMLHttpRequest();
        ajax.open('POST','../controller/crearcontroller.php');
        ajax.onload= function (){
            console.log(ajax.responseText)
            if(ajax.status == 200){
                if(ajax.responseText == 'Success'){
                    Swal.fire('Se ha creado el recurso con éxito', '', 'success');;
                    document.getElementById('cerrar').click()
                    form.reset();
                    listarRecursos('');
                }
            }else{
                Swal.fire('Algo está fallando, inténtelo más tarde', '', 'error');
            }
        }
        ajax.send(formdata);
    }
    
}

function Editar (id){
    let formdata = new FormData();
    formdata.append('id',id);

    const ajax = new XMLHttpRequest();
    ajax.open('POST','../controller/editarcontroller.php');
    ajax.onload= function (){
        if(ajax.status == 200){
            console.log(ajax.responseText);
            var resul = JSON.parse(ajax.responseText);
            
            document.getElementById("editTipoUser").value = resul['personal_usuario']
            document.getElementById("editnombre").value = resul['nombre_usuario']
            document.getElementById("editape").value = resul['apellido_usuario']
            document.getElementById("editmail").value = resul['email_usuario']
            document.getElementById("edittelf").value = resul['telefono_usuario']
            document.getElementById("editnif").value = resul['dni_usuario']
            document.getElementById("editpassword").value = "";
            document.getElementById("idp").value = resul['id'];
        }else{
            alert('Error');
        }
    }
    ajax.send(formdata);
}

function EditarR (id){
    let edit = document.getElementById('editRecurso').value
    let formdata = new FormData();
    formdata.append('id',id);
    formdata.append('edit',edit);

    const ajax = new XMLHttpRequest();
    ajax.open('POST','../controller/editarcontroller.php');
    ajax.onload= function (){
        if(ajax.status == 200){
            console.log(ajax.responseText);
            var resul = JSON.parse(ajax.responseText);
            
            document.getElementById("editNumero").value = resul['numero_mobiliario'];
            document.getElementById("editCapacidad").value = resul['capacidad_mesa'];
            document.getElementById("editSalaMesa").value = resul['nombre_sala'];
            document.getElementById("idRec").value = resul['id'];
        }else{
            alert('Error');
        }
    }
    ajax.send(formdata);
    }

function EditarUser(){
    let form = document.getElementById("editar_user");
    let formdata = new FormData(form);

    const ajax = new XMLHttpRequest();
    ajax.open('POST','../controller/crearcontroller.php');
    ajax.onload= function (){
        console.log(ajax.responseText);
        if(ajax.status == 200){
            if(ajax.responseText == 'Success'){
                Swal.fire('Se ha editado el usuario con éxito', '', 'success');
                document.getElementById('cerrar').click()
                listar('');
            }
        }else{
            Swal.fire('Algo está fallando, inténtelo más tarde', '', 'error');
        }
    }
    ajax.send(formdata);
}

function EditarRec(){
    let number = document.getElementById("editNumero");
    let capacidad = document.getElementById("editCapacidad");
    if(number.value == '' || capacidad.value == ''){
        document.getElementById('mensajeRecEd').innerText = "Revise sus datos vacíos";
        document.getElementById('mensajeRecEd').style.color = 'red';
        return false;
    }
    else if(isNaN(number.value) || isNaN(capacidad.value)){
        document.getElementById('mensajeRecEd').innerText = "Revise sus datos, valores incorrectos";
        document.getElementById('mensajeRecEd').style.color = 'red';
        return false;
    }else{
    let form = document.getElementById("editar_recursos");
    let formdata = new FormData(form);

    const ajax = new XMLHttpRequest();
    ajax.open('POST','../controller/crearcontroller.php');
    ajax.onload= function (){
        console.log(ajax.responseText);
        if(ajax.status == 200){
            if(ajax.responseText == 'Success'){
                Swal.fire('Se ha editado el recurso con éxito', '', 'success');
                document.getElementById('cerrar').click()
                listarRecursos('');
            }
        }else{
            Swal.fire('Algo está fallando, inténtelo más tarde', '', 'error');
        }
    }
    ajax.send(formdata);
}
}

function EliminarReserva (id){
    let alerta = document.getElementById('alerta');
    let formdata = new FormData();
    formdata.append('id',id);

    const ajax = new XMLHttpRequest();
    ajax.open('POST','../controller/eliminarreserva.php');
    ajax.onload= function (){
        if(ajax.status == 200){
            if(ajax.responseText == 'Success'){
                alerta.style.display = 'block';
                ver();
            }
        }else{
            alert('Error');
        }
    }
    ajax.send(formdata);
}


document.getElementById('submitUser').addEventListener("click", () => {
    Registrar();
});
document.getElementById('submitRecurso').addEventListener("click", () => {
    RegistrarRec();
});
document.getElementById('submitEdit').addEventListener("click", () => {
    EditarUser();
});

document.getElementById('editRecurso').addEventListener("click", () => {
    EditarRec();
});

document.getElementById('usuarios').addEventListener("click", () => {
    document.getElementById('usuariosL').style.display = 'contents';
    document.getElementById('recursosL').style.display = 'none';
    document.getElementById('filtroR').style.display = 'none';
    document.getElementById('filtroU').style.display = 'table-row';
    document.getElementById('usuarios').classList = 'btn btn-default active';
    document.getElementById('recursos').classList = 'btn btn-default';
    document.getElementById('crearR').style.display = 'none';
    document.getElementById('crearU').style.display = 'flex';
    listar('')
});
document.getElementById('recursos').addEventListener("click", () => {
    document.getElementById('recursosL').style.display = 'contents';
    document.getElementById('usuariosL').style.display = 'none';
    document.getElementById('filtroU').style.display = 'none';
    document.getElementById('filtroR').style.display = 'table-row';
    document.getElementById('recursos').classList = 'btn btn-default active';
    document.getElementById('usuarios').classList = 'btn btn-default';
    document.getElementById('crearU').style.display = 'none';
    document.getElementById('crearR').style.display = 'flex';
    listarRecursos('');
});

listar('')