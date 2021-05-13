$(document).ready(function(){

/////////////////////////////////////////////AGREGAR CLIENTE//////////////////////////////////////////////////////
$(document).on("click","#agregarCliente",function(){

    var clasi = $("#clasificacion").val();
    var nit = $("#nit").val();
    var nrc = $("#nrc").val();
    var nombre = $("#nombre").val();
    var rs = $("#razonsocial").val();
    var giro = $("#giro").val();
    var direccion = $("#direccion").val();
    var tel = $("#telefono").val();

        if(clasi != "0" && nit != "" && nrc != "" && nombre != "" && rs != "" && giro != "" && direccion != "" && tel != "")
        {
          $.ajax({
          type: 'POST',
          async: false,
          dataType: 'json',
          data: {key: 'saveCliente', clasi:clasi, nit:nit, nrc:nrc, nombre:nombre, rs:rs, giro:giro, direccion:direccion, tel:tel},
          url: 'controller/clienteController.php',
          success: function(res)
          {
            if(res.estado!=false)
            {
              swal({
                  title: "Exito!",
                  text: "El cliente se agrego correctamente",
                  timer: 1500,
                  type: 'success',
                  closeOnConfirm: true,
                  closeOnCancel: true,
                  allowOutsideClick: false
              });
              setTimeout( function(){ 
              location.reload();
              }, 1000 );

            }
            else
            {
              swal({
              title: "Error",
              text: "Error al agregar cliente, "+res.descripcion,
              timer: 1500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
            }
          },
          error: function(xhr, status)
          {
              //console.log('error :c');
              swal({
              title: "Error de AJAX",
              text: "error :c, \n"+xhr+"\n"+status,
              timer: 1500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
          }
        });
        }
        else
        {
          swal({
              title: "Error",
              text: "Llene todos los campos y vuelva a intentarlo",
              timer: 1500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
        }


  });
/////////////////////////////////////////////AGREGAR CLIENTE//////////////////////////////////////////////////////

});