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
	//$objDatos=new Datos("localhost","root","usbw","alma_tdm");
	if(isset($_POST['version'])){
		$version=$_POST['version'];
	}else{
		$version="";
	}
?>
<?php
$objDatos->prepararNombreTablas($tb);
$da=$objDatos->prepararCamposTablaPHP($tb);
?>

<?php
switch($op){ 	
	case 'model':
		include('php_model.php');
	break; 
	?>
		
	<?php
	case 'controller_php':
		include('php_controller.php');
	break;
	?>
	
	<?php
	case 'controller_js':
		include('php_controller_js.php');
	break;
	?>
	<?php
	case 'view':
		include('php_view.php');
	break;
	?>    
	
	<?php
	case 'alert_js':
		echo "alert(".substr($objDatos->camposAlertJs,0,-5).");";
	break;
	?>
	
<?php
} //end switch ============================================
?>