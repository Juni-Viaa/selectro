<?php
// Nama File: edit_pesanan.php
// Deskripsi: File ini merupakan file untuk mengubah 
// Dibuat oleh : Muhammad Ilham Tri adi Putra - NIM : 3312411003 (PHP)
// Tanggal: 26 Desember 2024

session_start();
include '../koneksi.php';

// Cek apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginform.php");
    exit();
}

// Pastikan id_pembelian diterima dan valid
if (!isset($_GET['id_pembelian']) || !is_numeric($_GET['id_pembelian'])) {
    echo "ID Pembelian tidak valid.";
    exit;
}

$id_pembelian = $_GET['id_pembelian'];

// Query untuk mendapatkan data pesanan berdasarkan id_pembelian
$query = "
    SELECT p.id_pembelian, u.username, u.address, p.total_bayar, p.status_pembelian, p.tanggal_pembelian, p.bukti_pembayaran
    FROM pembelian p
    JOIN users u ON p.id_users = u.id_users
    WHERE p.id_pembelian = $id_pembelian
    LIMIT 1
";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Pastikan ada data yang ditemukan
if (!$data) {
    echo "Pesanan tidak ditemukan.";
    exit;
}

// Proses update status jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status_pembelian = $_POST['status_pembelian'];

    // Aturan perubahan status
    $current_status = $data['status_pembelian'];

    if ($current_status == 'cancelled' || $current_status == 'completed') {
        // Status cancelled atau completed tidak bisa diubah
        echo "<script>alert('Status $current_status tidak bisa diubah.');</script>";
        echo "<script>window.location.href = window.location.href;</script>"; // Refresh halaman untuk reset form
        exit;
    }

    if ($current_status == 'paid' && !in_array($status_pembelian, ['cancelled', 'on delivery'])) {
        echo "<script>alert('Status Paid hanya bisa diubah menjadi Cancel atau On Delivery.');</script>";
        echo "<script>window.location.href = window.location.href;</script>";
        exit;
    }

    if ($current_status == 'on delivery' && !in_array($status_pembelian, ['completed', 'cancelled'])) {
        echo "<script>alert('Status On Delivery hanya bisa diubah menjadi Completed atau Cancel.');</script>";
        echo "<script>window.location.href = window.location.href;</script>";
        exit;
    }

    // Mulai transaksi
    mysqli_begin_transaction($koneksi);

    try {
        // Update status di tabel pembelian
        $update_pembelian_query = "
            UPDATE pembelian
            SET status_pembelian = ?
            WHERE id_pembelian = ?
        ";
        $stmt = mysqli_prepare($koneksi, $update_pembelian_query);
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . mysqli_error($koneksi));
        }

        mysqli_stmt_bind_param($stmt, 'si', $status_pembelian, $id_pembelian);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            throw new Exception("Gagal memperbarui status pembelian.");
        }

        // Update status di tabel keranjang
        $update_keranjang_query = "
            UPDATE keranjang
            SET status = ?
            WHERE id_pembelian = ?
        ";
        $stmt_keranjang = mysqli_prepare($koneksi, $update_keranjang_query);
        if ($stmt_keranjang === false) {
            throw new Exception("Error preparing statement: " . mysqli_error($koneksi));
        }

        mysqli_stmt_bind_param($stmt_keranjang, 'si', $status_pembelian, $id_pembelian);
        $result_keranjang = mysqli_stmt_execute($stmt_keranjang);

        if (!$result_keranjang) {
            throw new Exception("Gagal memperbarui status di keranjang.");
        }

        // Jika status diubah menjadi cancelled, kembalikan stok produk
        if ($status_pembelian == 'cancelled') {
            $query_produk = "
                SELECT id_produk, jumlah
                FROM keranjang
                WHERE id_pembelian = ?
            ";
            $stmt_produk = mysqli_prepare($koneksi, $query_produk);
            if ($stmt_produk === false) {
                throw new Exception("Error preparing statement: " . mysqli_error($koneksi));
            }

            mysqli_stmt_bind_param($stmt_produk, 'i', $id_pembelian);
            mysqli_stmt_execute($stmt_produk);
            $result_produk = mysqli_stmt_get_result($stmt_produk);

            while ($row = mysqli_fetch_assoc($result_produk)) {
                $id_produk = $row['id_produk'];
                $jumlah = $row['jumlah'];

                $update_stok_query = "
                    UPDATE produk
                    SET stok_produk = stok_produk + ?
                    WHERE id_produk = ?
                ";
                $stmt_stok = mysqli_prepare($koneksi, $update_stok_query);
                if ($stmt_stok === false) {
                    throw new Exception("Error preparing statement: " . mysqli_error($koneksi));
                }

                mysqli_stmt_bind_param($stmt_stok, 'ii', $jumlah, $id_produk);
                $result_stok = mysqli_stmt_execute($stmt_stok);

                if (!$result_stok) {
                    throw new Exception("Gagal mengembalikan stok produk.");
                }
            }
        }

        // Commit transaksi jika semua update berhasil
        mysqli_commit($koneksi);

        // Redirect setelah berhasil update
        echo "<script>alert('Status pembelian berhasil diperbarui.');</script>";
        echo "<script>window.location.href='pesanan.php';</script>";
        exit();
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi error
        mysqli_rollback($koneksi);
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
        echo "<script>window.history.back();</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../Assets/logo.png">
    <title>Edit Pesanan</title>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="dashboard.php" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="produk.php"><i class='bx bx-store-alt'></i>Produk</a></li>
            <li class="active"><a href="pesanan.php"><i class='bx bx-analyse'></i>Pesanan</a></li>
            <li><a href="laporan.php"><i class='bx bx-message-square-dots'></i>Laporan</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="../logout.php" class="logout">
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
                    <h1>Edit Pesanan</h1>
                </div>
            </div>

            <!-- Form untuk update -->
            <div class="form-container">
                <form method="POST" action="edit_pesanan.php?id_pembelian=<?php echo $id_pembelian; ?>">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Pembeli</th>
                            <td><input type="text" id="nama_pembeli" name="nama_pembeli" value="<?php echo htmlspecialchars($data['username']); ?>" disabled></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><textarea id="alamat" name="alamat" disabled><?php echo htmlspecialchars($data['address']); ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Total Bayar</th>
                            <td><input type="text" id="total_bayar" name="total_bayar" value="Rp<?php echo number_format($data['total_bayar'], 2, ',', '.'); ?>" disabled></td>
                        </tr>
                        <tr>
                            <th>Status Pembelian</th>
                            <td>
                                <select id="status_pembelian" name="status_pembelian">
                                    <option value="pending" <?php if ($data['status_pembelian'] == 'pending') echo 'selected'; ?>>Pending</option>
                                    <option value="on delivery" <?php if ($data['status_pembelian'] == 'on delivery') echo 'selected'; ?>>On Delivery</option>
                                    <option value="paid" <?php if ($data['status_pembelian'] == 'paid') echo 'selected'; ?>>Paid</option>
                                    <option value="completed" <?php if ($data['status_pembelian'] == 'completed') echo 'selected'; ?>>Completed</option>
                                    <option value="cancelled" <?php if ($data['status_pembelian'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pembelian</th>
                            <td><input type="text" id="tanggal_pembelian" name="tanggal_pembelian" value="<?php echo htmlspecialchars($data['tanggal_pembelian']); ?>" disabled></td>
                        </tr>
                        <tr>
                            <th>Bukti Pembayaran</th>
                            <td>
                                <?php if ($data['bukti_pembayaran']) { ?>
                                    <img src="uploads/<?php echo $data['bukti_pembayaran']; ?>" alt="Bukti Pembayaran" style="max-width: 100px;">
                                <?php } else { ?>
                                    Tidak ada
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn-submit">Update</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>


