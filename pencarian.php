<?php
session_start();
include 'koneksi.php';

// Inisialisasi variabel
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

// Query dasar
$query = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'";

// Filter berdasarkan harga
if ($sort === 'lowestPrice') {
    $query .= " ORDER BY harga_produk ASC";
} elseif ($sort === 'highestPrice') {
    $query .= " ORDER BY harga_produk DESC";
} 

$result = mysqli_query($koneksi, $query);
if (!$result) {
    die("Error: " . mysqli_error($koneksi));
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/pencarian.css">
    <link rel="icon" href="Assets/logo.png">
    <title>Pencarian</title>
</head>
<body>
    <!-- Header -->
    <?php include "hf/header.php"; ?>
    <!-- Akhir dari Header -->

    <!-- Sisa kode HTML sebelumnya tetap sama -->
    <div class="container">
        <aside class="sidebar">
            <h3>Filter</h3>
            <form method="GET" action="pencarian.php">
                <input type="hidden" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>">
                <ul>
                    <li>
                        <input type="radio" name="sort" id="lowestPrice" value="lowestPrice" <?php echo $sort == 'lowestPrice' ? 'checked' : ''; ?>>
                        <label for="lowestPrice">Harga Terendah</label>
                    </li>
                    <li>
                        <input type="radio" name="sort" id="highestPrice" value="highestPrice" <?php echo $sort == 'highestPrice' ? 'checked' : ''; ?>>
                        <label for="highestPrice">Harga Tertinggi</label>
                    </li>
                </ul>
                <button type="submit">Terapkan Filter</button>
            </form>
        </aside>

        <main class="product">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="product-pict">
                        <a href="deskripsi_produk.php?id_produk=<?php echo $row['id_produk']; ?>">
                            <img src="admin/uploads/<?php echo $row['gambar_produk']; ?>" alt="<?php echo $row['nama_produk']; ?>">
                        </a>
                        <div class="product-info">
                            <h3><?php echo $row['nama_produk']; ?></h3>
                            <p>Rp <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></p>
                            <button class="order-button" onclick="location.href='deskripsi_produk.php?id_produk=<?php echo $row['id_produk']; ?>'">
                                Pesan
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Tidak ada produk yang ditemukan.</p>
            <?php endif; ?>
        </main>
    </div>

    <!-- Footer -->
    <?php include "hf/footer.php"; ?>
    <!-- Akhir dari Footer -->
</body>
</html>