<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db_host = getenv('DB_HOST') ?: 'db';
$db_port = getenv('DB_PORT') ?: '3306';
$db_name = getenv('DB_NAME') ?: 'trackit_db';
$db_user = getenv('DB_USER') ?: 'trackit_user';
$db_pass = getenv('DB_PASS') ?: getenv('MYSQL_PASSWORD') ?: '';

$con = new mysqli($db_host, $db_user, $db_pass, $db_name, (int)$db_port);
$con->set_charset('utf8mb4');

$conn = $con;
?>