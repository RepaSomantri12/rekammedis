<?php
header("Location: welcome.php");
exit;


session_start();
include 'db.php'; // Pastikan sudah ada koneksi ke database

// Memastikan koneksi ke database berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Menghitung total pasien
$total_pasien_query = "SELECT COUNT(*) AS total_pasien FROM pasien";
$total_pasien_result = mysqli_query($conn, $total_pasien_query);

// Memastikan query berhasil dijalankan
if ($total_pasien_result) {
    $total_pasien = mysqli_fetch_assoc($total_pasien_result)['total_pasien'];
} else {
    $total_pasien = 0; // Jika query gagal, set ke 0
}

// Menghitung janji hari ini
$today = date('Y-m-d');
$janji_today_query = "SELECT COUNT(*) AS janji_today FROM janji WHERE tanggal = ?";
$janji_today_stmt = mysqli_prepare($conn, $janji_today_query);
if ($janji_today_stmt) {
    mysqli_stmt_bind_param($janji_today_stmt, 's', $today);
    mysqli_stmt_execute($janji_today_stmt);
    $janji_today_result = mysqli_stmt_get_result($janji_today_stmt);

    if ($janji_today_result) {
        $janji_today = mysqli_fetch_assoc($janji_today_result)['janji_today'];
    } else {
        $janji_today = 0; // Jika query gagal, set ke 0
    }
} else {
    $janji_today = 0; // Jika prepare gagal, set ke 0
}

// Menghitung rekam medis baru
$rekamedis_baru_query = "SELECT COUNT(*) AS rekamedis_baru FROM rekam_medis WHERE DATE(created_at) = ?";
$rekamedis_baru_stmt = mysqli_prepare($conn, $rekamedis_baru_query);
if ($rekamedis_baru_stmt) {
    mysqli_stmt_bind_param($rekamedis_baru_stmt, 's', $today);
    mysqli_stmt_execute($rekamedis_baru_stmt);
    $rekamedis_baru_result = mysqli_stmt_get_result($rekamedis_baru_stmt);

    if ($rekamedis_baru_result) {
        $rekamedis_baru = mysqli_fetch_assoc($rekamedis_baru_result)['rekamedis_baru'];
    } else {
        $rekamedis_baru = 0; // Jika query gagal, set ke 0
    }
} else {
    $rekamedis_baru = 0; // Jika prepare gagal, set ke 0
}

// Daftar pasien yang tersedia
$daftar_pasien_query = "SELECT * FROM pasien WHERE status = 'Tersedia' LIMIT 5"; // Menampilkan 5 pasien yang tersedia
$daftar_pasien_result = mysqli_query($conn, $daftar_pasien_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Rekam Medis</title>
    <link rel="stylesheet" href="styles.css"> <!-- Tambahkan CSS untuk styling -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        header h1 {
            margin: 0;
            font-size: 28px;
        }
        .dashboard {
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            max-width: 1200px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .dashboard h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .info-box {
            background-color: #f9f9f9;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .info-box h3 {
            font-size: 18px;
            margin: 0;
            color: #333;
        }
        .info-box p {
            font-size: 20px;
            margin: 5px 0 0;
            color: #4CAF50;
        }
        .info-box ul {
            list-style-type: none;
            padding: 0;
        }
        .info-box ul li {
            padding: 8px;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
            color: #555;
        }
        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        <h1>Selamat datang di Aplikasi Rekam Medis</h1>
    </header>

    <section class="dashboard">
        <h2>Ringkasan Dashboard</h2>
        
        <div class="info-box">
            <h3>Total Pasien</h3>
            <p><?php echo $total_pasien; ?> Pasien Terdaftar</p>
        </div>

        <div class="info-box">
            <h3>Janji Temu Hari Ini</h3>
            <p><?php echo $janji_today; ?> Janji Temu</p>
        </div>

        <div class="info-box">
            <h3>Rekam Medis Baru</h3>
            <p><?php echo $rekamedis_baru; ?> Rekam Medis Baru</p>
        </div>

        <div class="info-box">
            <h3>Daftar Pasien Tersedia</h3>
            <ul>
                <?php 
                if ($daftar_pasien_result) {
                    while ($pasien = mysqli_fetch_assoc($daftar_pasien_result)) { 
                        echo "<li><strong>{$pasien['nama']}</strong> - {$pasien['keluhan']}</li>";
                    }
                } else {
                    echo "<li>Tidak ada pasien yang tersedia.</li>";
                }
                ?>
            </ul>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Aplikasi Rekam Medis</p>
    </footer>

</body>
</html>

<?php
// Menutup koneksi
mysqli_close($conn);
?>
