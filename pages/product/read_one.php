<?php 
$id = isset($_GET['id']) ? $_GET['id'] : die('Error: Missing ID.');

// include necessary classes
include_once "../../config/database.php";
include_once "../../classes/category.php";
include_once "../../classes/product.php";
include_once "../../helper/validation.php";

// get database connection
$database = new Database;
$dbConnection = $database->getConnection();

// pass db connection to category and product and initialize its objects
$category = new Category($dbConnection);
$product = new Product($dbConnection);
$product->id = $id;
$product->readOne();


// set page headers
$pageTitle = ucwords($product->name);
$cssPath = '../../libs/frontend/css/main.css';
include_once "../../layout/header.php";
?>

<div class="right-button-margin">
	<a href="../../index.php" class="btn btn-default pull-right">Show Products</a>
</div>


	<table class="table table-hover table-responsive table-bordered">
		<tr>
			<th>Product</th>
			<th>Description</th>
			<th>Price</th>
			<th>Category</th>
		</tr>
		<tr>
			<td><?= $product->name ?></td>
			<td><?= $product->description ?></td>
			<td><?= $product->price ?></td>
			<td>
				<?php 
					$category->id = $product->category_id;
					$category->readCategoryName(); 
					echo $category->name;
				?>
			</td>
		</tr>
	</table>

<?php
// footer
include_once "../../layout/footer.php";
?>