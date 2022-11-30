window.addEventListener('load', () => {
    if (document.getElementById("reserva-campo")) {
        var reserva = document.getElementById("reserva-campo");
        var incidencia = document.getElementById("incidencia-campo");

        incidencia.classList.add('nav-resp');
        reserva.innerHTML = '';
        incidencia.innerHTML = '';
        var select = document.getElementById('final-reserva');
        reserva.innerHTML = `
                    <label for="">Nombre Reserva</label><br>
                    <input type="text" name="reserva">                                                
                `;
        
    
        select.addEventListener("change", () => {
            if (document.getElementById('final-reserva').value == 'reserva') {
                incidencia.innerHTML = '';                                           
                reserva.innerHTML = `
                    <label for="">Nombre Reserva</label><br>
                    <input type="text" name="reserva">                                                
                `;
                incidencia.classList.add('nav-resp');
                reserva.classList.remove('nav-resp');
            } else if (document.getElementById('final-reserva').value == 'incidencia') {
                incidencia.innerHTML = `
                    <label for="">Motivo Incidencia</label><br>
                    <input type="text-area" name="incidencia">
                    <br>
                `;
                reserva.innerHTML = '';
                reserva.classList.add('nav-resp');
                incidencia.classList.remove('nav-resp');
                    
            }                                      
            
        });
    }
                               

    if (document.getElementsByClassName('active') && document.getElementById('activa')) {
        document.getElementById('activa').classList.add('active');
        document.getElementById('test').classList.add('activa')

        ver(document.getElementById('activa').value);
        let btnHeader = document.getElementsByClassName('reservaP');

        for (let i = 0; i < btnHeader.length; i++) {
            btnHeader.item(i).addEventListener('click', () => {
                document.getElementsByClassName('active')[0].classList.remove('active');
                if (btnHeader.item(i).getAttribute('value') == 'activa') {
                    document.getElementById('test').classList.add('activa');
                } else {
                    document.getElementById('test').classList.remove('activa');
                }
                btnHeader.item(i).classList.add('active');
                document.getElementsByTagName('body')[0].classList.remove('resp-scroll');
                btnHeader.item(i).classList.remove('resp');
                ver(btnHeader.item(i).value);
            });
        }
    }
});