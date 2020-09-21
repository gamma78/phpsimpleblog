<?php
session_start();

require_once 'classes/database.php';

$db = new database('localhost','blog_db','root','');

if (isset($_SESSION['name'])){
    $db->unset_session($_SESSION['name']);
    header("Location:index.php");
}