$(document).ready(function () {
    $(document).on("input", ".com", function () {
        var sum = 0;
        var ivaCF = 0;
        var ivaP = 0;
        var imG = parseFloat($("#importacionG").val());
        var inG = parseFloat($("#internasG").val());
        var imE = parseFloat($("#importacionE").val());
        var inE = parseFloat($("#internasE").val());
        if (isNaN(imG)) {
            imG = 0;
            $('#importacionG').attr('value', imG);
        } else {
            imG = parseFloat($("#importacionG").val());
            $('#importacionG').attr('value', imG);
        } if (isNaN(inG)) {
            inG = 0;
            $('#internasG').attr('value', inG);
        } else {
            inG = parseFloat($("#internasG").val());
            $('#internasG').attr('value', inG);
        } if (isNaN(imE)) {
            imE = 0;
            $('#importacionE').attr('value', imE);
        } else {
            imE = parseFloat($("#importacionE").val());
            $('#importacionE').attr('value', imE);
        } if (isNaN(inE)) {
            inE = 0;
            $('#internasE').attr('value', inE);
        } else {
            inE = parseFloat($("#internasE").val());
            $('#internasE').attr('value', inE);
        }
        if (isNaN(parseFloat($(".com").val()))) {
            ivaCF = 0;
            $('#internasE').attr('value', ivaCF);
        } else {
            ivaCF = (inG + imG) * 0.13;
            //dependiendo de la clasificacion del proveedor se aplicara la retencion
            var clasificacion = $("#clasificacion").val();
            if (clasificacion != 'gran contribuyente' && clasificacion != 'ninguno') {
                if ((inG + imG) > 100) {
                    ivaP = (inG + imG) * 0.01;
                } else {
                    ivaP = 0;
                }
            }
            sum = (inG + imG + imE + inE + ivaCF) + ivaP;
            $('#ivaCF').attr('value', ivaCF);
            $('#ivaP').attr('value', ivaP);
            $('#totalCom').attr('value', sum);
        }
    });
});