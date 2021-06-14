$(document).ready(function() {

    $(document).on("click", "#limpiarUser", function() {
        $("#nombre").val("");
        $("#user").val("");
        $("#pass").val("");
        $("#repass").val("");
    });

    $(document).on("click", "#agregarUser", function() {
        swal({
            title: "Exito!",
            text: "Se ha registrado correctamente en el sistema",
            timer: 3000,
            type: 'success',
            closeOnConfirm: true,
            closeOnCancel: true,
            allowOutsideClick: false
        });
    });

    $(document).on("change", "#repass", function() {
        if ($("#pass").val() != $("#repass").val()) {
            swal({
                title: "¡Error!",
                text: "Las contraseñas no son iguales\nVuelva a escribir las contraseñas",
                timer: 3000,
                type: 'error',
                closeOnConfirm: true,
                closeOnCancel: true
            });
            $("#pass").val("");
            $("#repass").val("");
        } else {

        }
    });

});