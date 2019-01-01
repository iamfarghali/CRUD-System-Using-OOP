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

	public function countAll() {
		$query = "SELECT id FROM " .$this->tableName. "";
		$stmt =$this->conn->prepare($query);
		$stmt->execute();
		return $stmt->rowCount(); 
	}

	public function readOne() {
		$query = "SELECT name, price, description, category_id FROM " .$this->tableName. " WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->execute([$this->id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->name = $row['name'];
		$this->price = $row['price'];
		$this->description = $row['description'];
		$this->category_id = $row['category_id'];
	}

	public function update() {
		$query = "UPDATE
					" .$this->tableName. " 
				  SET
				  	name = :name,
				  	price = :price,
				  	description = :description,
				  	category_id = :category_id
				 WHERE 
				 	id = :id 
				";
		$stmt = $this->conn->prepare($query);
		$bindParams = [
			':name' => $this->name,
			':price' => $this->price,
			':description' => $this->description,
			':category_id' => $this->category_id,
			':id' => $this->id
		];

		if ($stmt->execute($bindParams)) {
			return true;
		}
		return false;
	}

	public function delete() {
		$query = "DELETE FROM " .$this->tableName. " WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		if ($stmt->execute([$this->id])) {
			return true;
		} else {
			return false;
		}

	}
}