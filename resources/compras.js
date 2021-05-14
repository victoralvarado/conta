$(document).ready(function () {
  var i = 1;
  const iva = 0.13;
  const retencion = 0.01;
  $("#tblCompras").DataTable();
  function calculo() {
    var clasificacion = $("#clasificacion").val();
    if (clasificacion != "Gran Contribuyente") {
      if (Number($("#total").val()) >= 100) {
        $("#retencion").val(
          (Number($("#total").val()) * Number(retencion)).toFixed(2)
        );
      } else {
        $("#retencion").val((0).toFixed(2));
      }
      $("#iva").val((Number($("#total").val()) * iva).toFixed(2));
    }
    if (clasificacion == "Gran Contribuyente") {
      $("#iva").val((Number($("#total").val()) * iva).toFixed(2));
      $("#retencion").val((0).toFixed(2));
    }
    if (clasificacion == "Ninguno" || clasificacion == "") {
      $("#iva").val((0).toFixed(2));
      $("#retencion").val((0).toFixed(2));
    }
    $("#totalf").val(
      (
        Number($("#total").val()) +
        Number($("#iva").val()) +
        Number($("#retencion").val())
      ).toFixed(2)
    );
  }

  function tipo() {
    if ($("#tipo").val() == "ccf") {
      calculo();
    } else if ($("#tipo").val() == "fcf") {
      $("#iva").val((0).toFixed(2));
      $("#retencion").val((0).toFixed(2));
      $("#totalf").val(
        (
          Number($("#total").val()) +
          Number($("#iva").val()) +
          Number($("#retencion").val())
        ).toFixed(2)
      );
    } else {
      calculo();
    }
  }

  $("#adicionar").click(function () {
    if (
      $("#producto").val() == "" ||
      $("#cantidad").val() == 0 ||
      $("#precio").val() == 0 ||
      $("#cp").val() == ""
    ) {
      $("#valp").text("Complete todos los campos del producto");
      $("#valp").attr("style", "color:red;");
    } else {
      $("#valp").text("");
      var codigo = $("#producto").children(":selected").attr("id");
      var nombre = $("#producto").val();
      var cantidad = $("#cantidad").val();
      var precio = $("#precio").val();
      var subtotal = $("#cp").val();
      var fila =
        '<tr id="row' +
        i +
        '"><td>' +
        codigo +
        "</td><td>" +
        nombre +
        "</td><td>" +
        cantidad +
        "</td><td>" +
        precio +
        '</td><td class="stotal">' +
        subtotal +
        '</td><td><button type="button" name="remove" id="' +
        i +
        '" class="btn btn-danger btn_remove"><i class="fas fa-trash"></i>  Quitar</button></td></tr>';
      i++;
      if ($("#adicionados").val() == "" || $("#adicionados").val() == 0) {
        $("#mytable").find("tbody").append(fila);
      }
      if ($("#adicionados").val() >= 1) {
        $("#tbody tr:last").after(fila);
      }
      var nFilas = $("#tbody tr").length;
      $("#adicionados").val(nFilas);
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
      $("#total").val(sum.toFixed(2));
      calculo();
      tipo();
    }
    $("#valtodo").text("");
  });

  $(document).on("click", ".btn_remove", function () {
    var button_id = $(this).attr("id");
    $("#row" + button_id + "").remove();
    var sum = 0;
    $(".stotal").each(function () {
      var value = $(this).text();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });

    var nFilas = $("#tbody tr").length;
    $("#adicionados").val(nFilas);
    $("#total").val(sum.toFixed(2));
    calculo();
    tipo();
  });

  $(document).on("change", "#contribuyente", function () {
    if ($("#contribuyente ").val() != "") {
      $.ajax({
        url: "./controller/proveedorController.php",
        type: "post",
        data: { text: $("#contribuyente").children(":selected").attr("id") },
        success: function (response) {
          $("#clasificacion").val(response);
          if (response != "Gran Contribuyente") {
            if (Number($("#total").val()) >= 100) {
              $("#retencion").val(
                (Number($("#total").val()) * Number(retencion)).toFixed(2)
              );
            } else {
              $("#retencion").val((0).toFixed(2));
            }
            $("#iva").val((Number($("#total").val()) * iva).toFixed(2));
          }
          if (response == "Gran Contribuyente") {
            $("#iva").val((Number($("#total").val()) * iva).toFixed(2));
            $("#retencion").val((0).toFixed(2));
          }
          if (response == "Ninguno" || clasificacion == "") {
            $("#iva").val(0.0);
            $("#retencion").val((0).toFixed(2));
          }
          $("#totalf").val(
            (
              Number($("#total").val()) +
              Number($("#iva").val()) +
              Number($("#retencion").val())
            ).toFixed(2)
          );
          tipo();
        },
      });
    } else {
      $("#clasificacion").val("");
    }
  });

  $(document).on("change", "#tipo", function () {
    tipo();
  });

  $(document).on("input", ".mul", function () {
    var mul = 0;
    var cantidad = parseFloat($("#cantidad").val());
    var precio = parseFloat($("#precio").val());
    if (isNaN(cantidad)) {
      cantidad = 0;
      $("#cantidad").val(cantidad);
    } else {
      cantidad = parseFloat($("#cantidad").val());
      $("#cantidad").val(cantidad);
    }
    if (isNaN(precio)) {
      precio = 0;
      $("#precio").val(precio);
    } else {
      precio = parseFloat($("#precio").val());
      $("#precio").val(precio);
    }
    if (isNaN($(".mul").val())) {
      mul = 0;
      $("#cp").val(mul);
    } else {
      mul = precio * cantidad;
      $("#cp").prop("value", mul.toFixed(2));
    }
  });

  $("#guardar").on("click", function () {
    if ($("#adicionados").val() == 0 || $("#adicionados").val() == "") {
      $("#valtodo").text("No hay productos agregados");
    } else {
      if (
        $("#contribuyente").val() == "" ||
        $("#numfactura").val() == "" ||
        $("#tipo").val() == ""
      ) {
        $("#valtodo").text("Complete los campos Proveedor/Compra");
      } else {
        var compra = [];
        var user = $("#user").val();
        var total = $("#total").val();
        var ivaCF = $("#iva").val();
        var ivaR = $("#retencion").val();
        var contribuyente = $("#contribuyente").val();
        var fecha = $("#fecha").val();
        var condicion = $("#condicion").val();
        var document_type = $("#tipo").val();
        var document_num = $("#numfactura").val();
        var com = {
          user,
          total,
          ivaCF,
          ivaR,
          contribuyente,
          fecha,
          condicion,
          document_type,
          document_num,
        };
        compra.push(com);

        $.ajax({
          url: "./controller/compraController.php",
          type: "post",
          data: { datos: JSON.stringify(compra) },
          success: function (resp) {
            console.log("respuesta datos: " + resp);
          },
        });

        var filas = [];
        $("#mytable tbody tr").each(function () {
          var codigo = $(this).find("td").eq(0).text();
          var nombre = $(this).find("td").eq(1).text();
          var cantidad = $(this).find("td").eq(2).text();
          var precio = $(this).find("td").eq(3).text();
          var subtotal = $(this).find("td").eq(4).text();

          var fila = {
            codigo,
            nombre,
            cantidad,
            precio,
            subtotal,
          };
          filas.push(fila);
        });

        $.ajax({
          url: "./controller/compraController.php",
          type: "post",
          data: { valores: JSON.stringify(filas) },
          success: function (resp) {
            console.log("respuesta valores: " + resp);
            swal({
              title: "Guardado",
              text: "Se guardo la compra!",
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
            });
            setTimeout(function () {
              location.assign("./compra.php");
            }, 1500);
          },
        });
      }
    }
  });
});
