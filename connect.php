<?php

$server = 'localhost';
$user = 'root';
$password = '';
$name = 'uas';

$conn = mysqli_connect($server, $user, $password, $name);

if (!$conn) {
    echo 'cannot connect to this DB';
}