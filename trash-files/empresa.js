$(document).ready(function(){

	$("#listadoEmpresas").DataTable({
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

	$(document).on("click","#nuevaEmpresa",function(){
		$("#modalNuevaEmpresa").modal({backdrop: 'static', keyboard: false});
	});

	$(document).on("click","#agregarEmpresa",function(){
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

	$(document).on("click","#editEmpresa",function(){
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

	$(document).on("click",".editarEmp", function(){
		var idEmp = $(this).attr('id');
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {key: 'cargarDatosEmp', idEmp:idEmp},
			url: '../controller/EmpresaController.php',
			success: function(res)
			{
				if(res.estadoSen==true)
				{
				$("#idEmpresa").val(res.id);
				$("#tipoeG").val(res.idTipoe);
				$("#nombreEmpEdit").val(res.nombre);
				$("#vidpinEmpEdit").val(res.videoPrincipal);
				$("#webEmpEdit").val(res.web);
				$("#emailEmpEdit").val(res.email);
				$("#linkEmpEdit").val(res.linkedin);
				$("#fbEmpEdit").val(res.facebook);
				$("#igEmpEdit").val(res.ig);
				$("#waEmpEdit").val(res.whatsapp);
				$("#rubroEmpEdit").val(res.idRubro);
				$("#tipoEmpEdit").val(res.idTipoe);
				$("#descripcionEmpEdit").val(res.descripcionEmpresa);
				$("#modalEditEmpresa").modal({backdrop: 'static', keyboard: false});
				}
			},
			error: function(xhr, status)
			{
					console.log('error :c');
			}

		});
	});

	$(document).on("click",".clEmp", function(){
		var idEmp = $(this).attr('id');
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {key: 'cargarDatosEmp', idEmp:idEmp},
			url: '../controller/EmpresaController.php',
			success: function(res)
			{
				if(res.estadoSen==true)
				{
				$("#idEmpresaCL").val(res.id);
				$("#modalActLogo").modal({backdrop: 'static', keyboard: false});
				}
			},
			error: function(xhr, status)
			{
					console.log('error :c');
			}

		});
	});

	$(document).on("click","#modificarLogo",function(){
		swal({
	        title: "Exito!",
	        text: "Logo actualizado correctamente",
	        timer: 1500,
	        type: 'success',
	        closeOnConfirm: true,
	        closeOnCancel: true,
	        allowOutsideClick: false
	    });
	});

	$(document).on("click","#modificarBanner",function(){
		swal({
	        title: "Exito!",
	        text: "Banner actualizado correctamente",
	        timer: 1500,
	        type: 'success',
	        closeOnConfirm: true,
	        closeOnCancel: true,
	        allowOutsideClick: false
	    });
	});

	$(document).on("click",".cbEmp", function(){
		var idEmp = $(this).attr('id');
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {key: 'cargarDatosEmp', idEmp:idEmp},
			url: '../controller/EmpresaController.php',
			success: function(res)
			{
				if(res.estadoSen==true)
				{
				$("#idEmpresaCB").val(res.id);
				$("#modalActBanner").modal({backdrop: 'static', keyboard: false});
				}
			},
			error: function(xhr, status)
			{
					console.log('error :c');
			}

		});
	});

	$(document).on("click",".eliminarEmp", function(){
	var idEmp = $(this).attr('id');
		$.ajax({
                                          type: 'POST',
                                          async: false,
                                          dataType: 'json',
                                          data: {key:'eliminarEmp', idEmp:idEmp},
                                          url: "../controller/EmpresaController.php",
                                          success: function (res)
                                          {
                                            if (res.estado==true) {
                                            		swal({
	                                                  title: "Exito!",
	                                                  text: res.descripcion,
	                                                  timer: 1500,
	                                                  type: 'success',
	                                                  closeOnConfirm: true,
	                                                  closeOnCancel: true,
	                                                  allowOutsideClick: false
	                                                });
                                            	
                                          setTimeout( function(){ 
                                              location.reload();
                                          }, 1000 );
                                          
                                        }else{
												swal({
                                                  title: "Error!",
                                                  text: res.descripcion,
                                                  timer: 1500,
                                                  type: 'error',
                                                  closeOnConfirm: true,
                                                  closeOnCancel: true,
                                                  allowOutsideClick: false
                                                });

                                        }
                                               
                                              
                                          },
                                          error: function (xhr, status)
                                          {
												swal({
                                                  title: "Error!",
                                                  text: "Error en la ejecuión del AJAX",
                                                  timer: 1500,
                                                  type: 'error',
                                                  closeOnConfirm: true,
                                                  closeOnCancel: true,
                                                  allowOutsideClick: false
                                                });

                            					
                                          }
                                          });                           
                                             
		});

	$(document).on("click",".reacEmp", function(){
	var idEmp = $(this).attr('id');
		$.ajax({
                                          type: 'POST',
                                          async: false,
                                          dataType: 'json',
                                          data: {key:'recEmp', idEmp:idEmp},
                                          url: "../controller/EmpresaController.php",
                                          success: function (res)
                                          {
                                            if (res.estado==true) {
                                            		swal({
	                                                  title: "Exito!",
	                                                  text: res.descripcion,
	                                                  timer: 1500,
	                                                  type: 'success',
	                                                  closeOnConfirm: true,
	                                                  closeOnCancel: true,
	                                                  allowOutsideClick: false
	                                                });
                                            	
                                          setTimeout( function(){ 
                                              location.reload();
                                          }, 1000 );
                                          
                                        }else{
												swal({
                                                  title: "Error!",
                                                  text: res.descripcion,
                                                  timer: 1500,
                                                  type: 'error',
                                                  closeOnConfirm: true,
                                                  closeOnCancel: true,
                                                  allowOutsideClick: false
                                                });

                                        }
                                               
                                              
                                          },
                                          error: function (xhr, status)
                                          {
												swal({
                                                  title: "Error!",
                                                  text: "Error en la ejecuión del AJAX",
                                                  timer: 1500,
                                                  type: 'error',
                                                  closeOnConfirm: true,
                                                  closeOnCancel: true,
                                                  allowOutsideClick: false
                                                });

                            					
                                          }
                                          });                           
                                             
		});

});