$(document).ready(function(){

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

});