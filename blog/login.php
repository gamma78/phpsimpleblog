<?php
session_start();

require_once 'classes/database.php';

$db = new database('localhost','blog_db','root','');

//if submit btn clicked.
if (isset($_POST['btnsubmit'])){
    if (isset($_POST['username']) && isset($_POST['password'])){
        $db->checkuser($_POST['username'] ,$_POST['password']);
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
    <title>Login</title>

</head>
<body>
<!--main content-->
<div class="container mt-lg-5 mt-sm-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <h1 class="display-2 text-center mt-lg-5">Login</h1>
            <?php
            if (isset($_GET['errorlogin'])){
                echo '<div class="alert alert-danger">
                      error: Invalid Username or Password.
                    </div>';
            }
            ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="exampleInputUser1">Username</label>
                    <input name="username" type="text" class="form-control" id="exampleInputUser1" aria-describedby="username" placeholder="Enter Username">
                    <small id="username" class="form-text text-muted">We'll encryption your account.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
<!--                <div class="form-check">-->
<!--                    <input type="checkbox" class="form-check-input" id="exampleCheck1">-->
<!--                    <label class="form-check-label" for="exampleCheck1">Check me out</label>-->
<!--                </div>-->
                <button type="submit" class="btn btn-outline-primary w-50" name="btnsubmit">Login</button>
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