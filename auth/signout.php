<?php
require_once(__DIR__ . '/../functions.php');
session_destroy();
header('Location: signin.php');