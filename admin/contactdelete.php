<?php
require_once(__DIR__ . '/../functions.php');
$allowedSessionID = 1; 
if (!isset($_SESSION['email']) || $_SESSION['ID'] != $allowedSessionID) {
	die("Access Denied");
}

$filePath = __DIR__.'/../Data/contact.json';

$content = file_get_contents($filePath);

$contacts = json_decode($content, true);

$index = $_GET['index']; 

$contact = $contacts[$index];

unset($contacts[$index]);

$contacts = array_values($contacts);

$jsonContent = json_encode($contacts, JSON_PRETTY_PRINT);

file_put_contents($filePath, $jsonContent);

header('Location: adminview.php');
exit;
