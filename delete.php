<?php

$filePath = 'Data/Products.json';

$content = file_get_contents($filePath);

$products = json_decode($content, true);

$index = $_GET['index']; 
unset($products[$index]);

$products = array_values($products);

$jsonContent = json_encode($products, JSON_PRETTY_PRINT);

file_put_contents($filePath, $jsonContent);

header('Location: index.php');
exit;
