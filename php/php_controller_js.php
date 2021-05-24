<?php
if($version==2){
	$msg_procesando="<i class=\"uk-icon-refresh uk-icon-spin\"></i> Procesando...";
	$msg_msg="<i class=\"uk-icon-hand-o-right\"></i> Debe ingresar datos.";
}elseif($version==3){
	$msg_procesando="<div class='uk-text-center uk-text-primary uk-margin-top'><div uk-spinner></div> Procesando...</div>";
	$msg_msg="<i uk-icon='warning'></i> Debe ingresar datos.";
}
?>
//-------------------------------------------------------------------------------------------------------	
function main_<?=$objDatos->tbNombreUnidoCorto?>(){
 var parametros = {'op':'main'}
  $.ajax({
	  data:  parametros,
	  cache: false,
	  url:   'view/view_<?=$objDatos->tbNombreMinuscula?>.php',
	  type:  'post',
	  beforeSend: function () {
		$("#ct_form").html("Procesando...");
	  },
	  success: function(response){
		$("#ct_form").html(response);
		listar_<?=$objDatos->tbNombreUnidoCorto?>();  
	  }
  });
}
//--------------------------------------------------------------------------------------------------------
function listar_<?=$objDatos->tbNombreUnidoCorto?>(){
	var txt_campo_buscar=$('#box_txt_buscar_campo').val();
	var txt_buscar=$('#box_txt_buscar').val();

  	var parametros = {'op':'list','campo':txt_campo_buscar,'txt':txt_buscar}
  	$.ajax({
		  data:  parametros,
		  cache: false,
		  url: 'controller/ctrl_<?=$objDatos->tbNombreMinuscula?>.php',
		  type: 'post',
		  beforeSend: function () {
				  $("#ct_form_body").html("<?=$msg_procesando?>");
		  },
		  success:  function (response) {
				  $("#ct_form_body").html(response);
                  tb_seleccionar_fila_lista('#tb_lista',1);
		  }
  	});
}

//--------------------------------------------------------------------------------------------------------
function form_nuevo_<?=$objDatos->tbNombreUnidoCorto?>(){
  	var parametros = {'op':'new'}
  	$.ajax({
		  data:  parametros,
		  cache: false,
		  url:   'view/view_<?=$objDatos->tbNombreMinuscula?>.php',
		  type:  'post',
		  beforeSend: function () {
				  $("#ct_form").html("<?=$msg_procesando?>");
		  },
		  success:  function (response) {
				  $("#ct_form").html(response);
				  //$("#campo").focus();				  
		  }
  	});
}

//--------------------------------------------------------------------------------------------------------
function validaForm_<?=$objDatos->tbNombreUnidoCorto?>(op_frm) {  //1 ADD 2 EDIT
	var a=$("#txt_campo").val();
	
	var msg=$("#frm_msg_error");
	
	if(a=="" || a==null){	
		$("#txt_campo").focus();
		msg.html("<?=$msg_msg?>");		
		msg.show();		
		return false;
	}
		
		msg.hide();	
		
	if(op_frm==1){
		form_insertar_<?=$objDatos->tbNombreUnidoCorto?>();
	}else if(op_frm==2){
		form_actualizar_<?=$objDatos->tbNombreUnidoCorto?>()
	}
	return true;
}

//--------------------------------------------------------------------------------------------------------
function form_insertar_<?=$objDatos->tbNombreUnidoCorto?>(){	
<?="\t\t";?><?=$objDatos->camposInsertJs?>
var parametros = {'op':'insert',<?=substr(trim($objDatos->camposInsertPostJs),0,-1);?>}
  	$.ajax({
		  data:  parametros,
		  cache: false,		  
		  url:  'controller/ctrl_<?=$objDatos->tbNombreMinuscula?>.php',
		  type: 'post',
		  beforeSend: function () {
				 $("#ct_form_body").html("<?=$msg_procesando?>");
		  },
		  success:  function (response) {
				 main_<?=$objDatos->tbNombreUnidoCorto?>();
		  }
  	});
}

//--------------------------------------------------------------------------------------------------------
function form_modificar_<?=$objDatos->tbNombreUnidoCorto?>(){
	var pk=$("#txt_pk_hidden").val();
  	var parametros = {'op':'edit','pk':pk}
  	$.ajax({
		  data:  parametros,
		  cache: false,		  
		  url:  'controller/ctrl_<?=$objDatos->tbNombreMinuscula?>.php',
		  type:  'post',
		  beforeSend: function () {
				  $("#ct_form").html("<?=$msg_procesando?>");
		  },
		  success:  function (response) {
				  $("#ct_form").html(response);
				  //$("#campo").focus();	
		  }
  	});
}

//--------------------------------------------------------------------------------------------------------
function form_actualizar_<?=$objDatos->tbNombreUnidoCorto?>(){
	var pk=$("#txt_<?=$objDatos->tbNombreUnidoCorto?>_pk").val();
	
<?="\t\t";?><?=$objDatos->camposInsertJs?>
var parametros =  {'op':'update','pk':pk,<?=substr(trim($objDatos->camposInsertPostJs),0,-1);?>}
  	$.ajax({
		  data:  parametros,
		  cache: false,		  
		  url:   'controller/ctrl_<?=$objDatos->tbNombreMinuscula?>.php',
		  type:  'post',
		  beforeSend: function () {
				$("#ct_form_body").html("<?=$msg_procesando?>");
		  },
		  success:  function (response) {
				  main_<?=$objDatos->tbNombreUnidoCorto?>();
		  }
  	});
}
<?php if($version==2){?>
//--------------------------------------------------------------------------------------------------------
function form_eliminar_<?=$objDatos->tbNombreUnidoCorto?>(){
	UIkit.modal.confirm('Desea eliminar el Registro?.', function(){
	  	var pk=$("#txt_pk_hidden").val();
  		var parametros = {'op':'delete','pk':pk}
	  	$.ajax({
			  data:  parametros,
			  cache: false,		  
			  url:   'controller/ctrl_<?=$objDatos->tbNombreMinuscula?>.php',
			  type:  'post',
			  beforeSend: function () {
			  },
			  success:  function (response) {
					msg_popup("<i class='uk-icon-check'></i> Registro eliminado.");
					quitar_fila_lista(pk);
			  }
	  	});	

	}, {labels: {'Ok': 'Si', 'Cancel': 'No'}});

}
<?php }elseif($version==3){?>
//--------------------------------------------------------------------------------------------------------
function form_eliminar_<?=$objDatos->tbNombreUnidoCorto?>(){
	UIkit.modal.confirm('Desea eliminar el Registro?.', {labels:{ ok: 'Si', cancel:'No'}}).then(function() {
    	var pk=$("#txt_pk_hidden").val();
  		var parametros = {'op':'delete','pk':pk}
	  	$.ajax({
			  data:  parametros,
			  cache: false,		  
			  url:   'controller/ctrl_<?=$objDatos->tbNombreMinuscula?>.php',
			  type:  'post',
			  beforeSend: function () {
			  },
			  success:  function (response) {
					msg_popup("<i uk-icon='check'></i> Registro eliminado.");
					quitar_fila_lista(pk);
			  }
	  	});	
		
	}, function () {
		console.log('no.')
	});
	
}

<?php }//endif?>
//--------------------------------------------------------------------------------------------------------
/*
function form_eliminar_<?=$objDatos->tbNombreUnidoCorto?>(){
	var pk=$("#lista_txt_pk_hidden").val();
  	var parametros = {'op':'delete','pk':pk}
  	$.ajax({
		  data:  parametros,
		  cache: false,		  
		  url:   'controller/ctrl_<?=$objDatos->tbNombreMinuscula?>.php',
		  type:  'post',
		  beforeSend: function () {
				 //$("#ct_form_body").html("<?=$msg_procesando?>");
		  },
		  success:  function (response) {		  
				 quitar_fila_lista(pk);
		  }
  	});
}
*/
