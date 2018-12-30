<?php

class Database
{
	private $host = 'localhost';
	private $dbName = 'php_oop_crud_level_1';
	private $dbUser = 'root';
	private $dbPass = '';
	public $conn;

	// get db connection
	public function getConnection() {
		if ( $this->conn == null ) {
			try {
				$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->dbUser, $this->dbPass);
			} catch (PDOException $e) {
				echo "Connection Error, ". $e->getMessage();
			}
			return $this->conn;
		} else {
			return $this->conn;
		}
	}
}

?>