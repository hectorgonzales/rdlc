<?php
include_once("../Datos.php");
$op=$_POST['op'];
	$h=$_POST['h'];
	$u=$_POST['u'];
	$p=$_POST['p'];
	$d=$_POST['d'];
	$port=$_POST['port'];
	$tb=$_POST['tb'];

	$objDatos=new Datos($h,$u,$p,$d,$port);
?>
<?php
$objDatos->prepararNombreTablas($tb);
$da=$objDatos->prepararCamposTablas($tb);
?>

<?php
switch($op){ 	
	case 'model':
		$totalCampos=$_POST['tn'];
		$campos=json_decode(stripslashes($_POST['ca']));
		$tipos=json_decode(stripslashes($_POST['tp']));
		
		$objDatos->prepararCamposTablaVB($campos,$tipos,$totalCampos);
		
		include('vb_model.php');
	break; 

	?>
		
	<?php
	case 'controller':
		include('vb_controller.php');
	break;
	?>
	
	<?php
	case 'connection':
		include('vb_connection.php');
	break;
	?>
    
    <?php
	case 'general':
		include('vb_general.php');
	break;
	?>
    
    <?php
	case 'general_view':
		include('vb_general_view.php');
	break;
	?>
    
    
    <?php
	case 'vb_ver_tipo': ?>
		<?=$objDatos->verCamposTipo($tb);?>
	<?php
    break;
	?>

	
<?php
} //end switch ============================================
?>