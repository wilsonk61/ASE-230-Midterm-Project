<?php 
require_once(__DIR__ . '/../functions.php');
if (isset($_SESSION['email'])) {
    die('You are already signed in, please sign out if you want to create a new account.');
}

if (count($_POST) > 0) {
    if (isset($_POST['email'][0]) && isset($_POST['password'][0])) {
    
        $filePath = __DIR__.'/../Data/users.csv.php';
        
        $emailExists = false;
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                $userData = explode(';', $data[0]);
                if ($userData[0] == $_POST['email']) {
                    $emailExists = true;
                    break;
                }
            }
            fclose($handle);
        }
        
        if ($emailExists) {
            $errorMessage = 'This email is already registered. Please try a different email.';
        } else {
            $fp = fopen($filePath, 'a+');
            fputcsv($fp, [$_POST['email'].';'.password_hash($_POST['password'], PASSWORD_DEFAULT)]);
            fclose($fp);
            $successMessage = 'Your account has been created, proceed to sign in page.';
        }
        
    } else {
        $errorMessage = 'Email and password are missing or empty';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sign Up - Shop Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Sign Up</div>
                    <div class="card-body">
                        <form method="POST">
                        <?php if ($errorMessage): ?>
            				<div style="color: red;"><?= htmlspecialchars($errorMessage); ?></div>
        				<?php endif; ?>
        				<?php if ($successMessage): ?>
        					<div style="color: green;"><?= htmlspecialchars($successMessage); ?></div>
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
                            <p>Already have an account? <a href="signin.php">Signin here</a>.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>