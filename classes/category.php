<?php

class Category 
{
	private $conn;
	private $tableName = 'categories';

	public $id;
	public $name;

	public function __construct($db) {
		$this->conn = $db;
	}

	public function readAll() {
		$query = "SELECT id, name FROM " .$this->tableName. " ORDER BY name";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readCategory() {
		$query = "SELECT * FROM " .$this->tableName. " WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute([$this->id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->name = $row['name'];
	}
}
