$(document).ready(function () {
    $(document).on("input", ".edit", function () {
        var boton = $(".editarProducto");
        var vacio = $(this).prop('value').trim() == '';
        boton.prop('disabled', vacio);
    });
    $('#codigo').keyup(function () {
        $.ajax({
            url: './controller/productoController.php',
            type: 'post',
            data: { codigop: $("#codigo").val() },
            success: function (response) {
                if (response == $("#codigo").val() && response!= '') {
                    $('#existecodigo').text('El codigo ya esta en uso');
                    $('#agregarProducto').prop('disabled',true);
                } else {
                    $('#existecodigo').text('');
                    $('#agregarProducto').prop('disabled',false);
                }
            }
        });

    });
});