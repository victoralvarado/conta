$(document).ready(function() {
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
            success: function(response) {
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
            success: function(response) {
                $('#nitProveedor').val(response);
            }
        });
    } else {
        $('#nitProveedor').val('');
    }
    var tc = $("#tipocompraval").val();
    var l = tc.length;
    if (tc.substr(0, 2) == 'c5') {
        $("#tCompra").val('');
    } else {
        $("#tCompra").val(tc.substr(0, 2));
    }
    if (tc.substr(0, 2) == 'c1') {
        $("#importacionE").val(tc.substr(2, l));
    } else {
        $("#importacionE").val(0.00);
    }
    if (tc.substr(0, 2) == 'c2') {
        $("#internasE").val(tc.substr(2, l));
    } else {
        $("#internasE").val(0.00);
    }
    if (tc.substr(0, 2) == 'c3') {
        $("#importacionG").val(tc.substr(2, l));
    } else {
        $("#importacionG").val(0.00);
    }
    if (tc.substr(0, 2) == 'c4') {
        $("#internasG").val(tc.substr(2, l));
    } else {
        $("#internasG").val(0.00);
    }

    $('#ivaCF').val($('#ivaCFTemp').val());
    $('#ivaR').val($('#ivaRTemp').val());
    $('#ivaCF').val($('#ivaCFTemp').val());
    $('#totalCom').val($('#totalComTemp').val());

    $(document).on("click", "#modificarCompra", function() {
        swal({
                title: "Modificar",
                text: "¿Estás seguro que deseas modificar la compra?",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Continuar",
                closeOnConfirm: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    swal({
                        title: "Modificado",
                        text: "Modificaste la compra!",
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        $("#modificar").submit();
                    }, 1100);
                }
            });
    });
});