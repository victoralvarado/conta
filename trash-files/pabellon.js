$(document).ready(function(){

	$("#listadoPabellones").DataTable({
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

	$(document).on("click","#nuevaPabellon",function(){
		$("#modalIngresoPabellon").modal({backdrop: 'static', keyboard: false});
	});

	$(document).on("click","#agregarPabellon",function(){
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

	$(document).on("click","#editPabellon",function(){
		swal({
	        title: "Exito!",
	        text: "Datos modificados exitosamente",
	        timer: 1500,
	        type: 'success',
	        closeOnConfirm: true,
	        closeOnCancel: true,
	        allowOutsideClick: false
	    });
	});

	$("#pabFer").on("change",function(){
		var idFer = $("#pabFer").val();
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {key: 'validarTipo', idFer:idFer},
			url: '../controller/PabellonController.php',
			success: function(res)
			{
				if(res.estado==1)
				{
					$("#prioPab option").remove();
					$("#prioPab").append(res.option);
				}
			},
			error: function(xhr, status)
			{
					console.log('error :c');
			}

		});
	});

	$(document).on("click",".editarPab", function(){
		var idPab = $(this).attr('id');
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {key: 'cargarDatosPab', idPab:idPab},
			url: '../controller/PabellonController.php',
			success: function(res)
			{
				if(res.estadoSen==true)
				{
				$("#idPabellonEdit").val(res.id);
				$("#numPabEdit").val(res.numeroPabellon);
				$("#nomPabEdit").val(res.nombrePabellon);
				$("#espNomEdit").val(res.espaciosNormal);
				$("#espPriEdit").val(res.espaciosPremium);
				$("#numInforEdit").val(res.numeroInformante);
				$("#pabFerEdit").val(res.idFeria);
				$("#modalEditPabellon").modal({backdrop: 'static', keyboard: false});
				}
			},
			error: function(xhr, status)
			{
					console.log('error :c');
			}

		});
	});




	$(document).on("click",".eliminarPab",  function(){   

    var idPab = $(this).attr('id');

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
                                          data: {idPab:idPab, key:'eliminarPab'},
                                          url: "../controller/PabellonController.php",
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
   // Fin de la eliminacion de las pabellones



	});