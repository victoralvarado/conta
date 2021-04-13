$(document).ready(function () {
    $('#tblCompras').DataTable();
    $(document).on("input", ".com", function () {
        if ($("#clasificacion").val().trim() == '') {
            $('.alert').text('Seleccione un contribuyente');
        } else {
            $('.alert').text('');
        }
        var sum = 0;
        var ivaCF = 0;
        var ivaP = 0;
        var imG = parseFloat($("#importacionG").val());
        var inG = parseFloat($("#internasG").val());
        var imE = parseFloat($("#importacionE").val());
        var inE = parseFloat($("#internasE").val());
        if (isNaN(imG)) {
            imG = 0;
            $('#importacionG').val(imG);
        } else {
            imG = parseFloat($("#importacionG").val());
            $('#importacionG').val(imG);
        } if (isNaN(inG)) {
            inG = 0;
            $('#internasG').val(inG);
        } else {
            inG = parseFloat($("#internasG").val());
            $('#internasG').val(inG);
        } if (isNaN(imE)) {
            imE = 0;
            $('#importacionE').val(imE);
        } else {
            imE = parseFloat($("#importacionE").val());
            $('#importacionE').val(imE);
        } if (isNaN(inE)) {
            inE = 0;
            $('#internasE').val(inE);
        } else {
            inE = parseFloat($("#internasE").val());
            $('#internasE').val(inE);
        }
        if (isNaN(parseFloat($(".com").val()))) {
            ivaCF = 0;
            $('#internasE').val(ivaCF);
        } else {
            ivaCF = (inG + imG) * 0.13;
            //dependiendo de la clasificacion del proveedor se aplicara la retencion
            var clasificacion = $("#clasificacion").val();
            if (clasificacion != 'Gran Contribuyente' && clasificacion != 'Ninguno') {
                if ((inG + imG) > 100) {
                    ivaP = (inG + imG) * 0.01;
                } else {
                    ivaP = 0;
                }
            }
            sum = (inG + imG + imE + inE + ivaCF) + ivaP;
            $('#ivaCF').val(ivaCF);
            $('#ivaP').val(ivaP);
            $('#totalCom').val(sum);
        }
    });
    $(document).on('change', '#contribuyente ', function() {
        if ($("#contribuyente ").val() != '') {
              $.ajax({
                url: './controller/proveedorController.php',
                type: 'post',
                data: { text: $("#contribuyente ").children(":selected").attr("id")},
                success: function(response) { $('#clasificacion').val(response); $('.alert').text('');}
            });
        } else {
            $('.alert').text('Seleccione un contribuyente');
            $('#clasificacion').val('');
        }
            
   });
});