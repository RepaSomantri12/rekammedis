<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Utama</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #ffffff; /* Warna latar belakang putih */
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      position: relative;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.1); /* Overlay transparan ringan */
      z-index: 1;
    }

    .welcome-container, .options {
      position: relative;
      z-index: 2; /* Konten di atas overlay */
      text-align: center;
      opacity: 0;
      transform: translateY(30px); /* Mulai dengan posisi sedikit lebih rendah */
      animation: fadeInFromTop 1s ease-out forwards; /* Animasi masuk */
    }

    /* Animasi Teks */
    .welcome-text {
      font-size: 2.5rem;
      color: #4CAF50; /* Warna hijau */
      opacity: 0;
      transform: translateY(-20px); /* Posisi awal sedikit di atas */
      animation: fadeInFromTop 1s ease-out forwards;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Bayangan lembut pada teks */
      animation-delay: 0.5s;
    }

    .instructions {
      font-size: 1.2rem;
      color: #4CAF50; /* Warna teks hijau */
      opacity: 0;
      transform: translateY(-20px); /* Posisi awal sedikit di atas */
      animation: fadeInFromTop 1s ease-out forwards;
      animation-delay: 1s;
    }

    /* Efek Zoom + Fade untuk Teks */
    @keyframes fadeInFromTop {
      to {
        opacity: 1;
        transform: translateY(0); /* Bergerak kembali ke posisi normal */
      }
    }

    /* Animasi Tombol */
    .options {
      display: flex;
      gap: 15px;
      margin-top: 20px;
      opacity: 0;
      transform: translateY(30px); /* Tombol dimulai lebih rendah */
      animation: fadeInOptions 1s ease-out forwards;
      animation-delay: 1.5s; /* Tombol muncul setelah teks */
    }

    /* Desain dan Animasi Tombol */
    .button {
      padding: 12px 25px;
      font-size: 1.1rem;
      color: #fff;
      background-color: #4CAF50; /* Warna hijau */
      border: 2px solid transparent; /* Border transparan */
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      text-align: center;
      transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    /* Efek Hover Tombol */
    .button:hover {
      background-color: #45a049; /* Hijau tua saat hover */
      transform: scale(1.1); /* Membesarkan tombol sedikit */
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); /* Bayangan saat hover */
    }

    .button:active {
      background-color: #397d3e; /* Warna hijau lebih tua saat tombol diklik */
      transform: scale(1.05); /* Efek saat tombol diklik */
      box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.2);
    }

    /* Animasi untuk Tombol */
    @keyframes fadeInOptions {
      to {
        opacity: 1;
        transform: translateY(0); /* Tombol bergerak ke posisi normal */
      }
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="welcome-container">
    <h1 class="welcome-text">Selamat datang di Aplikasi Rekam Medis</h1>
    <p class="instructions">Pilih opsi di bawah ini untuk melanjutkan:</p>
  </div>
  <div class="options">
    <a href="daftar.php" class="button">Daftar</a>
    <a href="login.php" class="button">Login</a>
  </div>
</body>
</html>
