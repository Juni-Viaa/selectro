

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
    @include ('partials.header')
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

                
                <div class="cart-item">
                    <img src="admin/uploads" alt="">/
                    <div class="cart-item-details">
                        <h3>Produk</h3>
                        <p class="product-price">Harga: Rp. </p>
                        <p>Status: </p>
                    </div>
                    <div class="quantity-control">
                        <form method="POST" action="keranjang.php">
                            <input type="hidden" name="id_keranjang" value="">
                            <input type="number" class="quantity-input" name="jumlah" value="" min="1" required>
                            <button type="submit" name="update" class="btn-update">Update</button>
                        </form>
                        <form method="POST" action="keranjang.php">
                            <input type="hidden" name="id_keranjang" value="">
                            <button type="submit" name="hapus" class="btn-remove">Hapus</button>
                        </form>
                        <input type="checkbox" name="selected_products[]" value="" >
                    </div>
                </div>
                
                    
                 else {
                    echo "<p>Keranjang Anda kosong.</p>";
                }
            
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
    @include ('partials.footer')
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


