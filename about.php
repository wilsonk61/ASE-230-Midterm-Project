<?php
require_once('functions.php');
if(!isset($_SESSION['email'])) {
    	die("Access denied; Sign in");
}
?>
<?php 
$aboutContent = file_get_contents('about.txt');
echo $aboutContent;
?>
