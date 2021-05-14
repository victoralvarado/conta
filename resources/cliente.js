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
/////////////////////////////////////////////FIN AGREGAR CLIENTE//////////////////////////////////////////////////////

$(document).on("click",".editar", function(){
    var idCliente = $(this).attr('id');
    var selectIndex = 0;
    $.ajax({
      type: 'POST',
      async: false,
      dataType: 'json',
      data: {key: 'cargarDatosCliente', idCliente:idCliente},
      url: 'controller/clienteController.php',
      success: function(res)
      {
        if(res.estadoSen==true)
        {
        $("#idClienteEdit").val(res.id);
        if(res.clasificacion=='ninguno')
        {
          selectIndex=1;
        }
        else if(res.clasificacion=='pequeño')
        {
          selectIndex=2;
        }
        else if(res.clasificacion=='mediano')
        {
          selectIndex=3;
        }
        else if(res.clasificacion=='gran contribuyente')
        {
          selectIndex=4;
        }
        $("#clasificacionEdit").val(selectIndex);
        $("#nombreEdit").val(res.nombre);
        $("#nitEdit").val(res.nit);
        $("#nrcEdit").val(res.nrc);
        $("#direccionEdit").val(res.direccion);
        $("#razonsocialEdit").val(res.razon_social);
        $("#giroEdit").val(res.giro);
        $("#telefonoEdit").val(res.telefono);
        $("#modalModCliente").modal({backdrop: 'static', keyboard: false});
        }
      },
      error: function(xhr, status)
      {
          console.log('error :c');
      }

    });
});

/////////////////////////////////////////////MOD CLIENTE//////////////////////////////////////////////////////
$(document).on("click","#modCliente",function(){

    var clasi = $("#clasificacionEdit").val();
    var nit = $("#nitEdit").val();
    var nrc = $("#nrcEdit").val();
    var nombre = $("#nombreEdit").val();
    var rs = $("#razonsocialEdit").val();
    var giro = $("#giroEdit").val();
    var direccion = $("#direccionEdit").val();
    var tel = $("#telefonoEdit").val();
    var id = $("#idClienteEdit").val();

        if(clasi != "0" && nit != "" && nrc != "" && nombre != "" && rs != "" && giro != "" && direccion != "" && tel != "")
        {
          $.ajax({
          type: 'POST',
          async: false,
          dataType: 'json',
          data: {key: 'modiCliente', clasi:clasi, nit:nit, nrc:nrc, nombre:nombre, rs:rs, giro:giro, direccion:direccion, tel:tel, id:id},
          url: 'controller/clienteController.php',
          success: function(res)
          {
            if(res.estado!=false)
            {
              swal({
                  title: "Exito!",
                  text: "El cliente se modificó correctamente",
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
              text: "Error al modificar cliente, "+res.descripcion,
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
/////////////////////////////////////////////FIN MOD CLIENTE//////////////////////////////////////////////////////

/////////////////////////////////////////////DELETE CLIENTE//////////////////////////////////////////////////////
$(document).on("click",".eliminar",  function(){   

    var idCliente = $(this).attr('id');

                                      swal({
                                                    title: "Advertencia",
                                                    text: "¿Está seguro de cambiar el estado de pago de este usuario?",
                                                    type: "warning",
                                                    showCancelButton: true,
                                                    cancelButtonText: "No",
                                                    confirmButtonText: "Sí",
                                                    confirmButtonColor: "#00A59D",
                                                    closeOnConfirm: true,
                                                    closeOnCancel: true
                                                },
                                function (isConfirm) {
                                  if (isConfirm) {
                                    $.ajax({
                                          type: 'POST',
                                          async: false,
                                          dataType: 'json',
                                          data: {key:"elimiCliente", idCliente:idCliente},
                                          url: "controller/clienteController.php",
                                          success: function (data)
                                          {
                                            if (data.estado==true) {
                                          setTimeout( function(){ 
                                          swal({
                                                  title: "¡Éxito!",
                                                  text: data.descripcion,
                                                  timer: 2000,
                                                  type: 'success',
                                                  closeOnConfirm: true,
                                                          closeOnCancel: true
                                                });
                                          }, 2000 );
                                          setTimeout( function(){ 
                                              location.reload();
                                          }, 3000 );
                                          
                                        }else{
                                          setTimeout( function(){
                                            swal({
                                                  title: "¡Error!",
                                                  text: data.descripcion,
                                                  timer: 1500,
                                                  type: 'error',
                                                  closeOnConfirm: true,
                                                          closeOnCancel: true
                                                });
                                            }, 1000 );
                                        }
                                               
                                              
                                          },
                                          error: function (xhr, status)
                                          {
                            
                                          }
                                        
                                          });                           
                                                          

                                    } else {
                                                                
                                                                
                                                                
                                            }
                                                            
                                                            
                          });

             
});
/////////////////////////////////////////////FIN DELETE CLIENTE//////////////////////////////////////////////////////


});