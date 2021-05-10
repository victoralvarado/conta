$(document).ready(function () {
    var i = 1;
    const iva = 0.13;
    const retencion = 0.01;
    $('#tblCompras').DataTable();
    $('#adicionar').click(function () {
        if ($("#producto").val() == '' || $("#cantidad").val() == 0 || $("#precio").val() == 0 || $("#cp").val() == '') {
            $('#valp').text('Complete todos los campos del producto');
            $('#valp').attr('style', 'color:red;');
        } else {
            $("#valp").text('');
            var codigo = $("#producto").children(":selected").attr("id");
            var nombre = $("#producto").val();
            var cantidad = $("#cantidad").val();
            var precio = $("#precio").val();
            var subtotal = $("#cp").val();
            var fila = '<tr id="row' + i + '"><td>' + codigo + '</td><td>' + nombre + '</td><td>' + cantidad + '</td> <td>' + precio + '</td><td class="stotal">' + subtotal + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fas fa-trash"></i>  Quitar</button></td></tr>';
            i++;
            $('#mytable tr:first').after(fila);
            $("#adicionados").val(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
            var nFilas = $("#mytable tr").length;
            $("#adicionados").val(nFilas - 1);
            $("#producto").val("");
            $("#cantidad").val(0);
            $("#precio").val(0);
            $("#cp").val("");
            var sum = 0;
            $(".stotal").each(function () {

                var value = $(this).text();
                if (!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            });
            $('#total').val(sum.toFixed(2));
            var clasificacion = $("#clasificacion").val();
            if (clasificacion != 'Gran Contribuyente') {
                if (Number($('#total').val()) >= 100) {
                    $('#retencion').val((Number($('#total').val()) * Number(retencion)).toFixed(2));
                } else {
                    $('#retencion').val((0).toFixed(2));
                }
                $('#iva').val((Number($('#total').val()) * (iva)).toFixed(2));
            } if (clasificacion == 'Gran Contribuyente') {
                $('#iva').val((Number($('#total').val()) * (iva)).toFixed(2));
                $('#retencion').val((0).toFixed(2));
            } if (clasificacion == 'Ninguno' || clasificacion == "") {
                $('#iva').val((0).toFixed(2));
                $('#retencion').val((0).toFixed(2));
            }
            $('#totalf').val(((Number($('#total').val()) + Number($('#iva').val())) + Number($('#retencion').val())).toFixed(2));
        }
        $('#valtodo').text('');

    });
    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
        var sum = 0;
        $(".stotal").each(function () {

            var value = $(this).text();
            if (!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        $("#adicionados").val("");
        var nFilas = $("#mytable tr").length;
        $("#adicionados").val(nFilas - 1);
        $('#total').val(sum.toFixed(2));
        var clasificacion = $("#clasificacion").val();
        if (clasificacion != 'Gran Contribuyente') {
            if (Number($('#total').val()) >= 100) {
                $('#retencion').val((Number($('#total').val()) * Number(retencion)).toFixed(2));
            } else {
                $('#retencion').val((0).toFixed(2));
            }
            $('#iva').val((Number($('#total').val()) * (iva)).toFixed(2));
        } if (clasificacion == 'Gran Contribuyente') {
            $('#iva').val((Number($('#total').val()) * (iva)).toFixed(2));
            $('#retencion').val((0).toFixed(2));
        } if (clasificacion == 'Ninguno' || clasificacion == "") {
            $('#iva').val((0).toFixed(2));
            $('#retencion').val((0).toFixed(2));
        }
        $('#totalf').val(((Number($('#total').val()) + Number($('#iva').val())) + Number($('#retencion').val())).toFixed(2));
    });
    $(document).on('change', '#contribuyente', function () {
        if ($("#contribuyente ").val() != '') {
            $.ajax({
                url: './controller/proveedorController.php',
                type: 'post',
                data: { text: $("#contribuyente").children(":selected").attr("id") },
                success: function (response) {
                    $('#clasificacion').val(response);
                    if (response != 'Gran Contribuyente') {
                        if (Number($('#total').val()) >= 100) {
                            $('#retencion').val((Number($('#total').val()) * Number(retencion)).toFixed(2));
                        } else {
                            $('#retencion').val((0).toFixed(2));
                        }
                        $('#iva').val((Number($('#total').val()) * (iva)).toFixed(2));
                    } if (response == 'Gran Contribuyente') {
                        $('#iva').val((Number($('#total').val()) * (iva)).toFixed(2));
                        $('#retencion').val((0).toFixed(2));
                    } if (response == 'Ninguno' || clasificacion == "") {
                        $('#iva').val(0.00);
                        $('#retencion').val((0).toFixed(2));
                    }
                    $('#totalf').val(((Number($('#total').val()) + Number($('#iva').val())) + Number($('#retencion').val())).toFixed(2));
                    var id = $("#contribuyente").children(":selected").attr("id");
                    if (id == '-') {
                        $('#nrcProveedor').val('');
                    } else {
                        $('#nrcProveedor').val(id);
                    }
                }
            });
        }

        if ($("#contribuyente ").val() != '') {
            $.ajax({
                url: './controller/proveedorController.php',
                type: 'post',
                data: { nitP: $("#contribuyente").children(":selected").attr("id") },
                success: function (response) {
                    $('#nitProveedor').val(response);
                }
            });
        } else {
            $('#nitProveedor').val('');
        }

    });
    $(document).on("input", ".mul", function () {
        var mul = 0;
        var cantidad = parseFloat($('#cantidad').val());
        var precio = parseFloat($('#precio').val());
        if (isNaN(cantidad)) {
            cantidad = 0;
            $('#cantidad').val(cantidad);
        } else {
            cantidad = parseFloat($('#cantidad').val());
            $('#cantidad').val(cantidad);
        } if (isNaN(precio)) {
            precio = 0;
            $('#precio').val(precio);
        } else {
            precio = parseFloat($('#precio').val());
            $('#precio').val(precio);
        } if (isNaN($('.mul').val())) {
            mul = 0;
            $('#cp').val(mul);
        } else {
            mul = precio * cantidad;
            $('#cp').prop('value', mul.toFixed(2));
        }
    });
    $('#guardar').on('click', function () {
        if ($("#adicionados").val() == 0 || $("#adicionados").val() == '') {
            $('#valtodo').text('No hay productos agregados');
        } else {
            if ($('#contribuyente').val() == '' || $('#numfactura').val() == '' || $('#tipo').val() == '') {
                $('#valtodo').text('Complete los campos Proveedor/Compra');
            } else {
                $.ajax({
                    url: './controller/compraController.php',
                    type: 'post',
                    data: {
                        user: $('#user').val(), cp: $('#cp').val(), ivaCF: $('#iva').val(),
                        ivaR: $('#retencion').val(), contribuyente: $('#contribuyente').val(),
                        fecha: $('#fecha').val(), condicion: $('#condicion').val(),
                        document_type: $('#tipo').val(), document_num: $('#numfactura').val()
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
                var filas = [];
                $('#mytable tbody tr').each(function () {
                    var codigo = $(this).find('td').eq(0).text();
                    var nombre = $(this).find('td').eq(1).text();
                    var cantidad = $(this).find('td').eq(2).text();
                    var precio = $(this).find('td').eq(3).text();
                    var subtotal = $(this).find('td').eq(4).text();

                    var fila = {
                        codigo,
                        nombre,
                        cantidad,
                        precio,
                        subtotal
                    };
                    filas.push(fila);
                });
                filas.shift();
                $.ajax({
                    url: './controller/compraController.php',
                    type: 'post',
                    data: { valores: JSON.stringify(filas) },
                    success: function (data) {
                        console.log(data);
                        swal({
                            title: "Guardado",
                            text: "Compra agregada correctamente!",
                            type: "success",
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            location.assign("./compra.php");
                        }, 1100);
                    }
                });

            }
        }
    });
});