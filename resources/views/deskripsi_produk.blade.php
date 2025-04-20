<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/deskripsi.css') }}">
  <link rel="icon" href="{{ asset('Assets/logo.png') }}">
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

  {{-- Header --}}
  @include('partials.header')

  {{-- Flash Message --}}
  @if(session('success'))
    <script>alert('{{ session('success') }}');</script>
  @endif

  @if(session('error'))
    <script>alert('{{ session('error') }}');</script>
  @endif

  {{-- Main Content --}}
  <main class="product-container">
    <div class="product-images">
      <div class="main-image">
        <img src="{{ asset('admin/uploads/' . $produk->gambar_produk) }}" alt="Gambar Utama Produk">
      </div>
    </div>

    <div class="product-details">
      <h1>{{ $produk->nama_produk }}</h1>
      <p class="price" id="product-price" data-price="{{ $produk->harga_produk }}">
        Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}
      </p>
      <p class="description">{{ $produk->deskripsi_produk }}</p>
      <p class="stock-availability">Stok Tersedia: {{ $produk->stok_produk }} unit</p>

      <form method="POST" action="">
        @csrf
        <div class="purchase-section">
          <div class="quantity-control">
            <span>Atur jumlah</span>
            <button type="button" onclick="decreaseQuantity()">-</button>
            <input type="number" id="quantity" name="jumlah" value="1" min="1" oninput="updateSubtotal()">
            <button type="button" onclick="increaseQuantity()">+</button>
          </div>
          <p class="subtotal">Subtotal: <span id="subtotal">Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}</span></p>
          <button type="submit" class="add-to-cart">🛒 Masukkan Keranjang</button>
        </div>
      </form>
    </div>
  </main>

  {{-- Footer --}}
  @include('partials.footer')

  <script>
    function increaseQuantity() {
      var quantityInput = document.getElementById('quantity');
      var quantity = parseInt(quantityInput.value) || 0;
      var maxQuantity = {{ $produk->stok_produk }};
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
