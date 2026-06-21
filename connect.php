<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";
$basename = "ll_pwa_projekt";

$dbc = mysqli_connect($servername, $username, $password, $basename, 3307)
    or die('Error connecting to MySQL server: ' . mysqli_connect_error());

mysqli_set_charset($dbc, "utf8");
?>