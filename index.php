<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>GENCO v2 - Persson Tech</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" href="css/uikit.min.css" />-->
<link rel="stylesheet" href="css/uikit.gradient.css" />
<script type="text/javascript"  src="js/jquery.1.7.1.js"></script>
<script type="text/javascript"  src="js/uikit.min.js"></script>
</head>

<body style="paddsing:1em;">

    <div class="uk-grid uk-height-viewport uk-margin-remove">
    
    	<div class="uk-width-1-1" style="height:30% !important">
        	<div class="uk-grid uk-height-1-1">
                <div class="uk-width-1-10 uk-panel uk-panel-box">
                	<?php
                	include("form_connect.php");
                	?>
                </div>
                <div id="ct_tablas" class="uk-width-2-10 uk-panel uk-panel-box uk-height-1-1" style="overflow:auto !important"> </div>
                <div id="ct_lenguajes" class="uk-width-1-10 uk-panel uk-panel-box uk-height-1-1" style="overflow:auto !important"> </div>
                <div id="ct_opciones" class="uk-width-2-10 uk-panel uk-panel-box uk-height-1-1" style="overflow:auto !important"> </div>
                <div id="ct_campos" class="uk-width-4-10 uk-panel uk-panel-box uk-height-1-1" style="overflow:auto !important"> </div>
             </div>
        </div>
        
        <div class="uk-width-1-1" style="height:70% !important">
              
              <div class="uk-grid uk-height-1-1">
                <div class="uk-width-1-1 uk-height-1-1 uk-panel uk-panel-box">
                   <form class="uk-form uk-height-1-1">
               		<textarea id="ct_proceso" class="uk-form uk-width-1-1 uk-height-1-1" style="height:100%"></textarea>
                   </form>
                </div>
             </div>
        </div>
	</div>
</body>
<script type="text/javascript"  src="js/ajax.js"></script>
<script type="text/javascript"  src="js/php.js"></script>
<script type="text/javascript"  src="js/vb.js"></script>
</html>