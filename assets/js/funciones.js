$(document).ready(function() {
    $("select.especialidad").change(function(){
        var optionValue = $(this).val();
        $(".bloque-inicial").hide();
        $(".bloque-especialidad").hide();
        $(".bloque-especialidad." + optionValue).show();
        $(".bloque-especialidad." + optionValue).css("display", "block");
        $('.programa').prop('selectedIndex',0);
        $('.experiencia').prop('selectedIndex',0);
    });

    $( '#titulo-checkbox' ).change(function() {
        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            $(".input-radio").prop('disabled', false);
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            $(".input-radio").prop('disabled', true);
        }
    });
});