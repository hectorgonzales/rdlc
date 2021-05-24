<?php
include_once("./Datos.php");
$op=$_POST['op'];
	$h=$_POST['h'];
	$u=$_POST['u'];
	$p=$_POST['p'];
	$d=$_POST['d'];
	$port=$_POST['port'];
	$obj=new Datos($h,$u,$p,$d,$port);

?>
<?php
switch($op){
	case "tablas":
?>
<?php /*===================================================================================*/?>
<!--TABLAS-->        
<form class="uk-form">
  <select id="txt_table" size="10" class="uk-width-1-1">
      	<?php
          $datos=$obj->verTablas();
		  $n=1;
		  while($fila=$datos->fetch_array(MYSQLI_NUM)){
		  ?>
      <option <?php if($n==1){echo "selected";}?>><?=$fila[0];?></option>
      <?php $n++; };?>
  </select>
</form>
<!--FIN TABLAS-->
<?php
break;
?>
<?php /*===================================================================================*/?>
<?php
case "ss":
?>

<?php
break;
?>


<?php
}/*END SWITCH*/
?>