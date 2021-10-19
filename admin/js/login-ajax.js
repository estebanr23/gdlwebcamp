// Login
$(document).ready(function() {
    // Id del formulario
    $('#login-admin').on('submit', function(e) {
        e.preventDefault(); 

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'), 
            data: datos, 
            url: $(this).attr('action'), 
            dataType: 'json', 
            success: function(data) { 
                var resultado = data;
                if(resultado.respuesta == 'exitoso') {
                    swal(
                        'Login Correcto',
                        'Bienvenid@ '+resultado.usuario+' !! ',
                        'success'
                    )
                    // setTimeout ejecuta una funcion luego de un cierto tiempo. 2000 = 2seg
                    setTimeout(function() {
                        window.location.href = 'admin-area.php';
                    }, 2000);
                } else {
                    swal(
                        'Login Correcto',
                        'Usuario o password incorrectos',
                        'error'
                    )
                }
            }    
        })
    });
})
    