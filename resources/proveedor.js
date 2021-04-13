$(document).ready(function () {
    $(document).on("click", "#eliminar", function () {
        swal({
            title: "Eliminar",
            text: "¿Estás seguro que desea eliminar el proveedor?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Continuar",
            closeOnConfirm: false
        },
            function (isConfirm) {
                if (isConfirm) {
                    swal({
                        title: "Eliminado",
                        text: "Eliminaste el registro!",
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        $("#eliEdi").submit();
                    }, 1100);
                }
            });
    });
    $(document).on("click", "#editarProveedor", function () {
        swal({
            title: "Editar",
            text: "¿Estás seguro que desea editar el proveedor?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Continuar",
            closeOnConfirm: false
        },
            function (isConfirm) {
                if (isConfirm) {
                    swal({
                        title: "Modificado",
                        text: "Modificaste el registro!",
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        $("#editar").submit();
                    }, 1100);
                }
            });
    });
    $(document).on("input", ".edit", function () {
        var boton = $("#editarProveedor");
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
                } else {
                    $('#existe').text('');
                }
            }
        });

    });
    $('#nrcEdit').keyup(function () {
        $.ajax({
            url: './controller/proveedorController.php',
            type: 'post',
            data: { nrcsql: $("#nrcEdit").val() },
            success: function (response) {
                if (response == $("#nrcEdit").val() && response != $("#nrcActual").val()) {
                    $('#existeEdit').text('El NRC ya esta en uso');
                } else if (response == $("#nrcActual").val()) {
                    $('#existeActual').text('Es su NRC actual');
                } else {
                    $('#existeEdit').text('');
                    $('#existeActual').text('');
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
                } else {
                    $('#existeNit').text('');
                }
            }
        });

    });
    $('#nitEdit').keyup(function () {
        $.ajax({
            url: './controller/proveedorController.php',
            type: 'post',
            data: { nitsql: $("#nitEdit").val() },
            success: function (response) {
                if (response == $("#nitEdit").val() && response != $("#nitActual").val()) {
                    $('#existeEditNit').text('El NIT ya esta en uso');
                } else if (response == $("#nitActual").val()) {
                    $('#existeActualNit').text('Es su NIT actual');
                } else {
                    $('#existeEditNit').text('');
                    $('#existeActualNit').text('');
                }
            }

        });
    });
});