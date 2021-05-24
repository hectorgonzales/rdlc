<?php echo '<?php'."\n";?>
require_once("../model/<?=$objDatos->tbNombreCamello?>.php");
require_once("../model/General.php");
include_once('../parametros.php');
$general=new General();
$tb="<?=$objDatos->tbNombreOriginal?>";
$tb_pk="<?=$objDatos->pkTabla?>";
$prefijo_op="<?=$objDatos->tbNombreUnidoCorto?>";
$op=$_POST['op'];
switch($op){
?>
<?php echo '<?php'."\n";?>
case "list":
?>
<table id="tb_lista" class="tb_lista" width="100%">
     <thead>
            <tr>
             <?="\t\t\t";?><th>N°</th>
             	<?php
				if($version==2){?>
		<?=trim($objDatos->camposGrid);?>
				<?php
				}elseif($version==3){?>
		<?=trim($objDatos->camposGridV3);?>
				<?php }//endif?>
            <?="\n\t";?></tr>
        </thead>
    <!--Table body-->        
    <tbody>
    	<?php echo '<?php'."\n";?>
		$txt=$_POST['txt'];
        $campo=$_POST['campo'];        
			if(trim($txt)==""){
				$ds=$general->listarRegistros($tb,$tb_pk);
			}else{
				$ds=$general->listarBuscar($tb,$campo,$txt);
			}			        	
			$tr=$ds->num_rows;
			if ($tr==0){
				echo "<td colspan='<?=$objDatos->totalCampos-1;?>'><div class=\"uk-alert uk-alert-warning uk-margin-top uk-margin-left uk-margin-right\"> No se encontraron registros. </div></td></tr>";
			}else{
				$n=1;
				while($fila=$ds->fetch_array(MYSQLI_ASSOC)){
				?>
				<tr id="fila<?php echo '<?=$fila[$tb_pk];?>';?>" ondblclick="hacer_clic('#frm_bt_modificar_<?php echo '<?=$prefijo_op;?>';?>');" onclick="pasar_pk_fila_lista('#txt_pk_hidden',<?php echo '<?=$fila[$tb_pk];?>';?>)">
					<td class="tc bgn" width="30"><?php echo '<?=$n;?>';?></td>
					<?php
				if($version==2){?>
<?=trim($objDatos->camposCeldas);?>
				<?php
				}elseif($version==3){?>
<?=trim($objDatos->camposCeldasV3);?>
				<?php }//endif?>
				<?="\n\t\t\t\t";?></tr>               
				<?php echo '<?php'."\n";?>
				$n++;
				} //fin while
			} //fin si
			?>
    </tbody>
    <!--Table body-->
</table>
<!--Table-->
<?php echo '<?php'."\n";?>
break; /*FIN DE LIST*/
?>


<?php //=============================================================?>
<?php echo '<?php'."\n";?>
/*INSERT*/
case "insert":
?>
<?php echo '<?php'."\n";?>
<?=$objDatos->camposPost;?>
			
	$obj = new <?=$objDatos->tbNombreCamello?>(<?=substr(trim($objDatos->camposDolar),0,-1);?>);
  	$obj->insertar();
?>
<?php echo '<?php'."\n";?>
break; //FIN DE INSERT
?>

<?php //=============================================================?>
<?php echo '<?php'."\n";?>
/*EDIT*/
case "edit":
?>
<?php echo '<?php'."\n";?>
$pk=$_POST['pk'];
$ds=$general->modificarRegistro($tb,$tb_pk,$pk);
$fila=$ds->fetch_assoc();
?>
<?php
if($version==2){
//=======================================
?>
    <div class="uk-panel uk-panel-box uk-width-2-3">
    <span class="uk-text-primary fs11"><i class="uk-icon-chevron-right"></i> MODIFICAR</span>
    <HR />
    <form method="post" id="" class="uk-form">
		<?php echo '<?php /*--*/?>'."\n";?>
    	<input type="hidden" name="pk_edit" id="txt_<?=$objDatos->tbNombreUnidoCorto;?>_pk" value="<?php echo '<?=$fila[$tb_pk]?>';?>" />
		<?php echo '<?php /*--*/?>'."\n";?>
        <!--form-->
        
		<!--form-->
        <table width="100%">
          <td colspan="2"><hr /></td><tr />
          <td>
          <button type="button" onclick="hacer_clic('#frm_bt_lista_<?php echo '<?=$prefijo_op;?>';?>');" class="uk-button uk-button-large uk-text-primary"><i class="uk-icon-reply"></i> </button>        
          <button type="button" value="Submit" onclick="validaForm_<?php echo '<?=$prefijo_op;?>';?>(2);" class="uk-button uk-button-large uk-button-primary"><i class="uk-icon-save"></i> &nbsp; Actualizar</button>
          </td>
          <td><div class="uk-alert uk-alert-warning uk-margin-remove" style="display:none" id="frm_msg_error"></div></td>
        </table>
    </form>
    </div>
<?php
}elseif($version==3){
//=======================================	
?>
<div uk-grid>
  
      <div class="uk-width-1-1">
            <div class="uk-card uk-card-default">
                  <div class="uk-card-header uk-padding-small">
                  	<?php echo '<?=BT_EDIT;?>';?> <span class="uk-text-bold uk-text-middle">MODIFICAR</span>
                  </div>

                  <div class="uk-card-body height-100 uk-overflow-auto uk-padding-small" uk-height-viewport="offset-top: true; offset-bottom:4">
                        <!--form-->
                        <form class="uk-grid-small uk-form uk-grid-match" uk-grid>
                        	<?php echo '<?php /*--*/?>'."\n";?>
                            <input type="hidden" name="pk_edit" id="txt_<?=$objDatos->tbNombreUnidoCorto;?>_pk" value="<?php echo '<?=$fila[$tb_pk]?>';?>" />
                           	<?php echo '<?php /*--*/?>'."\n";?>
                                <!--grid-->
                            <div class="uk-width-1-2@s">
                                	<div class="uk-card uk-card-default uk-card-body">
                                        	<div class="uk-grid-small" uk-grid>
                                        	<!--campos-->
                                                <div class="uk-width-1-1">
                                                    <label>label:</label>
                                                    <input type="text" class="uk-input uk-form-small uk-width-1-1 mayus" id="txt_campo" value="" />
                                                </div>
                                            <!--campos--> 
                                         	</div>
                                   	</div>
                               </div>
                                
                               <div class="uk-width-1-2@s">
                                  <!--columna 2-->
                               </div>
                               
                               <div class="uk-width-1-1">
                                	<div class="uk-card uk-card-default uk-card-body uk-padding-small">
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-1-2@s">
                                                <button type="button" onclick="hacer_clic('#frm_bt_lista_<?php echo '<?=$prefijo_op;?>';?>');" class="uk-button uk-button-default"><i uk-icon="reply"></i> &amp;<?php echo 'nbsp;';?> <span class="uk-visible@s">Cancelar</span></button>        
                                            	<button type="button" value="Submit" onclick="validaForm_<?php echo '<?=$prefijo_op;?>';?>(2);" class="uk-button uk-button-primary"><i uk-icon="check"></i> &amp;<?php echo 'nbsp;';?> Actualizar</button>
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

<?php
//=======================================
}//endif?>
<?php echo "&lt;script type=\"text/javascript\">\ncampos_enter();\n</script>";?>
    
<?php echo '<?php'."\n";?>
break; /*FIN DE EDIT*/
?>


<?php //=============================================================?>
<?php echo '<?php'."\n";?>
/*UPDATE*/
case "update":
?>
<?php echo '<?php'."\n";?>
$pk=$_POST['pk'];
<?=$objDatos->camposPost;?>
			
	$obj = new <?=$objDatos->tbNombreCamello?>(<?=substr(trim($objDatos->camposDolar),0,-1);?>);
  	$obj->actualizar($pk);
?>
<?php echo '<?php'."\n";?>
break; /*FIN DE UPDATE*/
?>
<?php //=============================================================?>
<?php echo '<?php'."\n";?>
case "delete":
?>
<?php echo '<?php'."\n";?>
	$pk=$_POST['pk'];		
	$general->eliminarRegistro($tb,$tb_pk,$pk);		
?>
<?php echo '<?php'."\n";?>
break; /* END DELETE*/
?>
<?php //=============================================================?>
<?php echo '<?php'."\n";?>
} /*FIN SWITCH*/
?>