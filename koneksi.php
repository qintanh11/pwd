<?php
$hostname = 'localhost';
$username= 'root';
$pass= '';
$database= 'kasir';
$port= '3306';

$koneksi = new mysqli ($hostname, $username, $pass, $database, $port);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " .  $koneksi->connect_error);
}
?>