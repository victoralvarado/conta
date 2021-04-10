$(document).ready(function(){
    //Exentas
    $(document).on("input", "#importacionE", function () {
        var exentas = $("#internasE");
        var gravadas = $(".gravadas");
        var vacio = $(this).prop('value') > 0;
        $('.gravadas').attr('required', 'false');
        $('#internasE').attr('required', 'false');
        var neto = parseFloat($("#importacionE").val());
        calculo(neto);
        exentas.prop('disabled', vacio);
        gravadas.prop('disabled', vacio);
    });
    $(document).on("input","#internasE",function(){
        var exentas = $( "#importacionE" );
        var gravadas = $(".gravadas");
        var vacio = $(this ).prop( 'value' ) > 0;
        $('.gravadas').attr('required','false');
        $('#importacionE').attr('required','false');
        var neto = parseFloat($("#internasE").val());
        calculo(neto);
        exentas.prop('disabled', vacio);
        gravadas.prop('disabled', vacio);
    });
    //GRAVADAS
    $(document).on("input","#importacionG",function(){
        var gravadas = $( "#internasG" );
        var exentas = $(".exentas");
        var vacio = $(this ).prop( 'value' ) > 0;
        $('.exentas').attr('required','false');
        $('#internasG').attr('required','false');
        var neto = parseFloat($("#importacionG").val());
        calculo(neto);
        exentas.prop('disabled', vacio);
        gravadas.prop('disabled', vacio);
    });
    $(document).on("input","#internasG",function(){
        var gravadas = $( "#importacionG" );
        var exentas = $(".exentas");
        var vacio = $(this ).prop( 'value' ) > 0;
        $('.exentas').attr('required','false');
        $('#importacionG').attr('required','false');
        var neto = parseFloat($("#internasG").val());
        calculo(neto);
        exentas.prop('disabled', vacio);
        gravadas.prop('disabled', vacio);
    });
    function calculo(cal){
        if (isNaN(cal)) {
            ivaCF = 0;
            ivaP = 0;
            totalCom = 0;
        } else {
            ivaCF = 0.13 * cal;
            ivaP = 0.01 * cal;
            totalCom = ivaCF + ivaP + cal;
        }
        $('#ivaCF').attr('value', ivaCF);
        $('#ivaP').attr('value', ivaP);
        $('#totalCom').attr('value', totalCom);
    }
});