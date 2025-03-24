<?php
// Nama File: laporan.php
// Deskripsi: File ini merupakan file untuk menampilkan dashboard admin yang menampung jumlah produk, jumlah pesanan, total penjualan dan menampilkan pesanan terbaru 
// Dibuat oleh  : Junior Dirgantara Betan - NIM : 3312411002 (HTML, CSS)
//              : Muhammad Ilham Tri adi Putra - NIM : 3312411003 (PHP)
// Tanggal: 21 November 2024
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
    <title>Laporan</title>
    <style>
        /* CSS untuk penampilan Total Penjualan */
        .total-penjualan {
            font-weight: bold;
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }

        .total-penjualan.hidden {
            display: none;
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
            <li><a href="produk.php"><i class='bx bx-store-alt'></i>Produk</a></li>
            <li><a href="pesanan.php"><i class='bx bx-analyse'></i>Pesanan</a></li>
            <li class="active"><a href="laporan.php"><i class='bx bx-message-square-dots'></i>Laporan</a></li>
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
            <div class="header">
                <div class="left">
                    <h1>Laporan</h1>
                </div>
            </div>

            <!-- Pilihan Export -->
            <div class="export-options">
                <label for="status">Pilih Status:</label>
                <select name="status" id="status" onchange="window.location.href=this.value;">
                    <option value="laporan.php?status=all" <?php echo (!isset($_GET['status']) || $_GET['status'] == 'all') ? 'selected' : ''; ?>>Semua Data</option>
                    <option value="laporan.php?status=completed" <?php echo (isset($_GET['status']) && $_GET['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>

            <!-- Tabel Laporan -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Total Pembayaran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Pembelian</th>
                    </tr>
                </thead>
                <tbody id="data-table-body">
                    <?php
                    include "../koneksi.php";

                    // Mendapatkan nilai status dari URL
                    $status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

                    // Query untuk mengambil data berdasarkan status
                    if ($status_filter == 'completed') {
                        $query = mysqli_query($koneksi, "SELECT p.id_pembelian, u.username, u.address, p.total_bayar, p.status_pembelian, p.tanggal_pembelian
                                                         FROM pembelian p
                                                         JOIN users u ON p.id_users = u.id_users
                                                         WHERE p.status_pembelian = 'completed'");
                    } else {
                        // Jika memilih "Semua Data", tampilkan semua status
                        $query = mysqli_query($koneksi, "SELECT p.id_pembelian, u.username, u.address, p.total_bayar, p.status_pembelian, p.tanggal_pembelian
                                                         FROM pembelian p
                                                         JOIN users u ON p.id_users = u.id_users");
                    }

                    $total_penjualan = 0; // Variabel untuk menghitung total penjualan
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                        $total_penjualan += $data['total_bayar']; // Menambahkan total bayar dari setiap transaksi
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['username']; ?></td>
                            <td><?php echo $data['address']; ?></td> <!-- Menambahkan kolom alamat -->
                            <td>Rp<?php echo number_format($data['total_bayar'], 2, ',', '.'); ?></td>
                            <td><?php echo ucfirst($data['status_pembelian']); ?></td>
                            <td><?php echo $data['tanggal_pembelian']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <!-- Menampilkan Total Penjualan jika status "completed" -->
            <?php if ($status_filter == 'completed') { ?>
                <div class="total-penjualan">
                    <h3>Total Penjualan: Rp<?php echo number_format($total_penjualan, 2, ',', '.'); ?></h3>
                </div>
            <?php } ?>

            <!-- Tombol Ekspor -->
            <div class="export-buttons">
                <a href="export_csv.php?status=<?php echo $status_filter; ?>" class="btn btn-success">Export to CSV</a>
            </div>

        </main>
    </div>
</body>

</html>
