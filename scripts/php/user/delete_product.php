<?php

    session_start();

    require_once '../db_connect.php';
    require_once '../functions.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = null;
    }

    if (!$id) {
        header('Location: ./products_managment.php');
        exit;
    }

    $table_name = 'products';

    $connection -> query("DELETE FROM $table_name WHERE id = '$id'");

    header('Location: ./products_managment.php');

?>