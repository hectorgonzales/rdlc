<?php $op=$_POST['op'];
$host=$_POST['h'];
$db=$_POST['d'];
$user=$_POST['u'];
$pass=$_POST['p'];
$con=mysql_connect($host,$user,$pass);
mysql_select_db($db,$con);

$tb=$_POST['tb'];
if($tb!="null"){ ?>
	<?php  
		$noms_tb=preg_split("/[_]/",$tb);
		$n_tb="";
		$n_tb_minus="";
		for($i=0;$i<count($noms_tb);$i++){
			$n_tb.=ucfirst($noms_tb[$i]);
			$n_tb_minus.=$noms_tb[$i];
		}  
	  $tabla=mysql_query("describe $tb",$con);
	  //---------------------------------------------------
		$pk_tabla="";
		$n=1;
		$campos_tb="";
		$campos_tb_dolar="";
		$campos_insert="";
		$campos_update="";
		$campos_private="";
		$campos_construct="";
		$campos_this="";
		//---------------LISTA------------------
		$campos_lista="";
		$campos_celdas="";
		//---------------INSERT------------------
		$campos_post="";
		//---------------JS-----------------------
		$campos_insert_js="";
		$campos_insert_post_js="";
		$campos_alert_js="";
		while($campos=mysql_fetch_array($tabla)){
		 if($n==1){ $pk_tabla=$campos['Field'];}
		 //-------------------------------------------------------------------------
		 if($n>1){
		     $campos_private.="private $".$campos['Field'].";\n";
			 $campos_construct.="$".$campos['Field']."=\"\",";
		     $campos_this.='$this->'.$campos['Field']."=$".$campos['Field'].";\n";
			 $campos_tb.=$campos['Field'].",";
			 $campos_insert.="'".'$this->'.$campos['Field']."',";
			 $campos_update.=$campos['Field'].'=\'$this->'.$campos['Field']."',";			 
			 //-------------------------------------------------
			 $campos_lista.="<th data-campo=\"".$campos['Field']."\">".strtoupper($campos['Field'])."</th>\n";
			 $campos_celdas.='<td><?=$fila[\''.$campos['Field'].'\']?></td>'."\n";
			 //-------------------------------------------
			 $campos_post.="$".$campos['Field'].'=$_POST[\''.$campos['Field']."'];\n";
			 $campos_tb_dolar.="$".$campos['Field'].",";
			  //---------------------------------------------
		     $campos_insert_js.="var ".$campos['Field']."=$('#txt_".$campos['Field']."').val();\n";
			 $campos_insert_post_js.="'".$campos['Field']."':".$campos['Field'].",";
			 $campos_alert_js.=$campos['Field']."+\"-\"+";
		 } //sin pk
		 $n++;
		} //end while
		
?><?php
switch($op){ //==============================	
case 'model':?>

<?php echo '<?php'."\n";?>
require_once('Conexion.php');
class <?=$n_tb;?>{
<?php
echo $campos_private;
echo "//-----------------------------\n";
?>
private $tb="<?=$tb;?>";
private $tb_pk="<?=$pk_tabla?>";
public function __construct(<?=substr($campos_construct,0,-1);?>){
<?=$campos_this;?>
}

public function insertar(){
  $con=new Conexion();
  $sql="insert into ".$this->tb." (<?=substr($campos_tb,0,-1);?>) values(<?=substr($campos_insert,0,-1);?>)";
  $con->query($sql);
  $return_query=$con->affected_rows;
  $con->close();
  return $return_query;
}

public function actualizar($pk){
  $con=new Conexion();
  $sql="update ".$this->tb." set <?=substr($campos_update,0,-1);?> WHERE ".$this->tb_pk."='$pk'";
  $con->query($sql);
  $return_query=$con->affected_rows;
  $con->close();
  return $return_query;
}

}
<?php echo '?>';?>
<?php
break; //====END==================================================
?>
	
<?php
//============CONTROLLER========================
case 'controller_php':
?><?php include('php_controller.php');?>
<?php
break;//====END==================================================
?>

<?php
//============CONTROLLER JS========================
case 'controller_js':
?><?php include('php_controller_js.php');?>
<?php
break;//====END==================================================
?>

<?php
//============ALERT JS========================
case 'alert_js':
?>
<?php
echo "alert(".substr($campos_alert_js,0,-5).");";
?>
<?php
break;//====END==================================================
?>
	
<?php
} //end switch ============================================

}else{
	echo "Debe Seleccionar una Tabla.";
}// end if
?>