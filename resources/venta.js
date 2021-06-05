$(document).ready(function(){

var cantidad = [];
var descripcion = [];
var precio = [];
var exentas = [];
var afectadas = [];
var cantactprod = [];
var table = [];
var retencion=false;
var percepcion=false;

$("#tipoFac").val(2);
valChkCli();
valRadios();
valDS();
valProds();
valNumFactura();

$('#nombreCli').on('change', function() {
  valChkCli();
  totalizar();
});

$('#tipoFac').on('change', function() {
  totalizar();
});

$('#exivay').click(function(){
    valRadios();
});

$('#exivan').click(function(){
    valRadios();
});

$('#tipoFac').on('change', function() {
  valDS();
});

$('#numSerie').on('change', function() {
  valNumFactura();
});

$('#prods').on('change', function() {
  valProds();
});

$('#btn1').click(function(){
    save2table();
    totalizar();
});

$('#saveVen').click(function(){
    venta();
});

$(document).on("click",".btn2", function(){
    var idProd = $(this).attr('id');
    cantidad.splice(idProd, 1);
    descripcion.splice(idProd, 1);
    precio.splice(idProd, 1);
    exentas.splice(idProd, 1);
    afectadas.splice(idProd, 1);
    cantactprod.splice(idProd, 1);
    table.splice(idProd, 1);
    $("#detalleCompra").empty();
      table.forEach( function(valor, indice, array) {
        $("#detalleCompra").append(valor);
      });
      totalizar();

});

$(document).on("click",".btn3", function(){
    var id = $(this).attr('id');
    if(typeof(cantidad[id]) == 'undefined' || cantidad[id] === null)
   {
        if(parseInt(cantidad[id]) >= parseInt($("#prods").find('option:selected').attr("class")))
        {
          swal({
              title: "Error",
              text: "Ha superado la cantidad en existencia del producto.\nCantidad en existencia = "+$("#prods").find('option:selected').attr("class"),
              timer: 1500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
        }
        else
        {
          cantidad[id] = parseInt(cantidad[id])+1;
          descripcion[id] = $("#prods").find('option:selected').attr("min");
          cantactprod[id]=parseInt($("#prods").find('option:selected').attr("class"))-parseInt(cantidad[id]);
          if($("#exivan").prop("checked") == true && $("#tipoFac").val() != "3")
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))*1.13).toFixed(2);
            exentas[id] = false;
            afectadas[id] = (parseInt($("#cantProd").val())*precio[id]).toFixed(2);
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th></th><th>"+String(afectadas[id])+"</th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }
          else
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))).toFixed(2);
            exentas[id] = (parseInt($("#cantProd").val())*precio[id]).toFixed(2);
            afectadas[id] = false;
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th>"+String(exentas[id])+"</th><th></th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }

          $("#detalleCompra").empty();
          table.forEach( function(valor, indice, array) {
            $("#detalleCompra").append(valor);
          });
        }
      
   }
   else
   {

      if(parseInt(cantidad[id]) >= parseInt($("#prods").find('option:selected').attr("class")))
        {
          swal({
              title: "Error",
              text: "Ha superado la cantidad en existencia del producto.\nCantidad en existencia = "+String(cantactprod[id]),
              timer: 1500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
        }
        else
        {
          cantidad[id] = parseInt(cantidad[id])+1;
          descripcion[id] = $("#prods").find('option:selected').attr("min");
          cantactprod[id]=parseInt($("#prods").find('option:selected').attr("class"))-parseInt(cantidad[id]);
          if($("#exivan").prop("checked") == true && $("#tipoFac").val() != "3")
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))*1.13).toFixed(2);
            exentas[id] = false;
            afectadas[id] = (parseInt(cantidad[id])*precio[id]).toFixed(2);
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th></th><th>"+String(afectadas[id])+"</th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }
          else
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max")).toFixed(2));
            exentas[id] = (parseInt($("#cantProd").val())*precio[id]).toFixed(2);
            afectadas[id] = false;
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th>"+String(exentas[id])+"</th><th></th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }

          $("#detalleCompra").empty();
          table.forEach( function(valor, indice, array) {
            $("#detalleCompra").append(valor);
          });
        }

   }

    totalizar();

});

$(document).on("click",".btn4", function(){
    var id = $(this).attr('id');
    if(typeof(cantidad[id]) == 'undefined' || cantidad[id] === null)
   {
        if(parseInt(cantidad[id])<=1)
        {
          swal({
              title: "Error",
              text: "El producto no puede ser menor a 1",
              timer: 1500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
        }
        else
        {
          cantidad[id] = parseInt(cantidad[id])-1;
          descripcion[id] = $("#prods").find('option:selected').attr("min");
          cantactprod[id]=parseInt($("#prods").find('option:selected').attr("class"))-parseInt(cantidad[id]);
          if($("#exivan").prop("checked") == true && $("#tipoFac").val() != "3")
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))*1.13).toFixed(2);
            exentas[id] = false;
            afectadas[id] = (parseInt($("#cantProd").val())*precio[id]).toFixed(2);
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th></th><th>"+String(afectadas[id])+"</th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }
          else
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))).toFixed(2);
            exentas[id] = (parseInt($("#cantProd").val())*precio[id]).toFixed(2);
            afectadas[id] = false;
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th>"+String(exentas[id])+"</th><th></th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }

          $("#detalleCompra").empty();
          table.forEach( function(valor, indice, array) {
            $("#detalleCompra").append(valor);
          });
        }
      
   }
   else
   {

      if(parseInt(cantidad[id])<=1)
        {
          swal({
              title: "Error",
              text: "El producto no puede ser menor a 1",
              timer: 1500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
        }
        else
        {
          cantidad[id] = parseInt(cantidad[id])-1;
          descripcion[id] = $("#prods").find('option:selected').attr("min");
          cantactprod[id]=parseInt($("#prods").find('option:selected').attr("class"))-parseInt(cantidad[id]);
          if($("#exivan").prop("checked") == true && $("#tipoFac").val() != "3")
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))*1.13).toFixed(2);
            exentas[id] = false;
            afectadas[id] = (parseInt(cantidad[id])*precio[id]).toFixed(2);
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th></th><th>"+String(afectadas[id])+"</th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }
          else
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max")).toFixed(2));
            exentas[id] = (parseInt($("#cantProd").val())*precio[id]).toFixed(2);
            afectadas[id] = false;
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th>"+String(exentas[id])+"</th><th></th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }

          $("#detalleCompra").empty();
          table.forEach( function(valor, indice, array) {
            $("#detalleCompra").append(valor);
          });
        }

   }

    totalizar();

});

function valProds()
{
  var desc = $("#prods").find('option:selected').attr("min");
  var price = $("#prods").find('option:selected').attr("max");

  $("#descProd").val(desc);
  $("#preProd").val(price);
}

function valDS()
{
  var aux = "";
  $("#numSerie").children('option').prop( "disabled", true );
  $("#numSerie").children('option').hide();
  $("#numSerie").children("option[class^=" + $("#tipoFac").find('option:selected').attr("name") + "]").prop( "disabled", false );
  $("#numSerie").children("option[class^=" + $("#tipoFac").find('option:selected').attr("name") + "]").show();
  $("#numSerie option").each(function(i){
        if($(this).prop("disabled")==false)
        {
          if(aux=="")
          {
            aux = $(this).val();
          }
        }
    });
  $("#numSerie").val(aux);
}

function valRadios()
{
  if($("#exivay").is(':checked'))
  {
    $("#tipoProd").val(1);
  }
  else if($("#exivan").is(':checked'))
  {
    $("#tipoProd").val(0);
  }
}

function valChkCli()
{
  var clasi = $("#nombreCli").find('option:selected').attr("name");
  var nit = $("#nombreCli").find('option:selected').attr("class");
  var nrc = $("#nombreCli").find('option:selected').attr("min");
  var dir = $("#nombreCli").find('option:selected').attr("max");

  $("#exivay").prop( "disabled", true );
  $("#exivan").prop( "checked", true );
  $("#arn").prop( "checked", true );

  if(clasi == "gran contribuyente")
  {
    $("#ary").prop( "disabled", false );
    $("#ary").prop( "checked", true );
    $("#arn").prop( "disabled", true );
  }
  else if(clasi == "ninguno")
  {
    $("#exivay").prop( "disabled", false );
    $("#ary").prop( "disabled", false );
    $("#arn").prop( "disabled", false );
  }
  else
  {
    $("#arn").prop( "disabled", false );
    $("#ary").prop( "disabled", true );
  }

  $("#nitCli").val(nit);
  $("#classCli").val(clasi);
  $("#dirCli").val(dir);
  $("#regCli").val(nrc);
}

function save2table()
{
  var id = $("#prods").val();
   if(typeof(cantidad[id]) == 'undefined' || cantidad[id] === null)
   {
        if(parseInt($("#cantProd").val()) > parseInt($("#prods").find('option:selected').attr("class")))
        {
          swal({
              title: "Error",
              text: "Ha superado la cantidad en existencia del producto.\nCantidad en existencia = "+$("#prods").find('option:selected').attr("class"),
              timer: 1500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
        }
        else
        {
          cantidad[id] = $("#cantProd").val();
          descripcion[id] = $("#prods").find('option:selected').attr("min");
          cantactprod[id]=parseInt($("#prods").find('option:selected').attr("class"))-parseInt($("#cantProd").val());
          if($("#exivan").prop("checked") == true && $("#tipoFac").val() != "3")
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))*1.13).toFixed(2);
            exentas[id] = false;
            afectadas[id] = (parseInt($("#cantProd").val())*precio[id]).toFixed(2);
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th></th><th>"+String(afectadas[id])+"</th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }
          else
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))).toFixed(2);
            exentas[id] = (parseInt($("#cantProd").val())*precio[id]).toFixed(2);
            afectadas[id] = false;
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th>"+String(exentas[id])+"</th><th></th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }

          $("#detalleCompra").empty();
          table.forEach( function(valor, indice, array) {
            $("#detalleCompra").append(valor);
          });
        }
      
   }
   else
   {

      if(parseInt($("#cantProd").val()) > cantactprod[id])
        {
          swal({
              title: "Error",
              text: "Ha superado la cantidad en existencia del producto.\nCantidad en existencia = "+String(cantactprod[id]),
              timer: 1500,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
        }
        else
        {
          cantidad[id] = parseInt(cantidad[id])+parseInt($("#cantProd").val());
          descripcion[id] = $("#prods").find('option:selected').attr("min");
          cantactprod[id]=cantactprod[id]-parseInt($("#cantProd").val());
          if($("#exivan").prop("checked") == true && $("#tipoFac").val() != "3")
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))*1.13).toFixed(2);
            exentas[id] = false;
            afectadas[id] = (parseInt(cantidad[id])*precio[id]).toFixed(2);
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th></th><th>"+String(afectadas[id])+"</th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }
          else
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max")).toFixed(2));
            exentas[id] = (parseInt($("#cantProd").val())*precio[id]).toFixed(2);
            afectadas[id] = false;
            table[id]="<tr><th>"+cantidad[id]+"</th><th>"+descripcion[id]+"</th><th>"+String(precio[id])+"</th><th>"+String(exentas[id])+"</th><th></th><th><button id='"+id+"' class='btn btn-danger btn2'>X</button>&nbsp;<button id='"+id+"' class='btn btn-info btn3'>↑</button>&nbsp;<button id='"+id+"' class='btn btn-info btn4'>↓</button></th></tr>";
          }

          $("#detalleCompra").empty();
          table.forEach( function(valor, indice, array) {
            $("#detalleCompra").append(valor);
          });
        }

   }
}

function totalizar()
{
  var subtotal=0;
  var excs = 0;
  var cantotal = 0;
  var siniva = 0;
  var totalabs = 0;
  retencion=false;
  percepcion=false;

  exentas.forEach( function(valor, indice, array) {
    if(valor != false)
    {
      subtotal=subtotal+parseFloat(valor);
      excs=excs+parseFloat(valor);
    }
  });
  afectadas.forEach( function(valor, indice, array) {
    if(valor != false)
    {
      subtotal=subtotal+parseFloat(valor);
    }
  });

  /*if($("#classCli").val() != "gran contribuyente" && subtotal >= 100)
  {
    retencion=true;
    percepcion=false;
  }*/
  if($("#tipoFac").val() == "1" && $("#classCli").val() != "gran contribuyente" && $("#arn").prop( "checked", true ) && subtotal >= 100)
  {
    retencion=false;
    percepcion=true;
  }

  var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
});


  precio.forEach( function(valor, indice, array) {
    if(valor != false)
    {
      siniva=siniva+(parseFloat(valor)*parseInt(cantidad[indice]));
    }
  });

  cantidad.forEach( function(valor, indice, array) {
    if(valor != false)
    {
      cantotal=cantotal+valor;
    }
  });

  

  $("#sumas1").val(formatter.format(0));
  switch ($("#tipoFac").val()) {
    case "1":
      totalabs=subtotal;
      $("#sumas2").val(formatter.format(siniva/1.13));
      $("#iva").val(formatter.format((siniva/113)*13));
      $("#st").val(formatter.format(subtotal));
      $("#rmenos").val(formatter.format(0));
      if(percepcion==true)
      {
        totalabs=totalabs+((siniva/113)*cantotal);
        $("#rmas").val(formatter.format(siniva/113));
      }
      else
      {
        $("#rmas").val(formatter.format(0));
      }
      $("#vext").val(formatter.format(excs));
      var st = String($("#st").val());
      var rmas = String($("#rmas").val());
      var aux1 = parseFloat(st.substring(1));
      var aux2 = parseFloat(rmas.substring(1));
      var aux3 = aux1+aux2;
      $("#vt").val(formatter.format((aux3)));
      $("#totalPago").val(formatter.format((aux3)));
      break;
    case "2":
      totalabs=subtotal;
      $("#iva").val(formatter.format(0));
      $("#st").val(formatter.format(0));
      $("#sumas2").val(formatter.format(subtotal));
      $("#rmenos").val(formatter.format(0));
      if(percepcion==true)
      {
        totalabs=totalabs+((siniva/113)*cantotal);
        $("#rmas").val(formatter.format(siniva/113));
      }
      else
      {
        $("#rmas").val(formatter.format(0));
      }
      $("#vext").val(formatter.format(excs));
      $("#vt").val(formatter.format(totalabs));
      $("#totalPago").val(formatter.format(totalabs));
      break;
    case "3":
      totalabs=subtotal*cantotal;
      $("#sumas2").val(formatter.format(0));
      $("#iva").val(formatter.format(0));
      $("#st").val(formatter.format(0));
      $("#rmenos").val(formatter.format(0));
      $("#rmas").val(formatter.format(0));
      $("#vext").val(formatter.format(0));
      $("#vt").val(formatter.format(totalabs));
      $("#totalPago").val(formatter.format(totalabs));
      //Declaraciones ejecutadas cuando el resultado de expresión coincide con el valor1
      break;
  }

}

function valNumFactura()
{
  var serie = $("#numSerie").find('option:selected').attr("name");

  $.ajax({
        type: 'POST',
        async: false,
        dataType: 'json',
        data: {key: 'numeroFactura', serie:serie},
        url: 'controller/dsController.php',
        success: function(res)
        {
          if(res.estadoSen!=false)
          {
           
           $("#numfac").val(res.ultimo);
           $("#maxnum").val(res.maximo);
           $("#minnum").val(res.primero); 

          }
          else
          {
            $("#numfac").val(res.ultimo);
            $("#maxnum").val(res.maximo);
            $("#minnum").val(res.primero);
          }
        },
        error: function(xhr, status)
        {
            console.log('error :c');
        }
      });
}

function venta()
{
  var nombre = $("#nombreCli").val();
  var direccion = $("#dirCli").val();
  var nit = $("#nitCli").val();
  var nrc = $("#regCli").val();
  var row = document.getElementById("tableCompra").rows.length;

  if(nombre != "" && direccion != "" && nit != "" && nrc != "" && $('#detalleCompra tr').length > 0)
  {
      
  }
  else
  {
    swal({
              title: "Error",
              text: "Llene todos los datos de la factura para realizar la compra.",
              timer: 3000,
              type: 'error',
              closeOnConfirm: true,
              closeOnCancel: true,
              allowOutsideClick: false
              });
  }
}

});