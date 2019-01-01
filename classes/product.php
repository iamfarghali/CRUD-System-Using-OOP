<?php

class Product
{
	private $conn;
	private $tableName = "products";

	public $id;
	public $name;
	public $description;
	public $price;
	public $category_id;
	public $timestamp;

	public function __construct($db) {
		$this->conn = $db;
	}

	public function create() {
		$query = "INSERT INTO " .$this->tableName. " SET
					name=:name, price=:price, description=:description, category_id=:category_id, created=:created ";
		$stmt = $this->conn->prepare($query);

		$this->timestamp = date("Y-m-d H:i:s");
		$bindParams = [
			':name' => $this->name,
			':price' => $this->price,
			':description' => $this->description,
			':category_id' => $this->category_id,
			':created' => $this->timestamp
		];

		if ( $stmt->execute($bindParams) ) {
			return true;
		} else {
			return false;
		}

	}

	public function readAll($fromRecordNum, $recordsPerPage) {
		$query = "SELECT id, name, description, price, category_id
				  FROM " .$this->tableName. "
				  ORDER BY name ASC
				  LIMIT " .$fromRecordNum. ", " .$recordsPerPage. "
				  ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}