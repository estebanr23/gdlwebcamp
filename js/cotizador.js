(function(){
    "use strict";

    var regalo = document.getElementById('regalo');
    document.addEventListener('DOMContentLoaded', function(){

        // Mapa URL: https://leafletjs.com/download.html
        
        if(document.getElementById('mapa')) { // Solucion al error L is not defined.

            var map = L.map('mapa').setView([-28.453336, -65.769718], 15); // Clase del div, Coordenadas, Zomm Incial.

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([-28.453336, -65.769718]).addTo(map) // Cooredenadas.
            .bindPopup('GDLWebCamp 2021.<br> Boletos ya disponibles.')
            .openPopup()
            /*
            .bindTooltip('Un Tooltip') // Muestra un mensaje al poner el puntero sobre la ubicacion.
            .openToolTip();
            */
        }

        // Campos Datos Usuario
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');

        // Campos pases
        var pase_dia = document.getElementById('pase_dia');
        var pase_dosdias = document.getElementById('pase_dosdias');
        var pase_completo = document.getElementById('pase_completo');
        
        // Botones y divs
        var calcular = document.getElementById('calcular');
        var errorDiv = document.getElementById('error');
        var botonRegistro = document.getElementById('btnRegistro');
        var lista_productos = document.getElementById('lista-productos');
        var suma = document.getElementById('suma-total');

        botonRegistro.disabled = true;

        // Extras
        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas');

        if(document.getElementById('calcular')) {

            calcular.addEventListener('click', calcularMonto);
            pase_dia.addEventListener('blur', mostrarDias); // Blur se activa al perder foco en un campo.
            pase_dosdias.addEventListener('blur', mostrarDias);
            pase_completo.addEventListener('blur', mostrarDias);

            var formulario_editar = document.getElementsByClassName('editar_registrado'); 
            if(formulario_editar.length > 0) {
                if(pase_dia.value || pase_dosdias.value || pase_completo.value) {
                    mostrarDias();
                }
            } 

            nombre.addEventListener('blur', validarCampos);
            apellido.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarEmail);
            function validarCampos() {
                if(this.value == '') {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "Este campo es obligatorio";
                    this.style.border = '1px solid red'; // Resalta el input.
                    errorDiv.style.border = '1px solid red'; // Resalta el contenedor.
                } else{
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                }
            }

            function validarEmail() {
                if(email.value.indexOf('@') > -1) { // Podria usa this. indexOf() busca el valor pasado como parametro en una cadena y devuelve -1 si no lo encuentra.
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                } else {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "Este campo debe tener al menos una @";
                    this.style.border = '1px solid red'; 
                    errorDiv.style.border = '1px solid red'; 
                }
            }


            function calcularMonto(event){
                event.preventDefault();
                if(regalo.value === '') {
                    alert("Debes elegir un regalo");
                    regalo.focus();
                } else {
                    var boletosDia = parseInt(pase_dia.value, 10) || 0,
                        boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
                        boletoCompleto = parseInt(pase_completo.value, 10) || 0,
                        cantCamisas = parseInt(camisas.value, 10) || 0,
                        cantEtiquetas = parseInt(etiquetas.value, 10) || 0;

                    var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletoCompleto * 50) + ((cantCamisas * 10) * .93) + (cantEtiquetas * 2);
                    
                    var listadoProductos = []; // Creo array.
                    if(boletosDia >= 1) {
                        listadoProductos.push(boletosDia + ' Pases por dia');
                    }
                    if(boletos2Dias >= 1) {
                        listadoProductos.push(boletos2Dias + ' Pases por 2 dias');
                    }
                    if(boletoCompleto >= 1) {
                        listadoProductos.push(boletoCompleto + ' Pases completos');
                    }
                    if(cantCamisas >= 1) {
                        listadoProductos.push(cantCamisas + ' Camisas');
                    }
                    if(cantEtiquetas >= 1) {
                        listadoProductos.push(cantEtiquetas + ' Etiquetas');
                    }
                    
                    lista_productos.style.display = 'block';
                    lista_productos.innerHTML = ''; // Se lo define vacio primero para q al hacer cambios en las cantidad no se vuelva a escribir todo de nuevo.
                    for(var i = 0; i < listadoProductos.length; i++) {
                        lista_productos.innerHTML += listadoProductos[i] + '<br/>'; // El mayor igual es para concatenar el resultado de cada iteracion con la siguiente.
                    }
                    suma.innerHTML = '$ ' + totalPagar.toFixed(2); // toFixed para redondear a dos decimales.

                    botonRegistro.disabled = false; // registro.php
                    document.getElementById('total_pedido').value = totalPagar;
                }
            }

            function mostrarDias() {
                var boletosDia = parseInt(pase_dia.value, 10) || 0,
                    boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
                    boletoCompleto = parseInt(pase_completo.value, 10) || 0;

                    var diasElegidos = [];

                    if(boletosDia > 0) {
                        diasElegidos.push('viernes');
                    }
                    if(boletos2Dias > 0) {
                        diasElegidos.push('viernes', 'sabado');
                    }
                    if(boletoCompleto > 0) {
                        diasElegidos.push('viernes', 'sabado', 'domingo');
                    }
                    for(var i = 0; i < diasElegidos.length; i++) {
                        document.getElementById(diasElegidos[i]).style.display = 'block'; // Dias elegidos contiene el id del div que quiero mostrar.
                    }
            }
    } // If para eliminar errores preguntando por un elemento que sabemos que existe.    

    }); // DOM CONTENT LOADED
})();
