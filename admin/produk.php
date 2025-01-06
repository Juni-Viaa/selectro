<?php
// Nama File: produk.php
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

// Proses Hapus Data
if (isset($_GET['hapus'])) {
    $id_produk = $_GET['hapus'];
    $query = "DELETE FROM produk WHERE id_produk='$id_produk'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='produk.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data!');</script>";
    }
}

// Paginate setup
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query untuk mendapatkan data
$query_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM produk");
$total_data = mysqli_fetch_assoc($query_total)['total'];
$total_pages = ceil($total_data / $limit);

// Query dengan limit
$query = mysqli_query($koneksi, "SELECT * FROM produk LIMIT $start, $limit");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../Assets/logo.png">
    <title>Produk</title>
    <style>
    .btn {
        padding: 5px 10px;
        color: white;
        text-decoration: none;
        border-radius: 3px;
        margin: 2px;
    }
    .btn-tambah {
        background-color: #7DB6BF;
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 10px 15px;
        font-size: 16px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f4f4f4;
    }
    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 5px;
    }
    .pagination a {
        padding: 5px 10px;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 3px;
    }
    .pagination a.active {
        background-color: #7DB6BF;
        color: white;
    }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="dashboard.php" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="active"><a href="produk.php"><i class='bx bx-store-alt'></i>Produk</a></li>
            <li><a href="pesanan.php"><i class='bx bx-analyse'></i>Pesanan</a></li>
            <li><a href="laporan.php"><i class='bx bx-message-square-dots'></i>Laporan</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../logout.php" class="logout">
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
            <h1>Produk</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $start + 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_produk']; ?></td>
                            <td><img src="uploads/<?php echo $data['gambar_produk']; ?>" width="50"></td>
                            <td><?php echo $data['kategori_produk']; ?></td>
                            <td><?php echo $data['harga_produk']; ?></td>
                            <td><?php echo $data['stok_produk']; ?></td>
                            <td><?php echo $data['deskripsi_produk']; ?></td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="edit_produk.php?id_produk=<?php echo $data['id_produk']; ?>" class="btn" style="background-color: lightgreen;"><i class="fas fa-edit"></i></a>
                                <!-- Tombol Hapus -->
                                <a href="produk.php?hapus=<?php echo $data['id_produk']; ?>" class="btn btn-danger btn-sm" style="background-color: lightcoral;" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Page Halaman -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <a href="produk.php?page=<?php echo $i; ?>" 
                    class="<?php echo $i == $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                    </a>
                <?php } ?>
            </div>
            <!-- Akhir dari page halaman-->
        </main>
    </div>

    <!-- Tombol Tambah Produk -->
    <a href="tambah_produk.php" class="btn btn-tambah">+ Tambah Produk</a>
</body>
</html>
