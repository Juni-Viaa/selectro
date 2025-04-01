<?php
session_start();

// Konfigurasi koneksi ke database
$host = 'localhost';
$db   = 'selectro';
$user = 'root';
$pass = '';

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form login
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password wajib diisi!";
        header("Location: loginform.php");
        exit();
    }

    // Query untuk mengambil data pengguna berdasarkan username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Terjadi kesalahan pada query: " . $conn->error);
    }

    // Bind parameter ke query
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password yang diinput dengan password hash di database
        if (password_verify($password, $user['password'])) {
            // Set session jika login berhasil
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Simpan role pengguna di session

            // Tutup koneksi
            $stmt->close();
            $conn->close();

            // Arahkan berdasarkan role
            if ($user['role'] === 'admin') {
                header("Location: admin/dashboard.php"); // Admin diarahkan ke dashboard
            } else {
                header("Location: beranda.php"); // User diarahkan ke beranda
            }
            exit();
        } else {
            $_SESSION['error'] = "Password salah!";
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan!";
    }

    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();

    // Redirect kembali ke form login jika gagal
    header("Location: loginform.php");
    exit();
}
?>
