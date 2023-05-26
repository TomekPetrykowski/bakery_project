<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if (isset($_GET['search_submit'])) {
        $_SESSION['search_clause'] = $_GET['search'];
        header("Location: ./products.php");
    }
?>