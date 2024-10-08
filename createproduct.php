<?php
// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0) {
    // Read the JSON file
    $filePath = 'Data/products.json'; // Path to your JSON file
    $content = file_get_contents($filePath);
    
    // Convert the string into a PHP array
    $products = json_decode($content, true);
    
    // Add new product to the array
    $newProduct = [
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'image' => $_POST['product_image'],
		'description' => $_POST['product_description']
    ];
    $products[] = $newProduct;
    
    // Encode the array back into JSON
    $jsonContent = json_encode($products, JSON_PRETTY_PRINT);
    
    // Save the updated JSON content back to the file
    file_put_contents($filePath, $jsonContent);
    
    // Redirect to the index page after submission
    header('Location: index.php');
    exit;
} else {
    // Display the form if no POST data has been submitted
	
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
