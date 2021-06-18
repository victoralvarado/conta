$(document).ready(function() {

    var i = 1;
    var res = '';
    var button_id = '';
    $(document).on("change", "#cuentas", function() {
        if ($('#cuentas').val() != "") {
            $('#codigo').val($("#cuentas").children(":selected").attr("id"));
        } else {
            $('#codigo').val("");
        }
    });

    $('#debe').keyup(function() {
        $('#haber').val('');
        $("#debe").prop('required', true);
        $("#haber").prop('required', false);
    });
    $('#haber').keyup(function() {
        $('#debe').val('');
        $("#haber").prop('required', true);
        $("#debe").prop('required', false);
    });

    $("#add").click(function() {
        if ($("#codigo").val() == "" || $("#cuentas").val() == "" || $("#debe").val() == "" && $("#haber").val() == "") {
            $("#valcuenta").text("Complete los campos");
            $("#valcuenta").attr("style", "color:red;");
        } else {
            if (datatable($("#codigo").val()) >= 2) {
                $("#valcuenta").text("No se puede ingresar mas de dos veces la cuenta " + $("#cuentas").val());
            } else if ($("#debe").val().length > 0 && debec($("#cuentas").val()) > 0) {
                $("#valcuenta").text("No se puede volver a cargar " + $("#cuentas").val());
            } else if ($("#haber").val().length > 0 && haberc($("#cuentas").val()) > 0) {
                $("#valcuenta").text("No se puede volver a abonar " + $("#cuentas").val());
            } else {
                $("#valcuenta").text("");
                var codigo = $("#codigo").val();
                var cuentas = $("#cuentas").val();
                var debe = parseFloat($("#debe").val()).toFixed(2);
                var haber = parseFloat($("#haber").val()).toFixed(2);
                if (debe == 'NaN') {
                    debe = ''
                }
                if (haber == 'NaN') {
                    haber = ''
                }
                var fila =
                    "<tr id='row" +
                    i +
                    "'><td id='co" + i + "'>" +
                    codigo +
                    "</td><td id='c" + i + "'>" +
                    cuentas +
                    "</td><td class='stotald' id='d" + i + "'>" +
                    debe +
                    "</td><td class='stotalh'id='h" + i + "'>" +
                    haber +
                    '</td><td><button type="button" name="remove" id="' +
                    i +
                    '" class="btn btn-danger btn_remove"><i class="fas fa-trash"></i>  Quitar</button>&nbsp;&nbsp;&nbsp;<button type="button" name="editar" id="ed' +
                    i +
                    '" class="btn btn-info btn_edit" data-toggle="modal" data-target="#edit" ><i class="fas fa-edit"></i>  Editar</button></td></tr>';
                i++;
                if ($("#adicionados").val() == "" || $("#adicionados").val() == 0) {
                    $("#mytable").find("tbody").append(fila);
                }
                if ($("#adicionados").val() >= 1) {
                    $("#tbody tr:last").after(fila);
                }
                var nFilas = $("#tbody tr").length;
                $("#adicionados").val(nFilas);
                $("#codigo").val("");
                $("#cuentas").val("");
                $("#debe").val("");
                $("#haber").val("");
                var sumd = 0;
                var sumh = 0;

                $(".stotald").each(function() {
                    var value = $(this).text();
                    if (!isNaN(value) && value.length != 0) {
                        sumd += parseFloat(value);
                    }
                });
                $("#totaldebe").text(sumd.toFixed(2));
                $(".stotalh").each(function() {
                    var value = $(this).text();
                    if (!isNaN(value) && value.length != 0) {
                        sumh += parseFloat(value);
                    }
                });
                $("#totalhaber").text(sumh.toFixed(2));
                $('#valpartidas').text('');
                sortTable();
            }
        }
    });

    $('#mytable').on("click", ".btn_remove", function() {
        var button_id = $(this).attr("id");
        $("#row" + button_id + "").remove();
        var sumd = 0;
        $(".stotald").each(function() {
            var value = $(this).text();
            if (!isNaN(value) && value.length != 0) {
                sumd += parseFloat(value);
            }
        });
        var sumh = 0;
        $(".stotalh").each(function() {
            var value = $(this).text();
            if (!isNaN(value) && value.length != 0) {
                sumh += parseFloat(value);
            }
        });
        var nFilas = $("#tbody tr").length;
        $("#adicionados").val(nFilas);
        $("#totaldebe").text(sumd.toFixed(2));
        $("#totalhaber").text(sumh.toFixed(2));
        $('#valpartidas').text('');
        sortTable();
    });

    $(document).on("click", "#guardarp", function() {
        var fechap = $('#fecha').val();
        var descripcionp = $('#descripcion').val();
        if ($("#adicionados").val() == 0 || $("#descripcion").val() == "") {
            $('#valpartidas').text('No hay partida o una descripcion');
        } else if (parseFloat($("#totaldebe").text()) != parseFloat($("#totalhaber").text())) {
            $('#valpartidas').text('La partida no esta cuadrada');
        } else {
            var datostabl = [];
            var datat = {};
            $("#mytable tbody tr").each(function() {
                var codigo = $(this).find("td").eq(0).text();
                var cuenta = $(this).find("td").eq(1).text();
                var debe = $(this).find("td").eq(2).text();
                var haber = $(this).find("td").eq(3).text();

                datat = {
                    codigo,
                    cuenta,
                    debe,
                    haber
                };
                datostabl.push(datat);
            });

            $.ajax({
                url: "./controller/partidaController.php",
                type: "POST",
                data: { fecha: $("#fecha").val(), descripcion: $("#descripcion").val(), valores: JSON.stringify(datostabl) },
                success: function(resp) {
                    console.log("respuesta valores: " + resp);
                    swal({
                        title: "Guardado",
                        text: "Se guardo la partida!",
                        type: "success",
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    setTimeout(function() {
                            location.assign("./partidasm.php");
                            if ($('#check').prop('checked')) {
                                var form = document.createElement("form");
                                form.setAttribute("method", "post");
                                form.setAttribute("action", "reportpartida.php");
                                form.setAttribute("target", "_blank");
                                var hiddenField = document.createElement("input");
                                hiddenField.setAttribute("type", "hidden");
                                hiddenField.setAttribute("name", "datos");
                                hiddenField.setAttribute("value", JSON.stringify(datostabl));

                                var fecha = document.createElement("input");
                                fecha.setAttribute("type", "hidden");
                                fecha.setAttribute("name", "fecha");
                                fecha.setAttribute("value", fechap);

                                var descripcion = document.createElement("input");
                                descripcion.setAttribute("type", "hidden");
                                descripcion.setAttribute("name", "descripcion");
                                descripcion.setAttribute("value", descripcionp);
                                form.appendChild(hiddenField);
                                form.appendChild(fecha);
                                form.appendChild(descripcion);
                                document.body.appendChild(form);
                                form.submit();
                            }

                        },
                        1500);
                }
            });

            $('#valpartidas').text('');
        }
    });

    function datatable(a) {
        var n = 0;
        $("#mytable tbody tr").each(function(index) {
            var codigo;
            $(this).children("td").each(function(index2) {
                switch (index2) {
                    case 0:
                        codigo = $(this).text();
                        if (codigo == a) {
                            n++;
                        }
                        break;
                }
            });
        });
        return n;
    }

    function debec(b) {
        var datostabla = [];
        var data = {};
        var j;
        var n = 0;
        var obj = 0;
        var codigo = '';
        var cuenta = '';
        var debe = '';
        var haber = '';
        $("#mytable tbody tr").each(function() {
            codigo = $(this).find("td").eq(0).text();
            cuenta = $(this).find("td").eq(1).text();
            debe = $(this).find("td").eq(2).text();
            haber = $(this).find("td").eq(3).text();

            data = {
                codigo,
                cuenta,
                debe,
                haber
            };
            datostabla.push(data);
            j = JSON.stringify(datostabla);
            obj = jQuery.parseJSON(j);
            $.each(obj, function(key, value) {
                if (value.cuenta == b) {
                    n = value.debe.length;
                }
            });
        });
        return n;
    }

    function haberc(c) {
        var datostabla = [];
        var data = {};
        var j;
        var n = 0;
        var obj = 0;
        var codigo = '';
        var cuenta = '';
        var debe = '';
        var haber = '';
        $("#mytable tbody tr").each(function() {
            codigo = $(this).find("td").eq(0).text();
            cuenta = $(this).find("td").eq(1).text();
            debe = $(this).find("td").eq(2).text();
            haber = $(this).find("td").eq(3).text();

            data = {
                codigo,
                cuenta,
                debe,
                haber
            };
            datostabla.push(data);
            j = JSON.stringify(datostabla);
            obj = jQuery.parseJSON(j);
            $.each(obj, function(key, value) {
                if (value.cuenta == c) {
                    n = value.haber.length;
                }
            });
        });
        return n;
    }

    $('#mytable').on("click", ".btn_edit", function() {
        button_id = '';
        res = '';
        button_id = $(this).attr("id");
        res = button_id.replace(/ed/g, "");

        if (datatable($('#co' + res + '').text()) < 2) {
            $("#editcand").attr("disabled", false);
            $("#editcanh").attr("disabled", false);
            $('#editcand').val('');
            $('#editcanh').val('');
            if ($('#d' + res + '').text() != "") {
                $('#editcand').val($('#d' + res + '').text());
            }
            if ($('#h' + res + '').text() != "") {
                $('#editcanh').val($('#h' + res + '').text());
            }
        } else {
            $('#editcand').val('');
            $('#editcanh').val('');
            if ($('#d' + res + '').text() != "") {
                $('#editcand').val($('#d' + res + '').text());
                $("#editcanh").attr("disabled", true);
                $("#editcand").attr("disabled", false);
            }
            if ($('#h' + res + '').text() != "") {
                $('#editcanh').val($('#h' + res + '').text());
                $("#editcand").attr("disabled", true);
                $("#editcanh").attr("disabled", false);
            }
        }
    });

    $('#editcand').keyup(function() {
        $('#editcanh').val('');
    });
    $('#editcanh').keyup(function() {
        $('#editcand').val('');
    });

    $(document).on("click", "#editarCantidad", function() {
        console.log(res);
        if ($('#editcand').val() == "" && $('#editcanh').val() == "") {
            $('#valedit').text('Debe de agregar una cantidad');
        } else {
            if (parseFloat($('#editcanh').val()).toFixed(2) == 'NaN') {
                $('#h' + res + '').text('');
            } else {
                $('#h' + res + '').text(parseFloat($('#editcanh').val()).toFixed(2));
            }
            if (parseFloat($('#editcand').val()).toFixed(2) == 'NaN') {
                $('#d' + res + '').text('');
            } else {
                $('#d' + res + '').text(parseFloat($('#editcand').val()).toFixed(2));
            }

            var sumd = 0;
            $(".stotald").each(function() {
                var value = $(this).text();
                if (!isNaN(value) && value.length != 0) {
                    sumd += parseFloat(value);
                }
            });
            var sumh = 0;
            $(".stotalh").each(function() {
                var value = $(this).text();
                if (!isNaN(value) && value.length != 0) {
                    sumh += parseFloat(value);
                }
            });
            var nFilas = $("#tbody tr").length;
            $("#adicionados").val(nFilas);
            $("#totaldebe").text(sumd.toFixed(2));
            $("#totalhaber").text(sumh.toFixed(2));
            $('#valedit').text('');
            $("#edit").modal("hide");
        }
    });

    function sortTable() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById('mytable');
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;

                x = rows[i].getElementsByTagName("TD")[1];
                y = rows[i + 1].getElementsByTagName("TD")[1];
                x = rows[i].getElementsByTagName("TD")[3];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

});