<?php
session_start();
require_once('koneksi.php');

// Validasi login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    $_SESSION['error'] = "Silakan login terlebih dahulu.";
    header("Location: loginform.php");
    exit();
}

// Ambil id_user
$username = $_SESSION['username'];
$query_user = "SELECT id_users FROM users WHERE username = '$username'";
$result_user = $koneksi->query($query_user);
$user = $result_user->fetch_assoc();
$id_users = $user['id_users'];

// Validasi file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_products'])) {
    // Pastikan selected_products adalah array
    $selected_products = $_POST['selected_products'];
    if (!is_array($selected_products)) {
        $selected_products = explode(',', $selected_products); // Jika string, ubah menjadi array
    }
    $selected_products_str = implode(',', $selected_products);

    $query_pembelian = "INSERT INTO pembelian (id_users, total_bayar, status_pembelian) 
                        VALUES ($id_users, 
                                (SELECT SUM(p.harga_produk * k.jumlah) 
                                 FROM keranjang k 
                                 JOIN produk p ON k.id_produk = p.id_produk 
                                 WHERE k.id_keranjang IN ($selected_products_str)), 
                                'paid')";
    if ($koneksi->query($query_pembelian)) {
        $id_pembelian = $koneksi->insert_id;  // Ambil id_pembelian yang baru saja disimpan

        // Update status dan id_pembelian di keranjang
        $update_keranjang = "UPDATE keranjang 
                             SET id_pembelian = $id_pembelian, status = 'paid' 
                             WHERE id_keranjang IN ($selected_products_str) AND id_users = $id_users";
        if ($koneksi->query($update_keranjang)) {
            // Mengurangi stok produk setelah pembayaran
            $query_stok = "SELECT k.id_produk, k.jumlah 
                           FROM keranjang k 
                           WHERE k.id_keranjang IN ($selected_products_str) AND k.id_users = $id_users";
            $result_stok = $koneksi->query($query_stok);

            while ($row = $result_stok->fetch_assoc()) {
                $id_produk = $row['id_produk'];
                $jumlah = $row['jumlah'];

                // Kurangi stok produk
                $query_update_stok = "UPDATE produk 
                                      SET stok_produk = stok_produk - $jumlah 
                                      WHERE id_produk = $id_produk";
                $koneksi->query($query_update_stok);
            }

            // Redirect ke halaman konfirmasi setelah proses berhasil
            header("Location: konfirmasi_selesai.php");
            exit();
        } else {
            die("Gagal mengupdate keranjang: " . $koneksi->error);
        }
    } else {
        die("Gagal menyimpan pembelian: " . $koneksi->error);
    }
} else {
    die("Gagal menampilkan produk.");
}
?>
