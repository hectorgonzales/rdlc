<?php
class Conexion extends mysqli{
    private $server;
    private $user;
    private $password;
    private $database;
	private $port;

    public function __construct($s="localhost",$u="root",$p="",$db="",$port=""){
		$this->server=$s;
		$this->user=$u;
		$this->password=$p;
		$this->database=$db;
		$this->port=$port;
       parent:: __construct($this->server, $this->user, $this->password, $this->database, $this->port); 
        
    }
}
?>