<?php
// Nama File: edit_produk.php
// Deskripsi: File ini merupakan file untuk menampilkan dashboard admin yang menampung jumlah produk, jumlah pesanan, total penjualan dan menampilkan pesanan terbaru 
// Dibuat oleh  : Junior Dirgantara Betan - NIM : 3312411002 (HTML, CSS)
//              : Muhammad Ilham Tri adi Putra - NIM : 3312411003 (PHP)
// Tanggal: 21 November 2024

// Koneksi ke database
include '../koneksi.php';

// Ambil data produk berdasarkan id_produk
if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];
    $query = "SELECT * FROM produk WHERE id_produk='$id_produk'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan
    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='produk.php';</script>";
        exit;
    }
}

// Proses update data produk
if (isset($_POST['update'])) {
    $nama_produk = $_POST['nama_produk'];
    $kategori_produk = $_POST['kategori_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok_produk = $_POST['stok_produk'];
    $deskripsi_produk = $_POST['deskripsi_produk'];

    // Tangani upload gambar baru
    if ($_FILES['gambar_produk']['name']) {
        $gambar_produk = $_FILES['gambar_produk']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar_produk);
        move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file);
    } else {
        $gambar_produk = $data['gambar_produk'];
    }

    $query = "UPDATE produk SET 
                nama_produk='$nama_produk',
                kategori_produk='$kategori_produk',
                harga_produk='$harga_produk',
                stok_produk='$stok_produk',
                deskripsi_produk='$deskripsi_produk',
                gambar_produk='$gambar_produk'
              WHERE id_produk='$id_produk'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui data!');</script>";
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
    <title>Edit Produk</title>
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
                    <h1>Edit Produk</h1>
                </div>
            </div>
            <div class="account-info-container">
                <div class="account-details">
                    <table class="account-table">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk:</label>
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_produk" class="form-label">Kategori Produk:</label>
                                <input type="text" class="form-control" id="kategori_produk" name="kategori_produk" value="<?php echo $data['kategori_produk']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_produk" class="form-label">Harga Produk:</label>
                                <input type="number" class="form-control" id="harga_produk" name="harga_produk" value="<?php echo $data['harga_produk']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="stok_produk" class="form-label">Stok Produk:</label>
                                <input type="number" class="form-control" id="stok_produk" name="stok_produk" value="<?php echo $data['stok_produk']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_produk" class="form-label">Deskripsi Produk:</label>
                                <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="4" required><?php echo $data['deskripsi_produk']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar_produk" class="form-label">Gambar Produk:</label>
                                <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" accept="image/*">
                                <div class="mt-2">
                                    <p>Gambar saat ini:</p>
                                    <img src="uploads/<?php echo $data['gambar_produk']; ?>" width="100">
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary w-100" onclick="return confirm('Yakin ingin mengupdate data ini?')">Update</button>
                            <a href="produk.php" class="btn btn-secondary btn-sm w-100">Kembali ke Daftar Produk</a>
                        </form>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>