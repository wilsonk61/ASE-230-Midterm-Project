<?php
require_once(__DIR__ . '/../functions.php');
$allowedSessionID = 1;
if (!isset($_SESSION['email']) || $_SESSION['ID'] != $allowedSessionID) {
	die("Access Denied");
}

$filePath = __DIR__.'/../Data/Products.json';

$content = file_get_contents($filePath);

$products = json_decode($content, true);

$index = $_GET['index']; 

$product = $products[$index];

unset($products[$index]);

$products = array_values($products);

$jsonContent = json_encode($products, JSON_PRETTY_PRINT);

file_put_contents($filePath, $jsonContent);

header('Location: adminview.php');
exit;
