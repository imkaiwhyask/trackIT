<?php
    $db_host= 'db';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'tisamidb';

    $con = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $con -> set_charset("utf8");

    if($con->connect_error) {
        die('Error connecting to database!');
    }
?>