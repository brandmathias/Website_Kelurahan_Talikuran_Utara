<?php
// config/config.php

$host = "localhost:3308";
$user = "root"; // default user XAMPP
$pass = "";     // kosongkan jika default
$db   = "talikuran_utara"; // nama database

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
