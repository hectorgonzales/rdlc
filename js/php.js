// JavaScript Document
function php_model(){
		var h=$("#txt_server").val();
		var u=$("#txt_user").val();
		var p=$("#txt_password").val();
		var d=$("#txt_database").val();
		var tb=$("#txt_table").val();
		var port=$("#txt_port").val();
 var parametros = {'op':'model','h':h,'u':u,'p':p,'d':d,'tb':tb,'port':port}

  $.ajax({
	  data:  parametros,
	  cache: false,
	  url:   './php/php.php',
	  type:  'post',
	  beforeSend: function () {
		$("#ct_proceso").html("<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...");
	  },
	  success: function(response){
		$("#ct_proceso").html(response.trim());
	  }
  });
}
//=======================================================================================================
function php_controller_php(version){
		var h=$("#txt_server").val();
		var u=$("#txt_user").val();
		var p=$("#txt_password").val();
		var d=$("#txt_database").val();
		var tb=$("#txt_table").val();
		var port=$("#txt_port").val();

 var parametros = {'op':'controller_php','h':h,'u':u,'p':p,'d':d,'tb':tb,'port':port,'version':version}
  $.ajax({
	  data:  parametros,
	  cache: false,
	  url:   './php/php.php',
	  type:  'post',
	  beforeSend: function () {
		$("#ct_proceso").html("<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...");
	  },
	  success: function(response){
		$("#ct_proceso").html(response.trim());
	  }
  });
}

//=======================================================================================================
function php_controller_js(version){
		var h=$("#txt_server").val();
		var u=$("#txt_user").val();
		var p=$("#txt_password").val();
		var d=$("#txt_database").val();
		var tb=$("#txt_table").val();
		var port=$("#txt_port").val();
		
 var parametros = {'op':'controller_js','h':h,'u':u,'p':p,'d':d,'tb':tb,'port':port,'version':version}
  $.ajax({
	  data:  parametros,
	  cache: false,
	  url:   './php/php.php',
	  type:  'post',
	  beforeSend: function () {
		$("#ct_proceso").html("<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...");
	  },
	  success: function(response){
		$("#ct_proceso").html(response);
	  }
  });
}

//=======================================================================================================
function php_view(version){
		var h=$("#txt_server").val();
		var u=$("#txt_user").val();
		var p=$("#txt_password").val();
		var d=$("#txt_database").val();
		var tb=$("#txt_table").val();
		var port=$("#txt_port").val();
		
 var parametros = {'op':'view','h':h,'u':u,'p':p,'d':d,'tb':tb,'port':port,'version':version}
  $.ajax({
	  data:  parametros,
	  cache: false,
	  url:   './php/php.php',
	  type:  'post',
	  beforeSend: function () {
		$("#ct_proceso").html("<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...");
	  },
	  success: function(response){
		$("#ct_proceso").html(response);
	  }
  });
}
//=======================================================================================================
function php_alert_js(){
		var h=$("#txt_server").val();
		var u=$("#txt_user").val();
		var p=$("#txt_password").val();
		var d=$("#txt_database").val();
		var tb=$("#txt_table").val();
		var port=$("#txt_port").val();
		
 var parametros = {'op':'alert_js','h':h,'u':u,'p':p,'d':d,'tb':tb,'port':port}
  $.ajax({
	  data:  parametros,
	  cache: false,
	  url:   './php/php.php',
	  type:  'post',
	  beforeSend: function () {
		$("#ct_proceso").html("<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...");
	  },
	  success: function(response){
		$("#ct_proceso").html(response);
	  }
  });
}