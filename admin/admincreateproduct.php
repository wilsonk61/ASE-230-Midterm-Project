<?php
require_once(__DIR__ . '/../functions.php');
$allowedSessionID = 1; 
if (!isset($_SESSION['email']) || $_SESSION['ID'] != $allowedSessionID) {
	die("Access Denied");
}

$email = $_SESSION['email'];
$id = $_SESSION['ID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0) {
    $filePath = __DIR__.'/../Data/Products.json';
    $content = file_get_contents($filePath);
    
    $products = json_decode($content, true);
    
    $newProduct = [
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'image' => $_POST['product_image'],
		'description' => $_POST['product_description'],
		'created_by' => $email,
		'id' => $id
    ];
    $products[] = $newProduct;
    
    $jsonContent = json_encode($products, JSON_PRETTY_PRINT);
    
    file_put_contents($filePath, $jsonContent);
    
    header('Location: index.php');
    exit;
} else {
    ?>
		<br>
		<div style="text-align: center; margin-bottom: 20px;">
			<a href="index.php" style="padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 5px;">Go Back</a>
		</div>
		<br>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
			<h3 style="text-align: center; margin-bottom: 20px;">Add New Product</h3>
			<div style="margin-bottom: 15px;">
				<label for="product_name" style="display: block; margin-bottom: 5px;">Product Name</label>
				<input type="text" name="product_name" id="product_name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter product name" required />
			</div>
			<div style="margin-bottom: 15px;">
				<label for="product_price" style="display: block; margin-bottom: 5px;">Product Price</label>
				<input type="text" name="product_price" id="product_price" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter product price" required />
			</div>
			<div style="margin-bottom: 15px;">
				<label for="product_image" style="display: block; margin-bottom: 5px;">Product Image URL</label>
				<input type="text" name="product_image" id="product_image" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter product image URL" required />
			</div>
			<div style="margin-bottom: 20px;">
				<label for="product_description" style="display: block; margin-bottom: 5px;">Product Description</label>
				<textarea name="product_description" id="product_description" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter product description" required></textarea>
			</div>
			<button type="submit" style="width: 100%; padding: 10px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer;">Add Product</button>
		</form>

    <?php
}
?>
