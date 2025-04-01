<?php

// Koneksi ke database
include 'koneksi.php'; // Sesuaikan path ke koneksi.php

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
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="hf/header.css">
    <link rel="stylesheet" href="css/beranda.css">
    <link rel="icon" href="Assets/logo.png">
    <title>Selectro</title>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <a href="index.php"><span>Selectro</span></a>
        </div>
        <form action="pencarian.php" method="GET" class="search-form">
            <div class="search-container">
                <div class="search-bar">
                    <input type="text" name="keyword" placeholder="Cari produk..." required>
                    <button type="submit" class="search-button"><i class='bx bx-search'></i></button>
                </div>
            </div>
        </form>
        <div class="header-buttons">
            <button><a href="keranjang.php"><span><i class='bx bxs-cart'></i> Keranjang</span></a></button>
            <button><a href="informasi_akun.php"><span><i class='bx bxs-user'></i> Akun Saya</span></a></button>
        </div>
    </header>
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
    <!-- Akhir dari Daftar Produk -->

    <!-- Footer -->
    <?php include "hf/footer.php"; ?>
    <!-- Footer -->

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
