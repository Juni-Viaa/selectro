
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
                            <h3>H2</h3>
                            <p>Total Produk</p>
                        </a>
                    </span>
                </li>
                <li>
                    <i class='bx bx-line-chart'></i>
                    <span class="info">
                        <a href="pesanan.php">
                            <h3>H3</h3>
                            <p>Total Pesanan</p>
                        </a>
                    </span>
                </li>
                <li>
                    <i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <a href="laporan.php">
                            <h3>IDR </h3>
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
                                    <tr>
                                        <td>ID</td>
                                        <td>DATE</td>
                                        <td>NAME</td>
                                        <td>ADDRESS</td>
                                        <td>STATUS</td>
                                        <td>IDR</td>
                                    </tr>
                                <tr>
                                    <td colspan="6" style="text-align: center;">Tidak ada pesanan terbaru.</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
