<?php
require_once('functions.php');

if(!isset($_SESSION['email'])) {
    die("Access denied; Sign in");
}

$filePath = 'Data/Products.json';

$content = file_get_contents($filePath);

$products = json_decode($content, true);

$index = $_GET['index']; 

$product = $products[$index];

if ($product['id'] != $_SESSION['ID']) {
    die("Access Denied: You cannot delete this product.");
}

unset($products[$index]);

$products = array_values($products);

$jsonContent = json_encode($products, JSON_PRETTY_PRINT);

file_put_contents($filePath, $jsonContent);

header('Location: index.php');
exit;
