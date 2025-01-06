<?php
session_start();
// Validasi login dan role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    $_SESSION['error'] = "Untuk dapat mengaksesnya, Anda perlu melakukan login!";
    header("Location: loginform.php");
    exit();
}
?>

<?php
// Koneksi ke database
include 'koneksi.php';

// Ambil data user berdasarkan username
//$username = $_SESSION['username'];
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan
    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='informasi_akun.php';</script>";
        exit;
    }
}

// Proses update data user
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $query = "UPDATE users SET 
                username='$username',
                email='$email',
                phone='$phone', 
                address='$address' 
              WHERE username='" . $_SESSION['username'] . "'";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Data berhasil diperbarui!'); window.location='informasi_akun.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/informasi_akun.css">
    <link rel="icon" href="Assets/logo.png">
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
                        <h2>Edit Profil</h2>
                    </div>
                    <table class="account-table">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $data['username']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No. Telepon</label>
                                <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $data['phone']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address']; ?>" required>
                            </div>
                            <div class="account-actions">
                                <button type="submit" name="update" class="edit-profile-btn">Update</button>
                                <button class="cancel-btn" style="background-color: lightcoral;"><a href="informasi_akun.php" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')">Batal</a></button>
                            </div>
                        </form>
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
</body>

</php>