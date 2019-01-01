<?php

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
$categoryStmt = $category->readAll();

// set page headers
$pageTitle = "Add Product";
$cssPath = '../../libs/frontend/css/main.css';
include_once "../../layout/header.php";
?>

<!-- botton to show products -->
<div class="right-button-margin">
	<a href="../../index.php" class="btn btn-default pull-right">Show Products</a>
</div>


<!-- if method is post -->
<?php
	if ($_POST) {
		$product->category_id = stringValidator($_POST['category_id']);
		$product->description = stringValidator($_POST['description']);
		$product->name 		  = stringValidator($_POST['name']);
		$product->price 	  = stringValidator($_POST['price']);

		if ($product->create()) {
			echo "<div class='alert alert-success'>Product was created.</div>";
		} else {
			echo "<div class='alert alert-danger'>Unable to create product.</div>";
		}
	}
?>


<!-- creating product form -->
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" accept-charset="utf-8">
	<table class='table table-hover table-responsive table-bordered'>
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" class="form-control"></td>
			</tr>

			<tr>
				<td>Price</td>
				<td><input type="text" name="price" class="form-control"></td>
			</tr>

			<tr>
				<td>Descrition</td>
				<td><textarea name="description" class="form-control"></textarea></td>
			</tr>

	       <tr>
	            <td>Category</td>
	            <td>
	            	<select class="form-control" name="category_id">
	            		<option>Select Category ..</option>
	            		<?php
	            			while( $row = $categoryStmt->fetch(PDO::FETCH_ASSOC)) {
		            			extract($row);
		            			print_r($row);
	            		?>
		            			<option value="<?=$id?>"> <?=$name?> </option>
	            		<?php
	            			}
	            		?>
	            	</select>
	            </td>
	        </tr>
 
	        <tr>
	            <td></td>
	            <td>
	                <button type="submit" class="btn btn-primary">Create</button>
	            </td>
	        </tr>
	</table>
</form>

<?php
// footer
include_once "../../layout/footer.php";
?>