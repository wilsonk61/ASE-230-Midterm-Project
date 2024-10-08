<?php
$filePath = 'Data/products.json';

$content = file_get_contents($filePath);

$products = json_decode($content, true);

if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $product = $products[$index];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $product = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'description' => $_POST['description']
    ];

    $products[$_GET['index']] = $product;

    $jsonContent = json_encode($products, JSON_PRETTY_PRINT);

    file_put_contents($filePath, $jsonContent);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
	<br>
	<div style="text-align: center; margin-bottom: 20px;">
		<a href="index.php" style="padding: 10px 20px; background-color: #333; color: white; text-decoration: none; border-radius: 5px;">Go Back</a>
	</div>
</head>
<body>

<div class="container">
    <h2>Edit Product</h2>

    <form action="<?= $_SERVER['PHP_SELF'] ?>?index=<?= $_GET['index'] ?>" method="POST">
        <div>
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div>
            <label for="price">Product Price</label>
            <input type="text" name="price" id="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>

        <div>
            <label for="image">Product Image URL</label>
            <input type="text" name="image" id="image" value="<?= htmlspecialchars($product['image']) ?>" required>
        </div>

        <div>
            <label for="description">Product Description</label>
            <textarea name="description" id="description" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <button type="submit">Save Changes</button>
    </form>
</div>

</body>
</html>
