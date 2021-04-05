$(document).ready(function(){
    $(document).on("click","#eliminar",function(){
        swal({
        title: "Eliminar",
        text: "¿Estás seguro que desea eliminar el producto?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuar",
        closeOnConfirm: false
        },
        function (isConfirm) {
            if(isConfirm){
                swal({
                    title: "Eliminado",
                    text: "Eliminaste el registro!",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false
                });
                setTimeout(function(){
                    $("#eliEdi").submit();
                },1100);
            }
        });
	});
    $(document).on("click","#editarPro",function(){
        swal({
        title: "Editar",
        text: "¿Estás seguro que desea editar el producto?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuar",
        closeOnConfirm: false
        },
        function (isConfirm) {
            if(isConfirm){
                swal({
                    title: "Modificado",
                    text: "Modificaste el registro!",
                    type: "success",
                    showCancelButton: false,
                    showConfirmButton: false
                });
                setTimeout(function(){
                    $("#editar").submit();
                },1100);
            }
        });
	});
    $(document).on("input",".edit",function(){
        var boton = $( "#editarProducto" );
        var vacio = $(this ).prop( 'value' ).trim() == '';
        boton.prop('disabled', vacio);
    });
});