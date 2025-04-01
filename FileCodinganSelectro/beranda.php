<?php
session_start();

// Koneksi ke database
include 'koneksi.php'; // Sesuaikan path ke koneksi.php

// Validasi login dan role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    $_SESSION['error'] = "Anda tidak memiliki akses ke halaman ini!";
    header("Location: loginform.php");
    exit();
}

// Ambil data produk dari database
$query = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/beranda.css">
    <link rel="icon" href="Assets/logo.png">
    <title>Beranda</title>
</head>

<body>
    <!-- Header -->
    <?php include "hf/header.php"; ?>
    <!-- Akhir dari Header -->

    <!-- Banner -->
    <section>
        <div class="banner">
            <div><img src="Assets/img1.png" alt="Iklan 1"></div>
            <div><img src="Assets/img2.png" alt="Iklan 2"></div>
        </div>
    </section>
    <!-- Daftar Produk -->
    <section>
        <div class="product">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="product-pict">
                    <a href="deskripsi_produk.php?id_produk=<?php echo $row['id_produk']; ?>">
                        <img src="admin/uploads/<?php echo $row['gambar_produk']; ?>" alt="<?php echo $row['nama_produk']; ?>">
                    </a>
                    <div class="product-info">
                        <h3><?php echo $row['nama_produk']; ?></h3>
                        <p>Rp <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></p>
                        <button class="order-button" onclick="location.href='deskripsi_produk.php?id_produk=<?php echo  $row['id_produk']; ?>'">
                            Pesan
                        </button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include "hf/footer.php"; ?>
    <!-- Akhir dari Footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".banner").slick({
                dots: true,
                infinite: true, 
                slidesToShow: 1, 
                slidesToScroll: 1, 
                autoplay: true, 
                autoplaySpeed: 2000, 
                arrows: false, 
                fade: true, 
                cssEase: 'linear' 
            });
        });
    </script>
</body>
</html>
