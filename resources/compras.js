$(document).ready(function () {
    $('#tblCompras').DataTable();
    $(document).on("change", "#tCompra", function () {
        if ($("#tCompra").val().trim() == '') {
            $("#internasG").val(0.00);
            $("#importacionE").val(0.00);
            $("#internasE").val(0.00);
            $("#importacionG").val(0.00);
            $('#ivaCF').val(0.00);
            $('#ivaR').val(0.00);
            $('#totalCom').val(0.00);
            $('.alert').text('Seleccione un tipo de compra');
        } else {
            $('.alert').text('');

            const iva = 0.13;
            const retencion = 0.01;
            var sum = 0.00;
            var ivaCF = 0.00;
            var ivaR = 0.00;
            var imE = 0.00;
            var inE = 0.00;
            var imG = 0.00;
            var inG = 0.00;
            var idC = $("#tCompra").children(":selected").attr("id");
            if (idC == 'c1') {
                imE = parseFloat($("#cp").val());
                if (isNaN(imE)) {
                    imE = 0.00;
                    $('#importacionE').val(imE);
                } else {
                    $("#importacionE").val(imE.toFixed(2));
                    $("#internasE").val(0.00);
                    $("#importacionG").val(0.00);
                    $("#internasG").val(0.00);
                }
            } if (idC == 'c2') {
                inE = parseFloat($("#cp").val());
                if (isNaN(inE)) {
                    inE = 0.00;
                    $('#internasE').val(inE);
                } else {
                    $("#internasE").val(inE.toFixed(2));
                    $("#importacionE").val(0.00);
                    $("#importacionG").val(0.00);
                    $("#internasG").val(0.00);
                }
            } if (idC == 'c3') {
                imG = parseFloat($("#cp").val());
                if (isNaN(imG)) {
                    inG = 0.00;
                    $('#importacionG').val(imG);
                } else {
                    $("#importacionG").val(imG.toFixed(2));
                    $("#importacionE").val(0.00);
                    $("#internasE").val(0.00);
                    $("#internasG").val(0.00);
                }
            } if (idC == 'c4') {
                inG = parseFloat($("#cp").val());
                if (isNaN(imG)) {
                    inG = 0.00;
                    $('#internasG').val(inG);
                } else {
                    $("#internasG").val(inG.toFixed(2));
                    $("#importacionE").val(0.00);
                    $("#internasE").val(0.00);
                    $("#importacionG").val(0.00);
                }
            }
            if (isNaN(parseFloat($(".com").val()))) {
                ivaCF = 0.00;
                $('#ivaCF').val(ivaCF);
            } else {
                ivaCF = (inG + imG) * iva;
                //dependiendo de la clasificacion del proveedor se aplicara la retencion
                var clasificacion = $("#clasificacion").val();
                if (clasificacion != 'Gran Contribuyente') {
                    if ((inG + imG) > 100) {
                        ivaR = (inG + imG) * retencion;
                    } else {
                        ivaR = 0.00;
                    }
                } if (clasificacion == '') {
                    $('.alert').text('Seleccione un contribuyente');
                } else {
                    $('.alert').text('');
                    sum = (inG + imG + imE + inE + ivaCF) - ivaR;
                    $('#ivaCF').val(ivaCF.toFixed(2));
                    $('#ivaR').val(ivaR.toFixed(2));
                    $('#totalCom').val(sum.toFixed(2));
                }
            }

        }
    });
    $(document).on('change', '#contribuyente', function () {
        $("#internasG").val(0.00);
        $("#importacionE").val(0.00);
        $("#internasE").val(0.00);
        $("#importacionG").val(0.00);
        $('#ivaCF').val(0.00);
        $('#ivaR').val(0.00);
        $('#totalCom').val(0.00);
        if ($("#contribuyente ").val() != '') {
            $("#tCompra").val('');
            $.ajax({
                url: './controller/proveedorController.php',
                type: 'post',
                data: { text: $("#contribuyente").children(":selected").attr("id") },
                success: function (response) {
                    if (response == 'Ninguno') {
                        $('#excluido').val($('#cp').val());
                        $('#tCompra').attr('disabled', true);
                        $('#spTipo').text('Compra a sujeto excluido');
                        $('#spTipo').attr('style', 'color:green;');
                    } else {
                        $('#excluido').val(0.00);
                        $('#tCompra').attr('disabled', false);
                        $('#spTipo').text('');
                    }

                    $('#clasificacion').val(response);
                    var id = $("#contribuyente").children(":selected").attr("id");
                    if (id == '-') {
                        $('#nrcProveedor').val('');
                    } else {
                        $('#nrcProveedor').val(id);
                    }
                }
            });
        } else {
            $('#spTipo').attr('style', 'color:red;');
            $('#tCompra').attr('disabled', true);
            $('.com').val(0.00);
            $('#ivaCF').val(0.00);
            $('#ivaR').val(0.00);
            $('#totalCom').val(0.00);
            $('excluido').val(0.00);
            $('#spTipo').text('Seleccione un contribuyente');
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
        $("#tCompra").val('');
        $("#internasG").val(0.00);
        $("#importacionE").val(0.00);
        $("#internasE").val(0.00);
        $("#importacionG").val(0.00);
        $('#ivaCF').val(0.00);
        $('#ivaR').val(0.00);
        $('#totalCom').val(0.00);
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
            $('#cp').val(mul.toFixed(2));
            var clasificacion = $("#clasificacion").val();
            if (clasificacion == 'Ninguno') {
                $('#excluido').val(mul.toFixed(2));
            } else {
                $('#excluido').val(0.00);
            }
        }

    });
});