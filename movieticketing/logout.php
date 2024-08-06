<?php
    session_start();
    setcookie('uemail',$_SESSION['uemail'],60);
    unset($_SESSION['uemail']);
    header('location: nlogin.php');
    die();
?>