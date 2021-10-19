$(function() {
    // Lettering (Efecto del titulo)
    $('.nombre-sitio').lettering();

    // Agregar clase a Menu
    $('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');

    // Menu fijo
    var windowsHeight = $(window).height(); // Obtener la altura de la venta cuando se agranda o achica la ventana.
    var barraAltura = $('.barra').innerHeight(); // Obtener altura de un elemento (barra) cuando se agranda o achica la ventana.
    //console.log(barraAltura);

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if(scroll > windowsHeight) {
            $('.barra').addClass('fixed');
            $('body').css({'margin-top': barraAltura+'px'}); // Eliminar salto en la barra al hacer scroll.
        } else {
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top': '0px'}); // Eliminar salto en la barra al hacer scroll.
        }
    });

    // Menu Movil
    $('.menu-movil').on('click', function() {
        $('.navegacion-principal').slideToggle(); // Ocultar y mostrar al hacer click.
    });

    // Programa de conferencias
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').on('click', function() {
        $('.menu-programa a').removeClass('activo'); // Elimina la clase activo de todos los enlaces.
        $(this).addClass('activo'); // La agrega al enlace sobre el que se hizo click.
        $('.ocultar').hide(); // Oculta todos los div.
        var enlace = $(this).attr('href'); // Obtiene la url del enlace sobre el que se hizo click.
        $(enlace).fadeIn(1000); // Muestra en div apuntado por el enlace.
        return false;

    });

    // Animaciones para los numeros
    $('.resumen-evento li:nth-child(1) p').animateNumber({number: 6}, 1200); // (numero final, tiempo)
    $('.resumen-evento li:nth-child(2) p').animateNumber({number: 15}, 1200);
    $('.resumen-evento li:nth-child(3) p').animateNumber({number: 3}, 1500);
    $('.resumen-evento li:nth-child(4) p').animateNumber({number: 9}, 1500);

    // Cuenta Regresiva
    $('.cuenta-regresiva').countdown('2021/12/10 09:00:00', function(event) {
        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));
    });

    // Colorbox
    $('.invitado-info').colorbox({inline:true, width: "50%"});
    $('.boton-newsletter').colorbox({inline:true, width: "50%"});
});