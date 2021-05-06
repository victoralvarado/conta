$(document).ready(function(){

	$("#listadoFerias").DataTable({
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
			            "sSortAscending":  ": ActivaR para ordenar la columna de manera ascendente",
			            "sSortDescending": ": ActivaR para ordenar la columna de manera descendente"
			        }
			    }
			});

	$(document).on("click","#nuevaFeria",function(){
		$("#modalIngresoFeria").modal({backdrop: 'static', keyboard: false});
	});

	$(document).on("click","#agregarFeria",function(){
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

	$(document).on("click",".editarFer", function(){
		var idFeria = $(this).attr('id');
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {key: 'cargarDatosFer', idFeria:idFeria},
			url: '../controller/FeriaController.php',
			success: function(res)
			{
				if(res.estadoSen==true)
				{
				var fecha = res.fechaInicio;
				var ffecha = fecha.substring(0, 10);
				$("#idFeriaEdit").val(res.id);
				$("#nombreFeriaEdit").val(res.nombre);
				$("#empOrgEdit").val(res.idEmpOrg);
				$("#colInfEdit").val(res.idFondo);
				$("#fiEdit").val(ffecha);
				$("#modalModFeria").modal({backdrop: 'static', keyboard: false});
				}
			},
			error: function(xhr, status)
			{
					console.log('error :c');
			}

		});
	});

	$(document).on("click",".actFer", function(){
		var idFeria = $(this).attr('id');
		$("#idImgEdit").val(idFeria);
		$("#modalModImg").modal({backdrop: 'static', keyboard: false});
	});

	$(document).on("click",".actProg", function(){
		var idFeria = $(this).attr('id');
		$("#idProgEdit").val(idFeria);
		$("#modalModProg").modal({backdrop: 'static', keyboard: false});
	});

	$(document).on("click","#modFeria",function(){
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

	$(document).on("click","#modImg",function(){
		swal({
	        title: "Exito!",
	        text: "Imagen actualizada exitosamente",
	        timer: 1500,
	        type: 'success',
	        closeOnConfirm: true,
	        closeOnCancel: true,
	        allowOutsideClick: false
	    });
	});

	$(document).on("click","#modProg",function(){
		swal({
	        title: "Exito!",
	        text: "Imagen actualizada exitosamente",
	        timer: 1500,
	        type: 'success',
	        closeOnConfirm: true,
	        closeOnCancel: true,
	        allowOutsideClick: false
	    });
	});


	 $(document).on("click",".eliminarFer",  function(){   

    var idFeria = $(this).attr('id');

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
                                          data: {idFeria:idFeria, key:'eliminarFer'},
                                          url: "../controller/FeriaController.php",
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
   // Fin de la eliminacion de las ferias

	});