<?php
    // Get the product name from the URL
    if (isset($_GET['name'])) {
        $productName = urldecode($_GET['name']);

        // Load products from JSON file
        $json = file_get_contents('Data/Products.json');
        $products = json_decode($json, true);

        // Find the product with the matching name
        $product = null;
        foreach ($products as $p) {
            if ($p['name'] == $productName) {
                $product = $p;
                break;
            }
        }
    } 
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Item - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles2.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    </ul>
                    <form class="d-flex">
                    </form>
                </div>
            </div>
        </nav>
        <!-- Product section-->
        <section class="py-5">
			<div class="container px-4 px-lg-5 my-5">
				<div class="row gx-4 gx-lg-5 align-items-center">
					<!-- Product Image -->
					<div class="col-md-6">
						<img class="card-img-top mb-5 mb-md-0" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
					</div>
					<!-- Product Details -->
					<div class="col-md-6">
						<div class="small mb-1">SKU: <?php echo isset($product['sku']) ? $product['sku'] : 'N/A'; ?></div>
						<h1 class="display-5 fw-bolder"><?php echo $product['name']; ?></h1>
						<div class="fs-5 mb-5">
							<?php if (isset($product['original_price'])) { ?>
								<span class="text-decoration-line-through"><?php echo $product['original_price']; ?></span>
							<?php } ?>
							<span><?php echo $product['price']; ?></span>
						</div>
						<p class="lead"><?php echo isset($product['description']) ? $product['description'] : 'No description available.'; ?></p>
						<div class="d-flex">
							<input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" style="max-width: 3rem" />
							<button class="btn btn-outline-dark flex-shrink-0" type="button">
								<i class="bi-cart-fill me-1"></i>
								Add to cart
							</button>
						</div>
					</div>
				</div>
			</div>
		</section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts2.js"></script>
    </body>
</html>