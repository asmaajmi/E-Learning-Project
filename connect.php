<?php
    session_start();
    if($_SESSION['role'] == 'notExist') {
        header('location:index.php');
    }
?>