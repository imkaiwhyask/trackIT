<?php
    $db_host= 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'totaldb';

    $con_total = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $con_total -> set_charset("utf8");

    if($con_total->connect_error) {
        die('Error connecting to database!');
    }
?>