<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    @vite(['resources/css/bootstrap.min.css', 'resources/css/admin.css'])
    <link rel="icon" href="{{ Vite::asset('resources/images/logo.png') }}">
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
        <a href="dashboard" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="dashboard"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="produk"><i class='bx bx-store-alt'></i>Produk</a></li>
            <li><a href="pesanan"><i class='bx bx-analyse'></i>Pesanan</a></li>
            <li class="active"><a href="laporan"><i class='bx bx-message-square-dots'></i>Laporan</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="logout" class="logout">
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
                    <option value="laporan?status=all" >Semua Data</option>
                    <option value="laporan?status=completed" >Completed</option>
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
                        <tr>
                            <td>1</td>
                            <td>Junior</td>
                            <td>Bengkong</td> <!-- Menambahkan kolom alamat -->
                            <td>Rp 1.000.000</td>
                            <td>Completed</td>
                            <td>12-08-2024</td>
                        </tr>
                </tbody>
            </table>

            <!-- Menampilkan Total Penjualan jika status "completed" -->
                <div class="total-penjualan">
                    <h3>Total Penjualan: Rp 1.000.000</h3>
                </div>

            <!-- Tombol Ekspor -->
            <div class="export-buttons">
                <a href="export_csv" class="btn btn-success">Export to CSV</a>
            </div>

        </main>
    </div>
</body>

</html>
