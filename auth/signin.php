<?php
require_once(__DIR__ . '/../functions.php');
if(isset($_SESSION['email'])) die('You are already sign in, no need to sign in.');
$showForm=true;
if(count($_POST)>0){
	if(isset($_POST['email'][0]) && isset($_POST['password'][0])){
		$filePath = __DIR__.'/../Data/users.csv.php';
		$index=0;
		$fp=fopen($filePath,'r');
		while(!feof($fp)){
			$line=fgets($fp);
			if(strstr($line,'<?php die() ?>') || strlen($line)<5) continue;
			$index++;
			$line=explode(';',trim($line));
			if($line[0]==$_POST['email'] && password_verify($_POST['password'],$line[1])){
				$_SESSION['email']=$_POST['email'];
				$_SESSION['ID']=$index;
				if ($_SESSION['ID'] == 1) {
					header('Location: ../admin/index.php');
				} else {
					header('Location: ../index.php');
				}
			}
		}
		fclose($fp);
		if($showForm) $errorMessage = 'Your credentials are wrong';
	} else $errorMessage = 'Email and password are missing';
}
if($showForm){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login - Shop Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="POST">
                         <?php if ($errorMessage): ?>
            				<div style="color: red;"><?= htmlspecialchars($errorMessage); ?></div>
        				<?php endif; ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>    
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                            </div>
                        	<p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php } ?>