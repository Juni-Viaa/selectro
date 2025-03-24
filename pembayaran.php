<?php
session_start();
require_once('koneksi.php');

// Validasi login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    $_SESSION['error'] = "Silakan login terlebih dahulu.";
    header("Location: loginform.php");
    exit();
}

// Ambil id_user dari session
$username = $_SESSION['username'];
$query_user = "SELECT id_users FROM users WHERE username = '$username'";
$result_user = $koneksi->query($query_user);
$user = $result_user->fetch_assoc();
$id_users = $user['id_users'];

$query_keranjang = "SELECT * FROM keranjang WHERE id_users = '$id_users'";
$result_keranjang = mysqli_query($koneksi, $query_keranjang);

// Validasi apakah ada produk yang dipilih
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_products'])) {
    $selected_products = $_POST['selected_products'];
    $selected_products_str = implode(',', $selected_products);

    // Menyimpan produk yang dipilih ke dalam session
    $_SESSION['selected_products'] = $selected_products; // Menyimpan data produk yang dipilih

    // Ambil data produk yang dipilih
    $query = "SELECT k.id_keranjang, p.nama_produk, p.harga_produk, k.jumlah
              FROM keranjang k
              JOIN produk p ON k.id_produk = p.id_produk
              WHERE k.id_keranjang IN ($selected_products_str) AND k.id_users = $id_users";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    } else {
        $_SESSION['error'] = "Tidak ada produk yang valid untuk diproses.";
        header("Location: keranjang.php");
        exit();
    }
} else {
    header("Location: keranjang.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/keranjang.css">
    <link rel="icon" href="Assets/logo.png">
    <title>Pembayaran</title>
</head>
<body>

    <!-- Header -->
    <?php include "hf/header.php"; ?>
    <!-- Akhir dari Header -->

    <main>
        <h1>Pembayaran</h1>
        <div class="container">
            <!-- Produk yang akan dibayar -->
            <div class="product-list">
            <form action="proses_pembayaran.php" method="POST" enctype="multipart/form-data">
                <table>
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_harga = 0;
                        foreach ($items as $item) {
                            $total = $item['harga_produk'] * $item['jumlah'];
                            $total_harga += $total;
                        ?>
                        <tr>
                            <td>
                                <?php
                                $gambar_path = 'admin/uploads/' . ($produk['gambar_produk'] ?? 'default.jpg');
                                if (file_exists($gambar_path)) {
                                    echo '<img src="' . $gambar_path . '" alt="' . $item['nama_produk'] . '" width="100">';
                                } else {
                                    echo '<img src="admin/uploads/default.jpg" alt="Gambar tidak tersedia" width="100">';
                                }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($item['nama_produk']); ?></td>
                            <td>Rp <?php echo number_format($item['harga_produk'], 0, ',', '.'); ?></td>
                            <td><?php echo (int)$item['jumlah']; ?></td>
                            <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
            </div>

            <!-- Ringkasan Pembelian (Samping Kanan) -->
            <div class="checkout-summary">
                <h3>Ringkasan Pembelian</h3>
                <form action="proses_pembayaran.php" method="POST" enctype="multipart/form-data">
                    <p>Total Harga: Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></p>
                    <input type="hidden" name="selected_products" value="<?php echo htmlspecialchars($selected_products_str); ?>">
                    <button type="submit" class="btn btn-primary"><a>Bayar Sekarang</a></button>
                </form>
                <br>
                <a href="keranjang.php" class="btn btn-secondary">Kembali ke Keranjang</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include "hf/footer.php"; ?>
    <!-- Akhir dari Footer -->

</body>
</html>

<?php
// Menutup koneksi database
$koneksi->close();
?>
