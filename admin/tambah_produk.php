<?php
// Nama File: tambah_produk.php
// Deskripsi: File ini merupakan file untuk menampilkan dashboard admin yang menampung jumlah produk, jumlah pesanan, total penjualan dan menampilkan pesanan terbaru 
// Dibuat oleh  : Junior Dirgantara Betan - NIM : 3312411002 (HTML, CSS)
//              : Muhammad Ilham Tri adi Putra - NIM : 3312411003 (PHP)
// Tanggal: 21 November 2024

session_start();
// Validasi login dan role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "Untuk dapat mengaksesnya, Anda perlu melakukan login!";
    header("Location: ../loginform.php");
    exit();
}

// Koneksi ke database
include '../koneksi.php';

// Proses penyimpanan data saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap data dari form
    $nama_produk = $_POST['nama_produk'];
    $kategori_produk = $_POST['kategori_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok_produk = $_POST['stok_produk'];
    $deskripsi_produk = $_POST['deskripsi_produk'];

    // Tangani upload gambar
    $gambar_produk = $_FILES['gambar_produk']['name'];
    $target_dir = "uploads/"; // Folder untuk menyimpan gambar
    $target_file = $target_dir . basename($gambar_produk);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file gambar
    if ($_FILES['gambar_produk']['size'] > 0) {
        $check = getimagesize($_FILES['gambar_produk']['tmp_name']);
        if ($check === false) {
            echo "<script>alert('File bukan gambar!');</script>";
            $uploadOk = 0;
        }

        // Batasi jenis file gambar
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "<script>alert('Hanya file JPG, JPEG, PNG & GIF yang diizinkan!');</script>";
            $uploadOk = 0;
        }

        // Cek apakah upload berhasil
        if ($uploadOk == 1 && move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file)) {
            $query = "INSERT INTO produk (nama_produk, kategori_produk, harga_produk, stok_produk, deskripsi_produk, gambar_produk) 
                      VALUES ('$nama_produk', '$kategori_produk', '$harga_produk', '$stok_produk', '$deskripsi_produk', '$gambar_produk')";

            if (mysqli_query($koneksi, $query)) {
                echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href = 'produk.php';</script>";
            } else {
                echo "<script>alert('Gagal menambahkan produk: " . mysqli_error($koneksi) . "');</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar!');</script>";
        }
    } else {
        echo "<script>alert('Silakan pilih gambar untuk produk!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../Assets/logo.png">
    <title>Tambah Produk</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="dashboard.php" class="logo" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="dashboard.php" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="active"><a href="produk.php" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')"><i class='bx bx-store-alt'></i>Produk</a></li>
            <li><a href="pesanan.php" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')"><i class='bx bx-analyse'></i>Pesanan</a></li>
            <li><a href="laporan.php" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')"><i class='bx bx-message-square-dots'></i>Laporan</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../logout.php" class="logout" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <main>
            <div class="header">
                <div class="left">
                    <h1>Tambah Produk</h1>
                </div>
            </div>
            <div class="account-info-container">
                <div class="account-details">
                    <table class="account-table">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk:</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_produk" class="form-label">Kategori Produk:</label>
                                <input type="text" class="form-control" id="kategori_produk" name="kategori_produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_produk" class="form-label">Harga Produk:</label>
                                <input type="number" class="form-control" id="harga_produk" name="harga_produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="stok_produk" class="form-label">Stok Produk:</label>
                                <input type="number" class="form-control" id="stok_produk" name="stok_produk" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_produk" class="form-label">Deskripsi Produk:</label>
                                <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar_produk" class="form-label">Gambar Produk:</label>
                                <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </form>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>