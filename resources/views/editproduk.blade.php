<?php
session_start();
include 'koneksi.php'; // Pastikan path koneksi.php sesuai

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
  $_SESSION['error'] = "Anda harus login terlebih dahulu!";
  header("Location: loginform.php"); // Arahkan ke halaman login
  exit();
}

// Ambil username dari sesi
$username = $_SESSION['username'];

// Ambil id_users berdasarkan username menggunakan prepared statement
$query_user = $koneksi->prepare("SELECT id_users FROM users WHERE username = ?");
$query_user->bind_param("s", $username);
$query_user->execute();
$result_user = $query_user->get_result();

if ($result_user && $result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
    $id_users = $user_data['id_users'];
} else {
    die("Pengguna tidak ditemukan.");
}

// Pastikan id produk ada dalam URL
if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // Ambil data produk berdasarkan ID menggunakan prepared statement
    $query = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
    $query->bind_param("i", $id_produk); // "i" untuk integer
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        $produk = $result->fetch_assoc();
        $stok_produk = $produk['stok_produk']; // Ambil stok produk
    } else {
        die("Produk tidak ditemukan.");
    }
} else {
    die("ID produk tidak ditemukan.");
}

// Tangani form submit untuk menambahkan ke keranjang
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jumlah = intval($_POST['jumlah']);

    if ($jumlah > 0) {
        // Cek apakah jumlah yang diminta melebihi stok yang tersedia
        if ($jumlah > $stok_produk) {
            echo "<script>alert('Stok produk tidak cukup!');</script>";
        } else {
            // Cek apakah produk sudah ada di keranjang menggunakan prepared statement
            $cek_query = $koneksi->prepare("SELECT * FROM keranjang WHERE id_users = ? AND id_produk = ?");
            $cek_query->bind_param("ii", $id_users, $id_produk);
            $cek_query->execute();
            $cek_result = $cek_query->get_result();

            if ($cek_result && $cek_result->num_rows > 0) {
                // Update jumlah jika produk sudah ada di keranjang
                $update_query = $koneksi->prepare("UPDATE keranjang SET jumlah = jumlah + ? WHERE id_users = ? AND id_produk = ?");
                $update_query->bind_param("iii", $jumlah, $id_users, $id_produk);
                $update_query->execute();
            } else {
                // Tambahkan produk ke keranjang dengan status 'pending'
                $insert_query = $koneksi->prepare("INSERT INTO keranjang (id_produk, id_users, jumlah, status) VALUES (?, ?, ?, 'pending')");
                $insert_query->bind_param("iii", $id_produk, $id_users, $jumlah);
                $insert_query->execute();
            }
            echo "<script>alert('Produk berhasil ditambahkan ke keranjang!'); window.location.href = 'deskripsi_produk.php?id_produk=$id_produk';</script>";
        }
    } else {
        echo "<script>alert('Jumlah produk harus lebih dari 0!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"  href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
  <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/deskripsi.css') }}">
  <link rel="icon" href="Assets/logo.png">
  <title>Deskripsi Produk</title>
  <style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
    }
  </style>
</head>
<body>
  <!-- Header -->
  <?php include "hf/header.php"; ?>
  <!-- Akhir dari Header -->

  <!-- Main Content -->
  <main class="product-container">
    <!-- Product Images -->
    <div class="product-images">
      <div class="main-image">
        <img src="admin/uploads/<?php echo $produk['gambar_produk']; ?>" alt="Gambar Utama Produk">
      </div>
    </div>
    
    <!-- Product Details -->
    <div class="product-details">
      <h1><?php echo $produk['nama_produk']; ?></h1>
      <p class="price" id="product-price" data-price="<?php echo $produk['harga_produk']; ?>">
        Rp. <?php echo number_format($produk['harga_produk'], 0, ',', '.'); ?>
      </p>
      <p class="description"><?php echo $produk['deskripsi_produk']; ?></p>
      
      <!-- Display stok produk yang tersedia -->
      <p class="stock-availability">Stok Tersedia: <?php echo $stok_produk; ?> unit</p>
      
      <form method="POST" action="">
        <div class="purchase-section">
          <div class="quantity-control">
            <span>Atur jumlah</span>
            <button type="button" onclick="decreaseQuantity()">-</button>
            <input type="number" id="quantity" name="jumlah" value="1" min="1" oninput="updateSubtotal()">
            <button type="button" onclick="increaseQuantity()">+</button>
          </div>
          <p class="subtotal">Subtotal: <span id="subtotal">Rp. <?php echo number_format($produk['harga_produk'], 0, ',', '.'); ?></span></p>
          <button type="submit" class="add-to-cart">🛒 Masukkan Keranjang</button>
        </div>
      </form>
    </div>
  </main>

  <!-- FOOTER -->
  <?php include "hf/footer.php"; ?>
  <!-- Akhir dari Footer -->

  <script>
    function increaseQuantity() {
      var quantityInput = document.getElementById('quantity');
      var quantity = parseInt(quantityInput.value) || 0;
      var maxQuantity = <?php echo $produk['stok_produk']; ?>; // Menambahkan stok produk dari PHP ke JS
      if (quantity < maxQuantity) {
        quantity++;
        quantityInput.value = quantity;
        updateSubtotal();
      } else {
        alert("Stok produk tidak cukup!");
      }
    }

    function decreaseQuantity() {
      var quantityInput = document.getElementById('quantity');
      var quantity = parseInt(quantityInput.value) || 0;
      if (quantity > 1) {
        quantity--;
        quantityInput.value = quantity;
        updateSubtotal();
      }
    }

    function updateSubtotal() {
      var quantityInput = document.getElementById('quantity');
      var quantity = parseInt(quantityInput.value) || 0;
      var price = parseInt(document.getElementById('product-price').getAttribute('data-price'));
      var subtotal = price * quantity;
      document.getElementById('subtotal').innerText = "Rp. " + subtotal.toLocaleString('id-ID');
    }
  </script>
</body>
</html>
