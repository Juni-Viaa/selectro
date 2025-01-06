<?php 
// Nama File: pesanan.php
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
    <title>Pesanan</title>
    <style>
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
            <li><a href="produk.php"><i class='bx bx-store-alt'></i>Produk</a></li>
            <li class="active"><a href="pesanan.php"><i class='bx bx-analyse'></i>Pesanan</a></li>
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
            <div class="header">
                <div class="left">
                    <h1>Pesanan</h1>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Status Pembelian</th>
                        <th scope="col">Tanggal Pembelian</th>
                        <th scope="col">Bukti Pembayaran</th>
                        <th scope="col">Aksi</th> <!-- Tombol Update -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../koneksi.php";

                    // Tentukan jumlah data per halaman
                    $limit = 10;

                    // Hitung halaman aktif berdasarkan query string
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    // Query untuk mendapatkan pesanan dengan LIMIT dan OFFSET
                    $query = "
                        SELECT p.id_pembelian, u.username, u.address, p.total_bayar, p.status_pembelian, p.tanggal_pembelian, p.bukti_pembayaran
                        FROM pembelian p
                        JOIN users u ON p.id_users = u.id_users
                        ORDER BY p.tanggal_pembelian DESC
                        LIMIT $limit OFFSET $offset
                    ";
                    $result = mysqli_query($koneksi, $query);
                    $no = $offset + 1;

                    while ($data = mysqli_fetch_assoc($result)) {
                        $buktiPembayaran = $data['bukti_pembayaran'] ? "uploads/" . $data['bukti_pembayaran'] : 'Tidak ada';
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['username']); ?></td>
                            <td><?php echo htmlspecialchars($data['address']); ?></td>
                            <td>Rp<?php echo number_format($data['total_bayar'], 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($data['status_pembelian']); ?></td>
                            <td><?php echo htmlspecialchars($data['tanggal_pembelian']); ?></td>
                            <td>
                                <?php if ($data['bukti_pembayaran']) { ?>
                                    <img src="<?php echo htmlspecialchars($buktiPembayaran); ?>" alt="Bukti Pembayaran" style="max-width: 100px;">
                                <?php } else { ?>
                                    Tidak ada
                                <?php } ?>
                            </td>
                            <td>
                                <a href="edit_pesanan.php?id_pembelian=<?php echo $data['id_pembelian']; ?>" class="btn primary" style="background-color: #C2D9DD">Update</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php
            // Hitung jumlah total data
            $count_query = "SELECT COUNT(*) AS total FROM pembelian";
            $count_result = mysqli_query($koneksi, $count_query);
            $total_data = mysqli_fetch_assoc($count_result)['total'];
            $total_pages = ceil($total_data / $limit);
            ?>

            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <a href="pesanan.php?page=<?php echo $i; ?>" 
                    class="<?php echo $i == $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                    </a>
                <?php } ?>
            </div>

        </main>
    </div>

    <script src="index.js"></script>
</body>

</html>