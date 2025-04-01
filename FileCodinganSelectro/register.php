<?php
session_start();

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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Simpan data di sesi jika terjadi kesalahan dalam registrasi
    $_SESSION['form_data'] = [
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'confirm_password' => $confirm_password,
        'phone' => $phone,
        'address' => $address
    ];

    if ($password !== $confirm_password) {
        $_SESSION['error_register'] = "Konfirmasi password tidak sesuai!";
        header("Location: loginform.php?action=register");
        exit();
    }

    $check_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error_register'] = "Username atau email sudah terdaftar!";
        $stmt->close();
        $conn->close();
        header("Location: loginform.php?action=register");
        exit();
    }
    $stmt->close();

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $email, $hashed_password, $phone, $address);

    if ($stmt->execute()) {
        $_SESSION['success_register'] = "Registrasi berhasil! Silakan login.";
        unset($_SESSION['form_data']); // Hapus data setelah berhasil
    } else {
        $_SESSION['error_regsiter'] = "Terjadi kesalahan saat registrasi: " . $stmt->error;
        header("Location: loginform.php?action=register");
    }

    $stmt->close();
    $conn->close();
    header("Location: loginform.php");
    exit();
}
?>
