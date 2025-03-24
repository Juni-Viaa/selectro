<?php
// Nama File: dashboard.php
// Deskripsi: File ini merupakan file untuk menampilkan dashboard admin yang menampung jumlah produk, jumlah pesanan, total penjualan dan menampilkan pesanan terbaru 
// Dibuat oleh  : Junior Dirgantara Betan - NIM : 3312411002 (HTML, CSS)
//              : Muhammad Ilham Tri adi Putra - NIM : 3312411003 (PHP)
// Tanggal: 21 November 2024

session_start();
// Validasi login dan role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "Anda tidak memiliki akses ke halaman ini!";
    header("Location: ../loginform.php");
    exit();
}

// Koneksi ke database
include '../koneksi.php';

// Query untuk mendapatkan total produk
$total_produk_query = "SELECT COUNT(*) as total_produk FROM produk";
$total_produk_result = mysqli_query($koneksi, $total_produk_query);
$total_produk_data = mysqli_fetch_assoc($total_produk_result);
$total_produk = $total_produk_data['total_produk'];

// Query untuk mendapatkan total pesanan
$total_pesanan_query = "SELECT COUNT(*) as total_pesanan FROM pembelian";
$total_pesanan_result = mysqli_query($koneksi, $total_pesanan_query);
$total_pesanan_data = mysqli_fetch_assoc($total_pesanan_result);
$total_pesanan = $total_pesanan_data['total_pesanan'];

// Query untuk mendapatkan total penjualan berdasarkan status 'completed'
$total_penjualan_query = "SELECT SUM(total_bayar) as total_penjualan FROM pembelian WHERE status_pembelian = 'completed'";
$total_penjualan_result = mysqli_query($koneksi, $total_penjualan_query);
$total_penjualan_data = mysqli_fetch_assoc($total_penjualan_result);
$total_penjualan = $total_penjualan_data['total_penjualan'] ? number_format($total_penjualan_data['total_penjualan'], 0, ',', '.') : 0;

// Query untuk mendapatkan dua pesanan terbaru, termasuk nama pembeli dan alamat
$pesanan_terbaru_query = "
    SELECT p.id_pembelian, p.tanggal_pembelian, p.status_pembelian, p.total_bayar, u.username AS nama_pembeli, u.address AS alamat
    FROM pembelian p
    JOIN users u ON p.id_users = u.id_users
    ORDER BY p.tanggal_pembelian DESC LIMIT 2";
$pesanan_terbaru_result = mysqli_query($koneksi, $pesanan_terbaru_query);
$pesanan_terbaru = mysqli_fetch_all($pesanan_terbaru_result, MYSQLI_ASSOC);
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
    <title>Dashboard - Admin</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="dashboard.php" class="logo">
            <i class="bx bx-code-alt"></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="produk.php"><i class='bx bx-store-alt'></i>Produk</a></li>
            <li><a href="pesanan.php"><i class='bx bx-analyse'></i>Pesanan</a></li>
            <li><a href="laporan.php"><i class='bx bx-message-square-dots'></i>Laporan</a></li>
        </ul>
        <ul class="side-menu">
            <li><a href="../logout.php" class="logout"><i class='bx bx-log-out-circle'></i>Logout</a></li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <main>
            <div class="header">
                <h1>Dashboard Admin</h1>
            </div>

            <!-- Information -->
            <ul class="information">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                        <a href="produk.php">
                            <h3><?php echo $total_produk; ?></h3>
                            <p>Total Produk</p>
                        </a>
                    </span>
                </li>
                <li>
                    <i class='bx bx-line-chart'></i>
                    <span class="info">
                        <a href="pesanan.php">
                            <h3><?php echo $total_pesanan; ?></h3>
                            <p>Total Pesanan</p>
                        </a>
                    </span>
                </li>
                <li>
                    <i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <a href="laporan.php">
                            <h3>IDR <?php echo $total_penjualan; ?></h3>
                            <p>Total Penjualan</p>
                        </a>
                    </span>
                </li>
            </ul>

            <!-- Pesanan Terbaru -->
            <div class="orders">
                <div class="orders-data">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Pesanan Terbaru</h3>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal Pembelian</th>
                                <th>Nama Pembeli</th>
                                <th>Alamat Pembeli</th>
                                <th>Status Pembelian</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($pesanan_terbaru): ?>
                                <?php foreach ($pesanan_terbaru as $pesanan): ?>
                                    <tr>
                                        <td><?php echo $pesanan['id_pembelian']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($pesanan['tanggal_pembelian'])); ?></td>
                                        <td><?php echo $pesanan['nama_pembeli']; ?></td>
                                        <td><?php echo $pesanan['alamat']; ?></td>
                                        <td><?php echo ucfirst($pesanan['status_pembelian']); ?></td>
                                        <td>IDR <?php echo number_format($pesanan['total_bayar'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align: center;">Tidak ada pesanan terbaru.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
