<?php
$op=$_POST['op'];
?>
<?php
switch($op){
?>
<?php
case "lenguajes":
?>
<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onclick="ver_php();" type="button">PHP</button>
<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onclick="ver_vb();" type="button">BASIC</button>
<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onclick="" type="button">C#</button>
<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onclick="" type="button">JAVA</button>
<button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" onclick="" type="button">JS</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1" onclick="seleccionar();" type="button">SELECCIONAR</button>
<?php
break;
?>

<?php
case 'php':
?>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="php_model();" type="button">Model PHP</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="php_controller_php(2);" type="button">Controller PHP uikit v2</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="php_controller_php(3);" type="button">Controller PHP uikit v3</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="php_controller_js(2);" type="button">Controller JS uikit v2</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="php_controller_js(3);" type="button">Controller JS uikit v3</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="php_view(3);" type="button">View v3</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="php_alert_js();" type="button">Alert JS</button>
<?php
break;
?>

<?php
case 'vb':
?>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="vb_ver_tipo();" type="button">Model VB</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="vb_controller();" type="button">Controller VB</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="vb_connection();" type="button">Connection VB</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="vb_general();" type="button">General Model VB</button>
<button class="uk-button uk-button-mini uk-button-success uk-width-1-1 uk-margin-small-bottom" onclick="vb_general_view();" type="button">General View VB</button>



<?php
break;
?>

<?php
}/*END SWITCH*/
?>