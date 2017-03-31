<?php
session_start();

if(isset($_SESSION['id'])){
    $_SESSION = array();
}

if(isset($_COOKIE['id']) || isset($_COOKIE['login']) || isset($_COOKIE['name'])){
    
    
    setcookie("id", '', time()-50000);
    setcookie("login", '', time()-50000);
    setcookie("name", '', time()-50000);
    
} else {
    header("Location: index.html");
    exit();
}

session_destroy();

header("Location: index.html");
exit();
?>