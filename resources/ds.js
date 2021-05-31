$(document).ready(function(){

$(document).on("click","#cleanDS",function(){
  $("#tipo").val(0);
  $("#serie").val("");
  $("#nsid").val(1);
  $("#nste").val(1000);
});

/////////////////////////////////////////////AGREGAR DS//////////////////////////////////////////////////////
$(document).on("click","#agregarDS",function(){

    var tipo = $("#tipo").val();
    var serie = $("#serie").val();
    var nsid = $("#nsid").val();
    var nste = $("#nste").val();

        if(tipo != "0" && serie != "" && nsid != "" && nste != "")
        {
          if(nste>nsid)
          {
            $.ajax({
            type: 'POST',
            async: false,
            dataType: 'json',
            data: {key: 'saveDS', tipo:tipo, serie:serie, nsid:nsid, nste:nste},
            url: 'controller/dsController.php',
            success: function(res)
            {
              if(res.estado!=false)
              {
                swal({
                    title: "Exito!",
                    text: "El DS se agrego correctamente",
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
                text: "Error al agregar número de serie, "+res.descripcion,
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
              text: "'Termina en' no puede ser menor a 'Inicia desde'",
              timer: 2500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
          }
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
/////////////////////////////////////////////FIN AGREGAR DS//////////////////////////////////////////////////////

$(document).on("click",".editar", function(){
    var idDS = $(this).attr('id');
    $.ajax({
      type: 'POST',
      async: false,
      dataType: 'json',
      data: {key: 'cargarDatosDS', idDS:idDS},
      url: 'controller/dsController.php',
      success: function(res)
      {
        $("#idDSEdit").val(res.id);
        $("#tipoEdit").val(res.tipo);
        $("#serieEdit").val(res.serie);
        $("#nsidEdit").val(res.inicia_desde);
        $("#nsteEdit").val(res.termina_en);
        $("#modalModDS").modal({backdrop: 'static', keyboard: false});
      },
      error: function(xhr, status)
      {
          console.log('error :c');
      }

    });
});

/////////////////////////////////////////////MOD DS//////////////////////////////////////////////////////
$(document).on("click","#modDS",function(){

    var tipo = $("#tipoEdit").val();
    var serie = $("#serieEdit").val();
    var nsid = $("#nsidEdit").val();
    var nste = $("#nsteEdit").val();
    var id = $("#idDSEdit").val();

        if(tipo != "0" && serie != "" && nsid != "" && nste != "")
        {
          if(nste>nsid)
          {
            $.ajax({
            type: 'POST',
            async: false,
            dataType: 'json',
            data: {key: 'modiDS', tipo:tipo, serie:serie, nsid:nsid, nste:nste, id:id},
            url: 'controller/dsController.php',
            success: function(res)
            {
              if(res.estado!=false)
              {
                swal({
                    title: "Exito!",
                    text: "El número de serie se modificó correctamente",
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
                text: "Error al modificar número de serie, "+res.descripcion,
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
              text: "'Termina en' no puede ser menor a 'Inicia desde'",
              timer: 2500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
          }
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
/////////////////////////////////////////////FIN MOD DS//////////////////////////////////////////////////////

/////////////////////////////////////////////DELETE DS//////////////////////////////////////////////////////
$(document).on("click",".eliminar",  function(){   

    var idDS = $(this).attr('id');

                                      swal({
                                                    title: "Advertencia",
                                                    text: "¿Está seguro de cambiar el estado de pago de este número de serie?",
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
                                          data: {key:"elimiDS", idDS:idDS},
                                          url: "controller/dsController.php",
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
/////////////////////////////////////////////FIN DELETE DS//////////////////////////////////////////////////////


});