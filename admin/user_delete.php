<?php
require 'connect.php';

$email = $_GET['email'];

$sql = "delete from user where email = '$email'";

mysqli_query($conn, $sql);
header('Location: user.php');
?>