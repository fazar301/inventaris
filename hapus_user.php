<?php  
    session_start();
    if(!$_SESSION['login']){
        header('location:login.php');
        exit;
    }
    if($_SESSION['role'] != 'admin'){
        header('location:index.php');
        exit;
    };


    require 'functions/functions.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete = basic_operation("DELETE FROM user WHERE id = $id");

        $_SESSION['flush'] = "User berhasil dihapus!";
        header('location:list_user.php');
        exit;
    }
?>