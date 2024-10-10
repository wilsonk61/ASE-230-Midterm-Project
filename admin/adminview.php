<?php
require_once(__DIR__ . '/../functions.php');

$allowedSessionID = 1; 
if (!isset($_SESSION['email']) || $_SESSION['ID'] != $allowedSessionID) {
	die("Access Denied");
}

$filePath = __DIR__.'/../Data/Products.json';
$contactFilePath = __DIR__.'/../Data/contact.json';

$items = json_decode(file_get_contents($filePath), true);
$contacts = json_decode(file_get_contents($contactFilePath), true);

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
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">About Us</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="admincreateproduct.php">Make Your Own Product</a></li>
                	<li class="nav-item"><a class="nav-link active" aria-current="page" href="adminview.php">Admin Product Management Dashboard</a></li>
                </ul>
                <form class="d-flex">
					<a href="../auth/signout.php" class="btn btn-outline-dark">Sign Out</a>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>Manage Items</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $item['name'] ?></td>
                        <td>
                            <a href="adminedit.php?index=<?php echo $index ?>" class="btn btn-warning">Edit</a>
                            <a href="admindelete.php?index=<?php echo $index ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="admincreateproduct.php" class="btn btn-success">Create New Item</a>
    </div>
    <div class="container mt-5">
        <h1>Manage Reviews</h1>
        <?php if (empty($contacts)): ?>
        <p>No messages found.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $index => $contact): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($contact['email']); ?></td>
                            <td><?php echo htmlspecialchars($contact['user_message']); ?></td>
                            <td> 
                            	<a href="contactdelete.php?index=<?php echo $index ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>