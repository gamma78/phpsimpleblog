<?php
session_start();
require_once 'classes/database.php';

//if session name is exists.
if (isset($_SESSION['name'])){

    $db = new database('localhost','blog_db','root','');

    //if submit btn clicked.
        if (isset($_POST['subbtn'])){
            if (isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['author'])){
                $db->add_blog($_POST['title'] ,$_POST['desc'] , $_POST['author']);
            }
        }
}else{
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
    <title>Add New Blog</title>
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
                <h1 class="display-4 text-center">Add New Blog</h1>
            </div>
        </div>
        <div class="col-lg-12">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ;?>">
                        <div class="form-group">
                            <label for="exampleInputTitle1">Title</label>
                            <input name="title" type="text" class="form-control" id="exampleInputTitle1" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">please enter your title for this blog.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputdesc1">Description</label>
                            <textarea rows="5" cols="5" name="desc" class="form-control" id="exampleInputdesc1" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputauthor1">Author</label>
                            <input type="text" name="author" class="form-control" id="exampleInputauthor1" placeholder="Author">
                        </div>
                    <button type="submit" name="subbtn" class="btn btn-outline-primary w-100 mt-lg-5 mb-lg-5">Add</button>
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