<?php 
class Connection
{
	private $host="localhost";
	private $user="root";
	private $db="vuedb";
	private $pass="";
	private $charset = 'UTF8';
	private $opt = [
	    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
	    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
	    \PDO::ATTR_EMULATE_PREPARES   => false,
	];

	protected $conn;
	
	public function __construct(){
	 	$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset.";".$this->db,$this->user,$this->pass, $this->opt);
	}
}

