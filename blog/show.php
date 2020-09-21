<?php

session_start();

require_once 'classes/database.php';

$db = new database('localhost','blog_db','root','');

$blogs = array();

if ($_SESSION['name']){
    if (isset($_GET['id'])){
        $blogs = $db->selectBlogbyId($_GET['id']);
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

<!--main nav-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="new.php">New</a>
            </li>

            <?php if (isset($_SESSION['name'])):  ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            <?php endif;?>

        </ul>

    </div>
</nav>

<!--main content-->
<div class="container mt-lg-4">
    <div class="row">
        <?php foreach($blogs as $blog) : ?>
            <div class="col-lg-12 mb-lg-3 text-center">
                <div class="card-deck">
                    <div class="card" style="width: 18rem;">
                        <!--                            <img class="card-img-top" src="..." alt="Card image cap">-->
                        <div class="card-body bg-info text-white">
                            <h5 class="card-title"><?php echo $blog->title ?></h5>
                            <p class="card-text"><?php echo $blog->description ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-success">created at : <?php echo $blog->created_at ?></li>
                            <li class="list-group-item bg-warning">updated at : <?php echo $blog->updated_at ?></li>
                            <li class="list-group-item bg-secondary text-white">author : <?php echo $blog->author ?></li>
                        </ul>
                        <div class="card-body bg-primary">

                            <a href="edit.php?id=<?php echo $blog->id; ?>?edit" class="text-white card-link">Edit</a>

                            <a href="modify.php?id=<?php echo $blog->id; ?>&delete" class="text-white card-link">Delete</a>
                            <a href="index.php" class="text-white card-link">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="js/jquery-slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>