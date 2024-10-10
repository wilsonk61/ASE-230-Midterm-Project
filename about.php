<?php
require_once('functions.php');
if(!isset($_SESSION['email'])) {
    	die("Access denied; Sign in");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Item Management</title>
</head>
<body>
<!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="profile.php">Profile</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="createproduct.php">Make Your Own Product</a></li>
                </ul>
                <form class="d-flex">
			<a href="auth/signout.php" class="btn btn-outline-dark">Sign Out</a>
                </form>
            </div>
        </div>
    </nav>
</body>
</html>
