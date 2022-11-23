<?php

$server = 'localhost';
$user = 'root';
$password = '';
$dbname = 'uas';

$conn = mysqli_connect($server, $user, $password, $dbname);

if (!$conn) {
    echo 'cannot connect to this DB';
}