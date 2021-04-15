$(document).ready(function () {
    $('#tblCompras').DataTable();
    $(document).on("input", ".com", function () {
        if ($("#clasificacion").val().trim() == '') {
            $('.alert').text('Seleccione un contribuyente');
        } else {
            $('.alert').text('');
        }
        const iva = 0.13;
        const retencion = 0.01;
        var sum = 0.0000;
        var ivaCF = 0.0000;
        var ivaR = 0.0000;
        var imG = parseFloat($("#importacionG").val());
        var inG = parseFloat($("#internasG").val());
        var imE = parseFloat($("#importacionE").val());
        var inE = parseFloat($("#internasE").val());
        if (isNaN(imG)) {
            imG = 0.0000;
            $('#importacionG').val(imG);
        } else {
            imG = parseFloat($("#importacionG").val());
            $('#importacionG').val(imG);
        } if (isNaN(inG)) {
            inG = 0.0000;
            $('#internasG').val(inG);
        } else {
            inG = parseFloat($("#internasG").val());
            $('#internasG').val(inG);
        } if (isNaN(imE)) {
            imE = 0.0000;
            $('#importacionE').val(imE);
        } else {
            imE = parseFloat($("#importacionE").val());
            $('#importacionE').val(imE);
        } if (isNaN(inE)) {
            inE = 0.0000;
            $('#internasE').val(inE);
        } else {
            inE = parseFloat($("#internasE").val());
            $('#internasE').val(inE);
        }
        if (isNaN(parseFloat($(".com").val()))) {
            ivaCF = 0.0000;
            $('#ivaCF').val(ivaCF);
        } else {
            ivaCF = (inG + imG) * iva;
            //dependiendo de la clasificacion del proveedor se aplicara la retencion
            var clasificacion = $("#clasificacion").val();
            if (clasificacion != 'Gran Contribuyente') {
                if ((inG + imG) > 100) {
                    ivaR = (inG + imG) * retencion;
                } else {
                    ivaR = 0.0000;
                }
            } if (clasificacion == '') {
                $('.com').attr('disabled', true);
                $('.com').val(0);
            } else {

                sum = (inG + imG + imE + inE + ivaCF) - ivaR;
                $('#ivaCF').val(ivaCF.toFixed(4));
                $('#ivaR').val(ivaR.toFixed(4));
                $('#totalCom').val(sum.toFixed(4));
            }
        }
    });
    $(document).on('change', '#contribuyente', function () {
        if ($("#contribuyente ").val() != '') {
            $('.com').attr('disabled', false);
            $.ajax({
                url: './controller/proveedorController.php',
                type: 'post',
                data: { text: $("#contribuyente").children(":selected").attr("id") },
                success: function (response) {
                    $('#clasificacion').val(response);
                    $('.alert').text('');
                    var id = $("#contribuyente").children(":selected").attr("id");
                    if (id == '-') {
                        $('#nrcProveedor').val('');
                    } else {
                        $('#nrcProveedor').val(id);
                    }
                }
            });
        } else {
            $('.com').attr('disabled', true);
            $('.com').val(0);
            $('#ivaCF').val(0.0000);
            $('#ivaR').val(0.0000);
            $('#totalCom').val(0.0000);
            $('.alert').text('Seleccione un contribuyente');
            $('#nrcProveedor').val('');
            $('#clasificacion').val('');
        }

        if ($("#contribuyente ").val() != '') {
            $.ajax({
                url: './controller/proveedorController.php',
                type: 'post',
                data: { nitP: $("#contribuyente").children(":selected").attr("id") },
                success: function (response) {
                    $('#nitProveedor').val(response);
                }
            });
        } else {
            $('#nitProveedor').val('');
        }
    });
    $(document).on("input", ".mul", function () {
        var mul = 0;
        var cantidad = parseFloat($('#cantidad').val());
        var precio = parseFloat($('#precio').val());
        if (isNaN(cantidad)) {
            cantidad = 0;
            $('#cantidad').val(cantidad);
        } else {
            cantidad = parseFloat($('#cantidad').val());
            $('#cantidad').val(cantidad);
        } if (isNaN(precio)) {
            precio = 0;
            $('#precio').val(precio);
        } else {
            precio = parseFloat($('#precio').val());
            $('#precio').val(precio);
        } if (isNaN($('.mul').val())) {
            mul = 0;
            $('#cp').val(mul);
        } else {
            mul = precio * cantidad;
            $('#cp').val(mul.toFixed(4));
        }
    });
});