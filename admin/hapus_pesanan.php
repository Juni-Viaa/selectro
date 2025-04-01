<?php
// Nama File: hapus_pesanan.php
// Deskripsi: File ini merupakan file untuk mengubah 
// Dibuat oleh : Muhammad Ilham Tri adi Putra - NIM : 3312411003 (PHP)
// Tanggal: 26 Desember 2024

include '../koneksi.php'; // Sambungkan ke database
session_start();

// Validasi jika admin belum login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Mengambil id_pembelian yang dikirim melalui POST
$id_pembelian = $_POST['id_pembelian'];

// Hapus data pesanan dari tabel pembelian
$query = "DELETE FROM pembelian WHERE id_pembelian = '$id_pembelian'";
$result = mysqli_query($koneksi, $query);

// Cek apakah query berhasil
if ($result) {
    // Jika berhasil, arahkan kembali ke halaman pesanan
    header("Location: pesanan.php");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Gagal menghapus pesanan: " . mysqli_error($koneksi);
}
?>
