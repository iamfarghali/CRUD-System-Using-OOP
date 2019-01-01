<?php 

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set number of records per page
$recordsPerPage = 5;

// calculate for the query LIMIT clause
$fromRecordNum = ($recordsPerPage * $page) - $recordsPerPage;

// include necessary classes
include_once "config/database.php";
include_once "classes/category.php";
include_once "classes/product.php";
include_once "helper/validation.php";

// get database connection
$database = new Database;
$dbConnection = $database->getConnection();

// pass db connection to category and product and initialize its objects
$category = new Category($dbConnection);
$product = new Product($dbConnection);

// query for product
$productStmt = $product->readAll($fromRecordNum, $recordsPerPage);
$numOfRetrievedRecords = $productStmt->rowCount();

// set page headers
$pageTitle = "Products";
$cssPath = 'libs/frontend/css/main.css';
include_once "layout/header.php";
?>

<div class="right-button-margin">
	<a href="pages/product/add_product.php" class="btn btn-default pull-right">Add Product</a>
</div>

<?php if ($numOfRetrievedRecords > 0) { ?>
	<table class="table table-hover table-responsive table-bordered">
		<tr>
			<th>Product</th>
			<th>Description</th>
			<th>Price</th>
			<th>Category</th>
			<th>Action</th>
		</tr>
<?php
		while ($product = $productStmt->fetch(PDO::FETCH_ASSOC)) {
			extract($product);
?>
		<tr>
			<td><?= $name ?></td>
			<td><?= $description ?></td>
			<td><?= $price ?></td>
			<td>
				<?php 
					$category->id = $category_id;
					$category->readCategoryName(); 
					echo $category->name;
				?>
			</td>
			<td>
				<!-- // Action -->
			</td>
		</tr>
<?php
	  } ?>
  			</table>
<?php } else {
?>
		<div class="alert alert-info">No Products Found.</div>		
<?php
	}
?>

<?php
// footer
include_once "layout/footer.php";
?>