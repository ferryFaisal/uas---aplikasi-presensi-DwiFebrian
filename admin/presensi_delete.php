<?php
require 'connect.php';

$id = $_GET['id'];

$sql = "delete from presensi where id = '$id'";

mysqli_query($conn, $sql);
header('Location: presensi.php');
?>