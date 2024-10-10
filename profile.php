<?php 
require_once('functions.php');

if(!isset($_SESSION['email'])) {
    die("Access denied; Sign in");
}

$filePath = 'Data/Products.json'; 
$content = file_get_contents($filePath);
    
$products = json_decode($content, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST) > 0) {
    $contactFilePath = 'Data/contact.json'; 
    $contactContent = file_get_contents($contactFilePath);
    
    $contacts = json_decode($contactContent, true);
    
    $newContact = [
        'email' => $_POST['user_email'],
        'user_message' => $_POST['user_message'],
    ];
    $contactsArray[] = $newContact;
    
    $jsonContent = json_encode($contactsArray, JSON_PRETTY_PRINT);
    
    file_put_contents($contactFilePath, $jsonContent);
}

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User Profile - Shop</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
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
                    <li class="nav-item"><a class="nav-link active" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link active" href="createproduct.php">Make Your Own Product</a></li>
                </ul>
                <form class="d-flex">
                    <a href="auth/signout.php" class="btn btn-outline-dark">Sign Out</a>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder"><?= $_SESSION['email'] ?>'s Profile</h1>
            </div>
        </div>
    </header>

    <!-- User Products Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2>Your Listed Products</h2>
            <?php //echo $_SESSION['email'];
            foreach ($products as $product) {
                if ($product['created_by'] === $_SESSION['email']) { ?>
                	<p><?php echo "Product Name: ", ($product['name'])?>
                	<?php echo "Price: ",($product['price'])?>
                	<?php echo "Description: ",($product['description'])?></p>
            <?php }
            }?>
    	</div>
	</section>
	
	<!-- Contact Section -->
	<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2>Contact Us</h2>
        <form action="profile.php" method="POST">
            <div class="mb-3">
                <label for="user_email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="user_email" name="user_email" required>
            </div>
            <div class="mb-3">
                <label for="user_message" class="form-label">Your Message</label>
                <textarea class="form-control" id="user_message" name="user_message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
