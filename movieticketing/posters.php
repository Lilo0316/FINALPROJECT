<?php
    session_start();
    if(!isset($_COOKIE['uemail']))
    {
        header('location: nlogin.php');
        die();
    }
    ?>

    <?php
    include("navigation.php");
    include("poster.php");
    ?>
    
