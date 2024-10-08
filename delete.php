<?php
// Path to your JSON file
$filePath = 'Data/Products.json';

// Read the file
$content = file_get_contents($filePath);

// Convert the JSON string into a PHP array
$products = json_decode($content, true);

// Remove the product at the specified index
$index = $_GET['index']; // Directly get the index from the query string
unset($products[$index]);

// Reindex the array to prevent gaps
$products = array_values($products);

// Encode the array back into JSON
$jsonContent = json_encode($products, JSON_PRETTY_PRINT);

// Save the updated JSON content back to the file
file_put_contents($filePath, $jsonContent);

// Redirect back to the index page after deletion
header('Location: index.php');
exit;