<?php
session_start();
// Validasi login dan role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    $_SESSION['error'] = "Untuk dapat mengaksesnya, Anda perlu melakukan login!";
    header("Location: loginform.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet"  href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/informasi_akun.css">
    <link rel="icon" href="Assets/logo.png">
    <title>Riwayat Pembelian</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="beranda.php" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="informasi_akun.php"><i class='bx bxs-user'></i>Informasi Akun</a></li>
            <li class="active"><a href="riwayat_pembelian.php"><i class='bx bxs-receipt'></i>Riwayat Pembelian</a></li>
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
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <main>
            <div class="header">
                <div class="left">
                    <h1>Riwayat Pembelian</h1>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Produk 1</td>
                        <td>Gambar Produk
                            <!--
                            <div class="center">
                                <img src="images/logo.png" height="50">
                            </div>
                            -->
                        </td>
                        <td>Rp 749.000,00</td>
                        <td>1</td>
                        <td>Rp 749.000,00</td>
                        <td>
                            <a href="" class="btn" style="background-color: lightgreen;"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn" style="background-color: lightcoral;"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>

        <footer>
            <section>    
                <div class="credit"><a> © Kelompok 2 </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp <a> IF A Malam </a></div>
            </section>
        </footer>
    </div>
</body>

</php>