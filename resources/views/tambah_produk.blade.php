<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="icon" href="{{ asset('Assets/logo.png') }}">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="#" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="active"><a href="#"><i class='bx bx-store-alt'></i>Produk</a></li>
            <li><a href="#"><i class='bx bx-analyse'></i>Pesanan</a></li>
            <li><a href="#"><i class='bx bx-message-square-dots'></i>Laporan</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')">
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
                </div>
            </div>
        </main>
    </div>

</body>
</html>
