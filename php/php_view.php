<?php echo '<?php'."\n";?>
if(!isset($_SESSION['pk_usuario'])){ 
	session_start(); 
}
$op=$_POST['op'];
$prefijo_op="<?=$objDatos->tbNombreUnidoCorto?>";
require_once("../model/General.php");
include_once('../parametros.php');
$general=new General();
switch($op){
?>
<?php echo '<?php'."\n";?>
case "main":
?>
<div uk-grid>
  
      <div class="uk-width-1-1">
            <div class="uk-card uk-card-default">
                  <div class="uk-card-header bg-card-header-1 uk-padding-small">
                   	<!--btns-->
                    <div uk-grid class="uk-grid-small">
                        <div class="uk-width-1-4 uk-width-4-5@s">
                            <div>
                            	<?php echo '<?=BT_LIST;?>';?> <span class="uk-text-bold uk-text-middle uk-visible@s">LISTA</span>
                            </div>
                        </div>
                 
                        <div class="uk-width-3-4 uk-width-1-5@s uk-padding-remove">
                            <div>
                            	<input type="hidden" id="txt_pk_hidden" /><?php echo '<?php //<-- HID PK?>';?>
                                
								<input type="hidden" id="box_txt_buscar_campo" value="campo_inicial" /><?php echo '<?php //<-- HID CAMPO BUSCAR?>';?>
                                
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: search"></span>
                                    <input class="uk-input uk-form-small" placeholder="Buscar" name="box_txt_buscar" id="box_txt_buscar"  />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--btns-->
                  </div>
                  
                  <div id="ct_form_body" class="uk-card-body height-100 uk-overflow-auto uk-padding-remove" uk-height-viewport="offset-top: true; offset-bottom:4">
                        <!--contents-->
                  </div>
              
            </div>
      </div>
  
</div>


<?php echo
"&lt;script> 
$('#box_txt_buscar').on('keydown', function(e) {
    if (e.which == 13) {
	listar_$objDatos->tbNombreUnidoCorto();
    }
});
</script>";?>

<?php echo '<?php'."\n";?>
break; /*FIN DE MAIN*/
?>
<?php //=============================================================?>
<?php echo '<?php'."\n";?>
/*NEW*/
case "new":
?>
<div uk-grid>
  
      <div class="uk-width-1-1">
            <div class="uk-card uk-card-default">
                  <div class="uk-card-header bg-card-header-1 uk-padding-small">
                  	<?php echo '<?=BT_NEW;?>';?> <span class="uk-text-bold uk-text-middle">NUEVO</span>
                  </div>

                  <div class="uk-card-body height-100 uk-overflow-auto uk-padding-small" uk-height-viewport="offset-top: true; offset-bottom:4">
                  
                         <!--form-->
                            <!--grid-->
                             <form class="uk-grid-small uk-form uk-grid-match" uk-grid>
                             	<div class="uk-width-1-2@s">
                                	<div class="uk-card uk-card-default uk-card-body">
                                        <div class="uk-grid-small" uk-grid>
                                        		<!--CAMPOS-->
                                            	<?=trim($objDatos->camposFormNew)."\n";?>
                                                <!--CAMPOS-->
                                        </div>
                                   </div>
                                </div>
                                
                                <div class="uk-width-1-2@s">
                                  <div class="uk-card uk-card-default uk-card-body">
                                    <div class="uk-grid-small" uk-grid>

                                        <div class="uk-width-1-2@s">
                                        	<label>Nombre del campo:</label>
                                            <input class="uk-input" type="text">
                                        </div>
                                        
                               		</div>
                                  </div>
                               </div>
                               
                               <div class="uk-width-1-1">
                                	<div class="uk-card uk-card-default uk-card-body uk-padding-small">
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@s">
                                                <button type="button" onclick="hacer_clic('#frm_bt_lista_<?php echo '<?=$prefijo_op;?>';?>');" class="uk-button uk-button-default"><i uk-icon="reply"></i> &amp;<?php echo 'nbsp;';?> <span class="uk-visible@s">Cancelar</span></button>        
                                            	<button type="button" value="Submit" onclick="validaForm_<?php echo '<?=$prefijo_op;?>';?>(1);" class="uk-button uk-button-primary"><i uk-icon="check"></i> &amp;<?php echo 'nbsp;';?> Guardar</button>
                                            </div>
                                            <div class="uk-width-1-2@s">
                                              	<div uk-alert class="uk-alert-danger uk-margin-remove fs10" style="display:none" id="frm_msg_error"></div>
                                            </div>
                                         </div>
                                   </div>
                                </div>
                                
                            <!--grid-->
                       		 </form>
                        <!--form-->
                  </div>
              
            </div>
      </div>
  
</div>

<?php echo "<!--\n&lt;script type=\"text/javascript\">\n validar_campos();\n</script>\n-->";?>

<?php echo '<?php'."\n";?>
break; //FIN DE NEW
?>
<?php //=============================================================?>
<?php echo '<?php'."\n";?>
} /*FIN SWITCH*/
?>
<?php echo "&lt;script type=\"text/javascript\">\ncampos_enter();\n</script>";?>