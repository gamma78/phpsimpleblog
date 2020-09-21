<?php
require_once 'classes/database.php';

$db = new database('localhost','blog_db','root','');

//if submit btn clicked.

if (isset($_POST['edit'])){
    if (isset($_POST['subbtn'])){
        $id = $_POST['id'];
        if (isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['author'])){
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $author =  $_POST['author'];
            $db->updateBlogbyId($id , $title , $desc ,$author);

        }
    }
}elseif (isset($_GET['delete'] , $_GET['id'])){
    $id = $_GET['id'];
    $db->deleteBlogbyId($id);
}
