$(document).ready(function(){

$("#tipoFac").val(2);
valChkCli();

$('#nombreCli').on('change', function() {
  valChkCli();
});

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