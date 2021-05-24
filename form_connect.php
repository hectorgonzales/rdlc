<form method="post" class="uk-form" >
    <input type="text" id="txt_server" class="uk-margin-small-bottom" value="localhost" /><br />
    <select id="txt_port" class="uk-margin-small-bottom">
    	<option>3306</option>
        <option>3307</option>
    </select><br />
    <input type="text" id="txt_user" class="uk-margin-small-bottom" value="root" /><br />
    <input type="text" id="txt_password" class="uk-margin-small-bottom"/><br />
    <select id="txt_database" class="uk-margin-small-bottom">
    	<option>app_inventario</option>
        <option>app_proforma</option>
        <option>appcr7</option>
        <option>appcaja</option>
        <option>app_sitd</option>
    </select>
	<br />
    <button class="uk-button uk-button-success" onclick="conectar_db();" type="button">CONECTAR</button>
</form>