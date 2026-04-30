<?php
    session_start();

    unset($_SESSION['uidrps']);

    header('Location:../index.php');
?>