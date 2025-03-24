<?php
session_start();
include "koneksi.php";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "Anda harus login terlebih dahulu!";
    header("Location: loginform.php"); 
    exit();
}

$username = $_SESSION['username'];
$query_user = "SELECT id_users FROM users WHERE username = '$username'";
$result_user = mysqli_query($koneksi, $query_user);
if ($result_user && mysqli_num_rows($result_user) > 0) {
    $user_data = mysqli_fetch_assoc($result_user);
    $id_users = $user_data['id_users'];
} else {
    die("Pengguna tidak ditemukan.");
}

// Ambil data keranjang pengguna
$query_keranjang = "SELECT * FROM keranjang WHERE id_users = '$id_users'";
$result_keranjang = mysqli_query($koneksi, $query_keranjang);

// Proses update jumlah atau hapus produk dari keranjang
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $id_keranjang = $_POST['id_keranjang'];
        $jumlah = intval($_POST['jumlah']);

        // Ambil ID produk dan stok produk
        $query_keranjang_item = "SELECT k.jumlah, p.stok_produk FROM keranjang k JOIN produk p ON k.id_produk = p.id_produk WHERE k.id_keranjang = '$id_keranjang' AND k.id_users = '$id_users'";
        $result_keranjang_item = mysqli_query($koneksi, $query_keranjang_item);
        $keranjang_item = mysqli_fetch_assoc($result_keranjang_item);

        $jumlah_sebelumnya = $keranjang_item['jumlah'];
        $stok_produk = $keranjang_item['stok_produk'];

        // Cek apakah jumlah yang diminta melebihi stok yang tersedia
        if ($jumlah > $stok_produk) {
            echo "<script>alert('Stok produk tidak cukup!');</script>";
        } else {
            // Jika jumlah valid dan berbeda dengan yang sebelumnya, update jumlah
            if ($jumlah != $jumlah_sebelumnya) {
                $update_query = "UPDATE keranjang SET jumlah = '$jumlah' WHERE id_keranjang = '$id_keranjang' AND id_users = '$id_users'";
                mysqli_query($koneksi, $update_query);
                echo "<script>
                        alert('Jumlah produk berhasil diperbarui!');
                        window.location.href = 'keranjang.php';
                      </script>";
            } else {
                echo "<script>alert('Tidak ada perubahan jumlah produk.');</script>";
            }
        }
    } elseif (isset($_POST['hapus'])) {
        $id_keranjang = $_POST['id_keranjang'];
        
        // Tampilkan konfirmasi penghapusan
        echo "<script>
                if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                    window.location.href = 'keranjang.php?hapus_id=' + '$id_keranjang';
                }
              </script>";
    } if (isset($_POST['checkout'])) {
      // Ambil produk yang dipilih
        if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
          $selected_products = explode(',', $_POST['selected_products']); // Pisahkan ID produk

          // Validasi produk yang dipilih
            $valid_products = [];
            foreach ($selected_products as $id_keranjang) {
                $query_validasi = "SELECT k.*, p.stok_produk 
                                   FROM keranjang k 
                                   JOIN produk p ON k.id_produk = p.id_produk 
                                   WHERE k.id_keranjang = '$id_keranjang' 
                                   AND k.id_users = '$id_users'";
                $result_validasi = mysqli_query($koneksi, $query_validasi);
                if ($result_validasi && mysqli_num_rows($result_validasi) > 0) {
                    $item = mysqli_fetch_assoc($result_validasi);
                    if ($item['jumlah'] <= $item['stok_produk']) {
                        $valid_products[] = $item;
                    }
                }
            }

            if (!empty($valid_products)) {
              // Simpan produk yang valid dalam sesi
                $_SESSION['selected_products'] = $valid_products;

              // Redirect ke halaman checkout
                header("Location: pembayaran.php");
                exit();
            } else {
                echo "<script>alert('Produk tidak valid untuk checkout!');</script>";
            }
        } else {
            echo "<script>alert('Pilih produk untuk checkout!');</script>";
        }
    }
        // Simpan produk yang dipilih dalam session
        if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
            $_SESSION['selected_products'] = $_POST['selected_products'];
            header("Location: pembayaran.php"); 
            exit();
        } else {
            echo "<script>alert('Pilih produk untuk checkout!');</script>";
        }
    } elseif (isset($_POST['select_all'])) {
        // Centang semua produk
        header("Location: keranjang.php?select_all=1");
        exit();
    }

// Proses penghapusan produk jika id diterima melalui URL
if (isset($_GET['hapus_id'])) {
    $id_keranjang = $_GET['hapus_id'];
    $delete_query = "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang' AND id_users = '$id_users'";
    mysqli_query($koneksi, $delete_query);
    echo "<script>
            alert('Produk berhasil dihapus!');
            window.location.href = 'keranjang.php';
          </script>";
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
    <title>Keranjang</title>
</head>
<body>

    <!-- Header -->
    <?php include "hf/header.php"; ?>
    <!-- Akhir dari Header -->

    <main>
        <h1>Keranjang</h1>
        <div class="container">
            <!-- Daftar Produk -->
            <div class="product-list">
                <h2>Daftar Produk</h2>
                <form id="checkout-form" action="pembayaran.php" method="POST">
                <!-- Tombol Pilih Semua di atas daftar produk -->
                <div class="select-all-container">
                    <button type="submit" name="select_all" class="btn">Pilih Semua</button>
                </div>

                <?php
                if ($result_keranjang && mysqli_num_rows($result_keranjang) > 0) {
                    while ($keranjang_item = mysqli_fetch_assoc($result_keranjang)) {
                        $id_produk = $keranjang_item['id_produk'];
                        $jumlah = $keranjang_item['jumlah'];
                        $status = $keranjang_item['status'];

                        $query_produk = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
                        $result_produk = mysqli_query($koneksi, $query_produk);
                        $produk = mysqli_fetch_assoc($result_produk);
                ?>
                <div class="cart-item">
                    <img src="admin/uploads/<?php echo $produk['gambar_produk']; ?>" alt="<?php echo $produk['nama_produk']; ?>">
                    <div class="cart-item-details">
                        <h3><?php echo $produk['nama_produk']; ?></h3>
                        <p class="product-price">Harga: Rp. <?php echo number_format($produk['harga_produk'], 0, ',', '.'); ?></p>
                        <p>Status: <?php echo ucfirst($status); ?></p>
                    </div>
                    <div class="quantity-control">
                        <form method="POST" action="keranjang.php">
                            <input type="hidden" name="id_keranjang" value="<?php echo $keranjang_item['id_keranjang']; ?>">
                            <input type="number" class="quantity-input" name="jumlah" value="<?php echo $jumlah; ?>" min="1" required>
                            <button type="submit" name="update" class="btn-update">Update</button>
                        </form>
                        <form method="POST" action="keranjang.php">
                            <input type="hidden" name="id_keranjang" value="<?php echo $keranjang_item['id_keranjang']; ?>">
                            <button type="submit" name="hapus" class="btn-remove">Hapus</button>
                        </form>
                        <input type="checkbox" name="selected_products[]" value="<?php echo $keranjang_item['id_keranjang']; ?>" <?php echo (isset($_GET['select_all']) ? 'checked' : ''); ?>>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "<p>Keranjang Anda kosong.</p>";
                }
                ?>
                </form>
            </div>

            <!-- Ringkasan Pembelian (Samping Kanan) -->
            <div class="checkout-summary">
                <h3>Ringkasan Pembelian</h3>
                <form id="checkout-form" action="keranjang.php" method="POST">
                    <p>Total Harga: Rp. <span id="total-price">0</span></p>
                    <input type="hidden" name="selected_products" id="selected-products-input">
                    <button type="submit" name="checkout" class="btn">Lanjutkan Pembayaran</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include "hf/footer.php"; ?>
    <!-- Akhir dari Footer -->

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0Q6HeMXS7fF9vYgf3GpFkYeqpLg2w2jU9DfxO2HpD5Al8KX0" crossorigin="anonymous"></script>

    <!-- JavaScript untuk update harga total -->
    <script>
        function updateTotalPrice() {
            let total = 0;
            const selectedProducts = document.querySelectorAll('input[name="selected_products[]"]:checked');

        selectedProducts.forEach(function(checkbox) {
            const productRow = checkbox.closest('.cart-item');
            const priceText = productRow.querySelector('.product-price').innerText.replace('Harga: Rp. ', '').replace('.', '').trim();
            const price = parseInt(priceText); // Mengambil harga sebagai angka
            const quantity = parseInt(productRow.querySelector('.quantity-input').value); // Mengambil jumlah produk

            if (!isNaN(price) && !isNaN(quantity)) {
                total += price * quantity; // Tambahkan harga * jumlah ke total
            }
        });

        document.getElementById('total-price').innerText = total.toLocaleString('id-ID'); // Format total dalam format mata uang Indonesia
        }

        document.addEventListener('DOMContentLoaded', function() {
            const checkoutButton = document.querySelector('button[type="submit"][name="checkout"]');
            const checkboxes = document.querySelectorAll('input[name="selected_products[]"]');

            checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', updateTotalPrice);
        });

      const quantityInputs = document.querySelectorAll('input[name="jumlah"]');
      quantityInputs.forEach(function(input) {
          input.addEventListener('input', updateTotalPrice);
      });

      // Panggil updateTotalPrice sekali saat halaman dimuat untuk menampilkan total awal
      updateTotalPrice();

      checkoutButton.addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah pengiriman form secara langsung

        // Mengumpulkan produk yang dipilih
        const selectedProducts = [];
        const selectedCheckboxes = document.querySelectorAll('input[name="selected_products[]"]:checked');
        selectedCheckboxes.forEach(function(checkbox) {
            selectedProducts.push(checkbox.value); // Tambahkan ID produk ke array
        });

        // Cek apakah ada produk yang dipilih
        if (selectedProducts.length === 0) {
            alert("Pilih produk untuk checkout!");
            return;
        }

        function updateCheckoutButtonState() {
    const selectedProducts = document.querySelectorAll('input[name="selected_products[]"]:checked');
    const checkoutButton = document.querySelector('button[type="submit"][name="checkout"]');
    checkoutButton.disabled = selectedProducts.length === 0;
}

document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="selected_products[]"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', updateCheckoutButtonState);
    });

    // Update tombol saat halaman dimuat
    updateCheckoutButtonState();
});

        // Set nilai input hidden dengan ID produk yang dipilih
        document.getElementById('selected-products-input').value = selectedProducts.join(',');

        // Kirim form
        document.getElementById('checkout-form').submit();
      });
    });
  </script>
</body>
</html>

<?php
// Menutup koneksi database
$koneksi->close();
?>
