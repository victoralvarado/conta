$(document).ready(function () {
    $(document).on("input", ".edit", function () {
        var boton = $(".editarProducto");
        var vacio = $(this).prop('value').trim() == '';
        boton.prop('disabled', vacio);
    });
});