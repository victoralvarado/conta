$(document).ready(function(){

	$("#listadoStand").DataTable({
			    "language": {
			        "sProcessing":    "Procesando...",
			        "sLengthMenu":    "Mostrar _MENU_ registros",
			        "sZeroRecords":   "No se encontraron resultados",
			        "sEmptyTable":    "Ningún dato disponible en esta tabla",
			        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
			        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
			        "sInfoPostFix":   "",
			        "sSearch":        "Buscar:",
			        "sUrl":           "",
			        "sInfoThousands":  ",",
			        "sLoadingRecords": "Cargando...",
			        "oPaginate": {
			            "sFirst":    "Primero",
			            "sLast":    "Último",
			            "sNext":    "Siguiente",
			            "sPrevious": "Anterior"
			        },
			        "oAria": {
			            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
			        }
			    }
			});

	$(document).on("click","#nuevaStand",function(){
		$("#modalIngresoStand").modal({backdrop: 'static', keyboard: false});
	});

	$(document).on("click","#agregarStand",function(){
		swal({
	        title: "Exito!",
	        text: "Datos ingresado exitosamente",
	        timer: 1500,
	        type: 'success',
	        closeOnConfirm: true,
	        closeOnCancel: true,
	        allowOutsideClick: false
	    });
	});

	$("#staPabEdit").on("change",function(){
		var idPab = $("#staPabEdit").val();
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {key: 'validarEspacios', idPab:idPab},
			url: '../controller/StandController.php',
			success: function(res)
			{
				if(res.estado!=null)
				{
					$("#staTipoEdit option").remove();
					$("#staTipoEdit").append(res.option);
				}
			},
			error: function(xhr, status)
			{
					console.log('error :c');
			}

		});
	});

	$("#staPab").on("change",function(){
		var idPab = $("#staPab").val();
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {key: 'validarEspacios', idPab:idPab},
			url: '../controller/StandController.php',
			success: function(res)
			{
				if(res.estado!=null)
				{
					$("#staTipo option").remove();
					$("#staTipo").append(res.option);
				}
			},
			error: function(xhr, status)
			{
					console.log('error :c');
			}

		});
	});

	$(document).on("click","#editStand",function(){
		swal({
	        title: "Exito!",
	        text: "Datos actualizados exitosamente",
	        timer: 1500,
	        type: 'success',
	        closeOnConfirm: true,
	        closeOnCancel: true,
	        allowOutsideClick: false
	    });
	});

	$(document).on("click",".editarSta", function(){
		var idSta = $(this).attr('id');
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {key: 'cargarDatosSta', idSta:idSta},
			url: '../controller/StandController.php',
			success: function(res)
			{
				if(res.estadoSen==true)
				{
				$("#idStandEdit").val(res.id);
				$("#staEmpEdit").val(res.idEmpresa);
				$("#staPabEdit").val(res.idPabellon);
				$("#staTipoEdit").val(res.tipoStand);
				$("#colStaEdit").val(res.idFondo);
				$("#monoStaEdit").val(res.idMono);
				$("#modalEditStand").modal({backdrop: 'static', keyboard: false});
				}
			},
			error: function(xhr, status)
			{
					console.log('error :c');
			}

		});
	});

	$(document).on("click",".eliminarSta",  function(){   

    var idSta = $(this).attr('id');

                                      swal({
                                                    title: "Advertencia",
                                                    text: "¿Está seguro de eliminar este registro? Si acepta removerlo, no habrá forma de recuperar los datos posteriormente.",
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
                                          data: {idSta:idSta, key:'eliminarSta'},
                                          url: "../controller/StandController.php",
                                          success: function (data)
                                          {
                                            if (data.estado==true) {
                                          setTimeout( function(){
                                          swal({
                                                  title: "¡Éxito!",
                                                  text: data.descripcion,
                                                  timer: 1500,
                                                  type: 'success',
                                                  closeOnConfirm: true,
                                                          closeOnCancel: true
                                                });
                                          }, 1000 );
                                          setTimeout( function(){ 
                                              location.reload();
                                          }, 1000 );
                                          
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
   // Fin de la eliminacion de los stand


	});