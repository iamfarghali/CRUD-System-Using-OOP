<?php
if ($_POST) {

	// include necessary classes
	include_once "../../config/database.php";
	include_once "../../classes/category.php";
	include_once "../../classes/product.php";
	include_once "../../helper/validation.php";

	// get database connection
	$database = new Database;
	$dbConnection = $database->getConnection();

	// pass db connection to product and initialize its object
	$product = new Product($dbConnection);
	$product->id = $_POST['object_id'];

	if ($product->delete()) {
		echo 'Product Is Deleted';
	} else {
		echo 'Product Is Not Deleted Yet!';
	}
	
}
