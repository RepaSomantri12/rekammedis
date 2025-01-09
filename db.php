<?php
$host = 'localhost'; // Server
$username = 'root';  // Username MySQL
$password = '';      // Password MySQL
$dbname = 'rekammedis'; // Nama database

// Membuat koneksi ke MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
