<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    @vite (['resources/css/bootstrap.min.css', 'resources/css/pencarian.css'])
    <link rel="icon" href="{{ Vite::asset('resources/images/logo.png') }}">
    <title>Pencarian</title>
</head>
<body>
    <!-- Header -->
    @include ('partials.header')
    <!-- Akhir dari Header -->

    <!-- Sisa kode HTML sebelumnya tetap sama -->
    <div class="container">
        <aside class="sidebar">
            <h3>Filter</h3>
            <form method="GET" action="pencarian">
                <input type="hidden" name="keyword" value="">
                <ul>
                    <li>
                        <input type="radio" name="sort" id="lowestPrice" value="lowestPrice">
                        <label for="lowestPrice">Harga Terendah</label>
                    </li>
                    <li>
                        <input type="radio" name="sort" id="highestPrice" value="highestPrice">
                        <label for="highestPrice">Harga Tertinggi</label>
                    </li>
                </ul>
                <button type="submit">Terapkan Filter</button>
            </form>
        </aside>

        <main class="product">
                    <div class="product-pict">
                        <a href="deskripsi_produk?id_produk=">
                            <img src="admin/uploads/" alt="Gambar Produk">
                        </a>
                        <div class="product-info">
                            <h3>Produk</h3>
                            <p>Rp 1.000.000</p>
                            <button class="order-button" onclick="location.href='deskripsi_produk?id_produk='"> Pesan </button>
                        </div>
                    </div>
                <p>Tidak ada produk yang ditemukan.</p>
        </main>
    </div>

    <!-- Footer -->
    @include ('partials.footer')
    <!-- Akhir dari Footer -->
</body>
</html>