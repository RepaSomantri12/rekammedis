<?php
session_start(); // Memulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: welcome.php"); // Jika belum login, arahkan ke halaman welcome.php
    exit();
}

include('db.php');

// Query untuk mengambil data pasien
$sql = "SELECT * FROM pasien";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis - Daftar Pasien</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .logout-btn {
            display: inline-block;
            background-color: #ff5722;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            margin-right: 10px;
        }

        .logout-btn:hover {
            background-color: #e64a19;
        }

        .add-patient-btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            margin-right: 10px;
        }

        .add-patient-btn:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
        }

        .action-buttons a {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 10px;
        }

        .action-buttons a:hover {
            background-color: #0056b3;
        }

        .empty-message {
            text-align: center;
            font-size: 18px;
            color: #888;
            padding: 20px;
        }

        .button-container {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Daftar Pasien</h1>

        <table>
            <thead>
                <tr>
                    <th>ID Pasien</th>
                    <th>Nama Pasien</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor Telepon</th>
                    <th>Penyakit Pasien</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_pasien'] . "</td>";
                        echo "<td>" . $row['nama_pasien'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "<td>" . $row['tanggal_lahir'] . "</td>";
                        echo "<td>" . $row['jenis_kelamin'] . "</td>";
                        echo "<td>" . $row['nomor_telepon'] . "</td>";
                        echo "<td>" . $row['penyakit_pasien'] . "</td>";
                        echo "<td class='action-buttons'>
                                <a href='edit_patient.php?id=" . $row['id_pasien'] . "'>Edit</a> |
                                <a href='delete_patient.php?id=" . $row['id_pasien'] . "'>Hapus</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='empty-message'>Tidak ada data pasien</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="button-container">
            <a href="add_patient.php" class="add-patient-btn">Tambah Pasien</a>
            <a href="logout.php" class="logout-btn">Keluar</a>
        </div>
    </div>

</body>
</html>

<?php
$conn->close();
?>
