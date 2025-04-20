
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/informasi_akun.css">
    <link rel="icon" href="../Assets/logo.png">
    <title>Informasi Akun</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="beranda.php" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="informasi_akun.php" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')"><i class='bx bxs-user'></i>Informasi Akun</a></li>
            <li><a href="riwayat_pembelian.php" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')"><i class='bx bxs-receipt'></i>Riwayat Pembelian</a></li>
        </ul>
        <ul class="side-menu">
            <li>
            <a href="logout.php" class="logout" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')">
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
                    <h1>Informasi Akun</h1>
                </div>
            </div>
            <div class="account-info-container">
                <div class="account-details">
                    <div class="account-header">
                        <h2>Ganti Password</h2>
                    </div>
                    <table class="account-table">
                        <div class="form-container">

                            <div class="alert alert-danger"> </div>


                            <div class="alert alert-success"> </div>


                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Password Lama</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                                <div class="account-actions">
                                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                                    <a href="informasi_akun.php" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </table>
                </div>
            </div>
        </main>

        <footer>
            <section>    
                <div class="credit"><a> © Kelompok 2 </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp <a> IF A Malam </a></div>
            </section>
        </footer>
        
    </div>

    <script src="../js/index.js"></script>
</body>
</html>