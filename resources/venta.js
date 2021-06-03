$(document).ready(function(){

var cantidad = [];
var descripcion = [];
var precio = [];
var exentas = [];
var afectadas = [];
var cantactprod = [];
var table = [];

$("#tipoFac").val(2);
valChkCli();
valRadios();
valDS();
valProds();

$('#nombreCli').on('change', function() {
  valChkCli();
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

$('#prods').on('change', function() {
  valProds();
});

$('#btn1').click(function(){
    save2table();
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
          if($("#exivan").prop("checked") == true)
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
          if($("#exivan").prop("checked") == true)
          {
            precio[id] = (parseFloat($("#prods").find('option:selected').attr("max"))*1.13).toFixed(2);
            exentas[id] = false;
            afectadas[id] = (parseInt(cantidad[id])*precio[id]).toFixed(2);
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
}

});