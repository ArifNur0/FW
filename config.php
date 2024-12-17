<?php
$host = 'localhost';
$db = 'reservasi_rumah_makan';
$user = 'root'; // ganti dengan username database Anda
$pass = ''; // ganti dengan password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>