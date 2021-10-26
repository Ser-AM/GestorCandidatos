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
    $("#editar-perfil").click(function(){
        $("select").prop('disabled', false);
        $("input").prop('disabled', false);
        $("textarea").prop('disabled', false);
    })
});