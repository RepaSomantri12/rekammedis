<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pasien = $_POST['nama_pasien'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $penyakit_pasien = $_POST['penyakit_pasien']; // Menambahkan input penyakit


    $sql = "INSERT INTO pasien (nama_pasien, alamat, tanggal_lahir, jenis_kelamin, nomor_telepon, penyakit_pasien)
            VALUES ('$nama_pasien', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$nomor_telepon', '$penyakit_pasien')";


    if ($conn->query($sql) === TRUE) {
        echo "<div class='success-message'>Pasien berhasil ditambahkan. <a href='beranda.php'>Kembali ke beranda pasien</a></div>";
    } else {
        echo "<div class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pasien</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
        }
        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .success-message,
        .error-message {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        a {
            text-decoration: none;
            color: #4CAF50;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Tambah Pasien</h1>

        <form method="POST">
            <label for="nama_pasien">Nama Pasien:</label>
            <input type="text" name="nama_pasien" required placeholder="Masukkan nama pasien">

            <label for="alamat">Alamat:</label>
            <textarea name="alamat" required placeholder="Masukkan alamat pasien"></textarea>

            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>

            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" name="nomor_telepon" required placeholder="Masukkan nomor telepon pasien">

            <label>Penyakit Pasien: </label><input type="text" name="penyakit_pasien"><br>


            <button type="submit">Simpan</button>
        </form>
    </div>

</body>
</html>

<?php
$conn->close();
?>
