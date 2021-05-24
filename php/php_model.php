<?php echo '<?php'."\n";?>
require_once('Conexion.php');
class <?=$objDatos->tbNombreCamello;?>{
<?php
echo $objDatos->camposPrivate;
echo "//-----------------------------\n";
?>
private $tb="<?=$objDatos->tbNombreOriginal;?>";
private $tb_pk="<?=$objDatos->pkTabla?>";
public function __construct(<?=substr(trim($objDatos->camposConstruct),0,-1);?>){
<?="\t\t\t\t\t\t\t"?><?=$objDatos->camposThis;?>
}
<?php
echo "//-------------GETTER AND SETTER----------------\n";
?>
public function __get($attr){
	$atributo = strtolower($attr);
	if (property_exists('<?=$objDatos->tbNombreCamello;?>', $atributo)){
		return $this->$attr;
 	}
	return NULL;
}

public function __set($attr,$val){
	$atributo = strtolower($attr);
	if(property_exists('<?=$objDatos->tbNombreCamello;?>',$atributo)){
		$this->$attr=$val;
 	}else{
		echo $attr." No existe atributo.";
 	}	
}
<?php
echo "//-----------------------------\n";
?>

public function insertar(){
  $con=new Conexion();
  $sql="insert into ".$this->tb." (<?=substr(trim($objDatos->camposLista),0,-1);?><?="\n\t\t\t\t\t\t"?>) values(<?="\n\t\t\t\t\t\t"?><?=substr(trim($objDatos->camposInsert),0,-1);?>)";
  $con->query($sql);
  $return_query=$con->affected_rows;
  $con->close();
  return $return_query;
}	

public function actualizar($pk){
  $con=new Conexion();
  $sql="update ".$this->tb." set <?=substr(trim($objDatos->camposUpdate),0,-1);?><?="\n\t\t\t\t\t\t"?> WHERE ".$this->tb_pk."='$pk'";
  $con->query($sql);
  $return_query=$con->affected_rows;
  $con->close();
  return $return_query;
}

}
<?php echo '?>';?>