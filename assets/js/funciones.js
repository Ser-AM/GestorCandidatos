$(document).ready(function() {
    $("select.especialidad").change(function(){
        var optionValue = $(this).val();
        $(".bloque-especialidad").hide();
        $(".bloque-especialidad." + optionValue).show();
        $(".bloque-especialidad." + optionValue).css("display", "block");
        $('.programa').prop('selectedIndex',0);
        $('.experiencia').prop('selectedIndex',0);
    });
});