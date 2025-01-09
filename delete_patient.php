<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data pasien berdasarkan ID
    $sql = "DELETE FROM pasien WHERE id_pasien = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='container'><p class='message'>Pasien berhasil dihapus. <a href='beranda.php'>Kembali ke daftar pasien</a></p></div>";
    } else {
        echo "<div class='container'><p class='message'>Error: " . $sql . "<br>" . $conn->error . "</p></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        p {
            font-size: 18px;
            color: #555;
        }
        .message {
            font-size: 16px;
            color: #4CAF50;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
 
