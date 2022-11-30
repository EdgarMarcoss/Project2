function filtroU(){
    let resultado = document.getElementById("tablaVer");
    let form = document.getElementById("filterU");
    let tipo = "usuarios";
    let formdata = new FormData(form);
    formdata.append('tipo',tipo)

    const ajax = new XMLHttpRequest();
    ajax.open('POST','../controller/listar.php');
    ajax.onload= function (){
        console.log(ajax.responseText)
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
                form.reset();
        }else{
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);

}

function filtroR(){
    let resultado = document.getElementById("tablaVer");
    let form = document.getElementById("filterR");
    let tipo = "recursos";
    let formdata = new FormData(form);
    formdata.append('tipo',tipo)

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
                form.reset();
        }else{
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);

}




document.getElementById('filtrarU').addEventListener("click", () => {
    filtroU();
});

document.getElementById('filtrarR').addEventListener("click", () => {
    filtroR();
});
