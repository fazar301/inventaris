<?php  
    session_start();
    if(!$_SESSION['login']){
        header('location:login.php');
        exit;
    }


    require 'functions/functions.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete = basic_operation("DELETE FROM barang WHERE id = $id");

        $_SESSION['flush'] = "Barang berhasil dihapus!";
        header('location:list_barang.php');
        exit;
    }
?>