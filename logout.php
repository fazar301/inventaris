<?php
    session_start();
    session_destroy();
    setcookie('id','');
    setcookie('key','');
    header('location:login.php');
?>