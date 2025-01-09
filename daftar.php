<?php
// Koneksi ke database
$host = "localhost";  // Sesuaikan dengan host database Anda
$dbname = "rekammedis";  // Nama database yang digunakan
$username = "root";  // Username database (sesuaikan dengan kredensial Anda)
$password = "";  // Password database (sesuaikan dengan kredensial Anda)

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $user = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Cek apakah password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        $message = "Password dan konfirmasi password tidak cocok!";
    } else {
        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk menyimpan data ke database
        $sql = "INSERT INTO pengguna (username, email, password) 
                VALUES ('$user', '$email', '$hashed_password')";

        // Eksekusi query dan cek apakah berhasil
        if ($conn->query($sql) === TRUE) {
            $message = "Akun berhasil dibuat!";
            // Kosongkan form setelah berhasil
            $_POST = [];
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Rekam Medis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .input-group {
            position: relative;
            margin-bottom: 15px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            text-align: center;
            padding: 10px;
            border-radius: 4px;
            margin-top: 15px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Akun</h2>

        <?php
        if (isset($message)) {
            echo '<div class="message ';
            echo (strpos($message, "berhasil") !== false) ? 'success' : 'error';
            echo '">' . $message . '</div>';
        }
        ?>

        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>

            <label for="password">Password</label>
            <div class="input-group">
                <input type="password" id="password" name="password" required>
                <i class="fas fa-eye icon" onclick="togglePassword('password', this)"></i>
            </div>

            <label for="confirm_password">Konfirmasi Password</label>
            <div class="input-group">
                <input type="password" id="confirm_password" name="confirm_password" required>
                <i class="fas fa-eye icon" onclick="togglePassword('confirm_password', this)"></i>
            </div>

            <button type="submit">Daftar</button>
        </form>
        <p style="text-align: center;">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>

    <script>
        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                field.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
