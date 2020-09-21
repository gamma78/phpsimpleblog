<?php
session_start();
require_once 'classes/database.php';

$blogs = array();
$id = $_GET['id'];

//if session name is exists.
if (isset($_SESSION['name'])){

    $db = new database('localhost','blog_db','root','');
    $blogs = $db->selectBlogbyId($id);

}
else{
    header("Location:login.php");
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
    <title>Edit Blog</title>
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
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
<!--main nav-->

<!--main content-->
<!--main content-->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron mt-lg-4">
                <h1 class="display-4 text-center">Edit Blog</h1>
            </div>
        </div>
        <div class="col-lg-12">
            <form method="post" action="modify.php">
                <?php foreach ($blogs as $blog): ?>
                <div class="form-group">
                    <label for="exampleInputTitle1">Title</label>
                    <input name="title" type="text" value="<?php echo $blog->title ?>"
                           class="form-control" id="exampleInputTitle1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputdesc1">Description</label>
                    <textarea rows="5" cols="5" name="desc" class="form-control" id="exampleInputdesc1" placeholder="Description"><?php echo $blog->description ?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputauthor1">Author</label>
                    <input type="text" name="author" value="<?php echo $blog->author ?>"
                           class="form-control" id="exampleInputauthor1" placeholder="Author">
                </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="edit" value="<?php echo $_GET['edit']; ?>">
                <button type="submit" name="subbtn" class="btn btn-outline-primary w-100 mt-lg-5 mb-lg-5">Edit</button>
                <?php endforeach; ?>
            </form>
        </div>
    </div>
</div>
<!--main content-->


<script src="js/jquery-slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
</body>
</html>