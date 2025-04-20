

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
                        <tr>
                            <td>ID</td>
                            <td>NAME</td>
                            <td>ADDRESS</td>
                            <td>IDR</td>
                            <td>STATUS</td>
                            <td>DATE</td>
                            <td>

                                    <img src="" alt="Bukti Pembayaran" style="max-width: 100px;">

                            </td>
                            <td>
                                <a href="edit_pesanan.php?id_pembelian=" class="btn primary" style="background-color: #C2D9DD">Update</a>
                            </td>
                        </tr>
                </tbody>
            </table>


            <div class="pagination">
                    <a href="pesanan.php?page=" 
                    class="">
                    </a>
            </div>

        </main>
    </div>

    <script src="index.js"></script>
</body>

</html>