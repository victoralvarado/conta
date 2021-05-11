$(document).ready(function () {
    $(document).on("input", ".edit", function () {
        var boton = $(".editarProveedor");
        var vacio = $(this).prop('value').trim() == '';
        boton.prop('disabled', vacio);
    });
    $('input[name=nit]').mask('9999-999999-999-9');
    $('input[name =nrc]').mask('999999-9');
    $('#nrc').keyup(function () {
        $.ajax({
            url: './controller/proveedorController.php',
            type: 'post',
            data: { nrcsql: $("#nrc").val() },
            success: function (response) {
                if (response == $("#nrc").val()) {
                    $('#existe').text('El NRC ya esta en uso');
                    $('#agregarProveedor').prop('disabled',true);
                } else {
                    $('#existe').text('');
                    $('#agregarProveedor').prop('disabled',false);
                }
            }
        });

    });
    $('#nit').keyup(function () {
        $.ajax({
            url: './controller/proveedorController.php',
            type: 'post',
            data: { nitsql: $("#nit").val() },
            success: function (response) {
                if (response == $("#nit").val()) {
                    $('#existeNit').text('El NIT ya esta en uso');
                    $('#agregarProveedor').prop('disabled',true);
                } else {
                    $('#existeNit').text('');
                    $('#agregarProveedor').prop('disabled',false);
                }
            }
        });

    });
});