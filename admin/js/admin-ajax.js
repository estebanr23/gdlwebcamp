$(document).ready(function() {
    $('#guardar_registro').on('submit', function(e) {
        e.preventDefault(); // Anula el comportamiento por default del action del formulario para que no abra la ventana al enviar el form.

        // Esta funcion itera sobre todos los campos del formulario y crea un objeto con atributos para cada input.
        var datos = $(this).serializeArray();

        // Llamado a ajax en jquery
        $.ajax({
            type: $(this).attr('method'), // Tipo de request utilizado. (this) hace referencia al atributo method="POST" del formulario.
            data: datos, // Datos a enviar a ajax.
            url: $(this).attr('action'), // A donde de van a enviar. (this) hace referencia al atributo action="insertar-admin" del formulario.
            dataType: 'json', // Tipo de dato a usar.
            success: function(data) { // Cuando la llamada sea exitosa que realice una accion.
                var resultado = data; // data es la respuesta devuelta por el servidor.
                if(resultado.respuesta == 'exito') {
                    swal(
                        'Correcto',
                        'Se guardo correctamente',
                        'success'
                      )
                } else {
                    swal(
                        'Error!',
                        'Hubo un error',
                        'error'
                    )
                }
            }    
        })
    });

    // Se ejecuta cuando hay un archivo
    $('#guardar-registro-archivo').on('submit', function(e) {
        e.preventDefault(); 

        var datos = new FormData(this); // Crea un objeto FormDate con llave y valor con todos los datos del formulario.

        // Llamado a ajax en jquery
        $.ajax({
            type: $(this).attr('method'), 
            data: datos, 
            url: $(this).attr('action'), 
            dataType: 'json', 
            contentType: false, // Cuando se trabaja con archivos agregar estos datos.
            processData: false,
            async: true,
            cache: false,
            success: function(data) { 
                var resultado = data; 
                if(resultado.respuesta == 'exito') {
                    swal(
                        'Correcto',
                        'Se guardo correctamente',
                        'success'
                      )
                } else {
                    swal(
                        'Error!',
                        'Hubo un error',
                        'error'
                    )
                }
            }    
        })
    });

    // Eliminar registros
    $('.borrar_registro').on('click', function(e) {
        e.preventDefault(); 
        
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');

        swal({
            title: 'Estas seguro?',
            text: "Un registro eliminado no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
                if(result.value) {
                    $.ajax({ // ajax permite enviar datos al servidor por medio del metodo POST aunque no haya un formulario.
                        type:'post',
                        data: {
                            id: id,
                            registro: 'eliminar'
                        },
                        url: 'modelo-'+tipo+'.php',
                        success:function(data) {
                            var resultado = JSON.parse(data); // Convierte el array en un objeto JavaScript.
                            if(resultado.respuesta == 'exito') {
                                swal(
                                    'Eliminado',
                                    'Registro Eliminado.',
                                    'success'
                                )
                                // Permite eliminar un registro sin recargar la pagina con JQuery.
                                jQuery('[data-id="'+ resultado.id_eliminado +'"]').parents('tr').remove();
                            } else {
                                swal(
                                    'Error!',
                                    'No se pudo eliminar',
                                    'error'
                                )
                            }
                        }
                    }) // ajax
                    
                } // if  

          }); //then

    }); //.borrar-registro

});
