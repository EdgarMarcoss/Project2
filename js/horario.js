function horas(turno){
    let resultado = document.getElementById("horaReserva");
    let formdata = new FormData();
    formdata.append('turno',turno)

    const ajax = new XMLHttpRequest();
    ajax.open('POST','../controller/turno.php');
    ajax.onload= function (){
        if(ajax.status == 200){
            var resul = JSON.parse(ajax.responseText);
                resultado.innerHTML = '';
                resul = resul.horas.split(',');
                console.log(resul)
                for (let i = 0; i < resul.length; i++) {
                    resultado.innerHTML += `
                    <option value ="${resul[i]}" >${resul[i]}</option>
                    `
                }
        }else{
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);
}

function filtrar(hora){
    let resultado = document.getElementById("limites");
    let formdata = new FormData();
    formdata.append('hora',hora)

    const ajax = new XMLHttpRequest();
    ajax.open('POST','../controller/hora.php');
    ajax.onload= function (){
        if(ajax.status == 200){
            var resul = JSON.parse(ajax.responseText);
            resultado.innerHTML = '';
                for (let i = 0; i < resul.length; i++) {
                    resultado.innerHTML += `
                    <div class="tarjeta">
                        <form action="./sala.php" method="post">
                            <input type="hidden" name="estado" value="${resul[i]["estado_mobiliario"]}">
                            <input type="hidden" name="id_mobi" value="${resul[i]["id"]}">
                            <button type="submit" name="submit" class="img-svg"><img class="${resul[i]["estado_mobiliario"]}" src="../img/mesas/${resul[i]["img_mobiliario"]}"></button>
                            <br>
                        </form>
                    </div>
                    `
                }
        }else{
            console.log('Error');
        }
    }
    ajax.send(formdata);
}

document.getElementById('turnoReserva').addEventListener("change", () => {
    horas(document.getElementById('turnoReserva').value);
});
document.getElementById('reservaActivar').addEventListener("click", () => {
    filtrar(document.getElementById('calendario').value + ' ' + document.getElementById('horaReserva').value + ':00')
    
});
document.getElementById('resetReserva').addEventListener("click", () => {
    filtrar()
});
document.getElementById('calendario').addEventListener("change", () => {
    if(document.getElementById('calendario').value < new Date().toISOString().slice(0, 10)){
        document.getElementById('calendario').value = new Date().toISOString().slice(0, 10);
    }
    if(document.getElementById('calendario').value.slice(0,4) - new Date().toISOString().slice(0, 4) >1){
        document.getElementById('calendario').value = new Date().toISOString().slice(0, 10);
    }
});


window.onload=function () {
    horas('Comidas');
    document.getElementById('calendario').value =  new Date().toISOString().slice(0, 10);
    filtrar()
}