<?php
session_start();
// Validasi login dan role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    $_SESSION['error'] = "Untuk dapat mengaksesnya, Anda perlu melakukan login!";
    header("Location: loginform.php");
    exit();
}

// Koneksi ke database
include 'koneksi.php';

// Query informasi user
$username = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
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
            <li class="active"><a href="informasi_akun.php"><i class='bx bxs-user'></i>Informasi Akun</a></li>
            <li><a href="riwayat_pembelian.php"><i class='bx bxs-receipt'></i>Riwayat Pembelian</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="logout.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- Akhir of Sidebar -->
    
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
                        <h2>Detail Akun Pengguna</h2>
                    </div>
                    <table class="account-table">
                        <tbody>
                        <?php
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <th>Username</th>
                                <td><?php echo $data['username']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $data['email']; ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon</th>
                                <td><?php echo $data['phone']; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?php echo $data['address']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="account-actions">
                        <button class="edit-profile-btn"><a href="update_akun.php">Edit Profil</a></button>
                        <button class="change-password-btn"><a href="ganti_password.php">Ubah Password</a></button>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer>
            <section>    
                <div class="credit"><a> © Kelompok 2 </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp <a> IF A Malam </a></div>
            </section>
        </footer>
        <!-- Akhir dari Footer -->
    </div>
</body>

</php>