<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deskripsi Produk</title>
    <link rel="icon" href="{{ asset('Assets/logo.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tambahkan ini -->
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
  <main class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-2 gap-10">
    <!-- Gambar Produk -->
    <div class="flex justify-center items-center">
      <img class="rounded-lg w-full max-w-md object-cover" src="{{ asset('admin/uploads/' . $produk->gambar_produk) }}" alt="Gambar Utama Produk">
    </div>
  
    <!-- Detail Produk -->
    <div class="flex flex-col justify-between space-y-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800">{{ $produk->nama_produk }}</h1>
        <p class="text-xl font-semibold text-red-600 mt-2" id="product-price" data-price="{{ $produk->harga_produk }}">
          Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}
        </p>
        <p class="mt-4 text-gray-600 leading-relaxed">{{ $produk->deskripsi_produk }}</p>
        <p class="mt-2 text-sm text-gray-500">Stok Tersedia: <span class="font-medium text-gray-700">{{ $produk->stok_produk }}</span> unit</p>
      </div>
  
      <form method="POST" action="" class="mt-6">
        @csrf
        <div class="border-t pt-6 space-y-4">
          <!-- Atur jumlah -->
          <div class="flex items-center gap-4">
            <span class="text-sm text-gray-700">Atur jumlah</span>
            <button type="button" onclick="decreaseQuantity()" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 text-lg font-bold">-</button>
            <input type="number" id="quantity" name="jumlah" value="1" min="1"
              class="w-16 text-center border rounded-md py-1 px-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
              oninput="updateSubtotal()">
            <button type="button" onclick="increaseQuantity()" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 text-lg font-bold">+</button>
          </div>
  
          <!-- Subtotal -->
          <p class="text-md text-gray-700">Subtotal: <span id="subtotal" class="font-semibold">Rp. {{ number_format($produk->harga_produk, 0, ',', '.') }}</span></p>
  
          <!-- Tombol Tambah ke Keranjang -->
          <button type="submit"
            class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-200">
            <i class='bx bx-cart text-xl'></i> Masukkan Keranjang
          </button>
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
