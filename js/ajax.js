// JavaScript Document

function conectar_db(){
		var h=$("#txt_server").val();
		var u=$("#txt_user").val();
		var p=$("#txt_password").val();
		var d=$("#txt_database").val();
		var port=$("#txt_port").val();
 		var parametros = {'op':'tablas','h':h,'u':u,'p':p,'d':d,'port':port}
  $.ajax({
	  data:  parametros,
	  cache: false,
	  url:   './control.php',
	  type:  'post',
	  beforeSend: function () {
		$("#ct_tablas").html("<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...");
	  },
	  success: function(response){
		$("#ct_tablas").html(response);
		ver_lenguajes();
	  }
  });
}

//--------------------------------------------------------------------------------------------------------
function ver_lenguajes(){
  	var parametros = {'op':'lenguajes'}
  	$.ajax({
		  data:  parametros,
		  cache: false,
		  url:   './estructura.php',
		  type: 'post',
		  beforeSend: function () {
				  $("#ct_lenguajes").html("<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...");
		  },
		  success:  function (response) {
				  $("#ct_lenguajes").html(response);
		  }
  	});
}

//--------------------------------------------------------------------------------------------------------
function ver_php(){		
  	var parametros = {'op':'php'}
  	$.ajax({
		  data:  parametros,
		  cache: false,
		  url:   './estructura.php',
		  type: 'post',
		  beforeSend: function () {
				  $("#ct_opciones").html("<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...");
		  },
		  success:  function (response) {
				  $("#ct_opciones").html(response);
				  $("#ct_campos").html("");
		  }
  	});
}

//--------------------------------------------------------------------------------------------------------
function ver_vb(){		
  	var parametros = {'op':'vb'}
  	$.ajax({
		  data:  parametros,
		  cache: false,
		  url:   './estructura.php',
		  type: 'post',
		  beforeSend: function () {
				  $("#ct_opciones").html("<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...");
		  },
		  success:  function (response) {
				  $("#ct_opciones").html(response);
				  $("#ct_campos").html("");
		  }
  	});
}
//----------------------------------
function seleccionar(){
$("#ct_proceso").select();
document.execCommand("copy");
}
