<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="icon" href="{{ Vite::asset('resources/images/logo.png') }}">
    @vite (['resources/css/bootstrap.min.css', 'resources/css/admin.css'])
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
        <a href="dashboard" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="dashboard"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="active"><a href="produk"><i class='bx bx-store-alt'></i>Produk</a></li>
            <li><a href="pesanan"><i class='bx bx-analyse'></i>Pesanan</a></li>
            <li><a href="laporan"><i class='bx bx-message-square-dots'></i>Laporan</a></li>
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
                        <tr>
                            <td>1</td>
                            <td>Produk 1</td>
                            <td><img src="uploads/" width="50" alt="Gambar Produk"></td>
                            <td>Produk</td>
                            <td>1000000</td>
                            <td>6</td>
                            <td>Produk dummy</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="edit_produk?id_produk=" class="btn" style="background-color: lightgreen;"><i class="fas fa-edit"></i></a>
                                <!-- Tombol Hapus -->
                                <a href="produk?hapus=" class="btn btn-danger btn-sm" style="background-color: lightcoral;" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                </tbody>
            </table>

            <!-- Page Halaman -->
            <div class="pagination">
                    <a href="produk.php?page=" 
                    class="">
                    </a>
            </div>
            <!-- Akhir dari page halaman-->
        </main>
    </div>

    <!-- Tombol Tambah Produk -->
    <a href="tambah_produk" class="btn btn-tambah">+ Tambah Produk</a>
</body>
</html>
