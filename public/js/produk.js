// Fungsi untuk meningkatkan jumlah
function increaseQuantity() {
  var quantityInput = document.getElementById('quantity');
  var quantity = parseInt(quantityInput.value);
  quantity++;
  quantityInput.value = quantity;
  updateSubtotal();
}

// Fungsi untuk menurunkan jumlah
function decreaseQuantity() {
  var quantityInput = document.getElementById('quantity');
  var quantity = parseInt(quantityInput.value);
  if (quantity > 1) {
    quantity--;
    quantityInput.value = quantity;
  }
  updateSubtotal();
}

// Fungsi untuk mengupdate subtotal berdasarkan harga produk dan jumlah
function updateSubtotal() {
  var quantityInput = document.getElementById('quantity');
  var quantity = parseInt(quantityInput.value);

  // Pastikan nilai minimal adalah 1
  if (isNaN(quantity) || quantity < 1) {
    quantity = 1;
    quantityInput.value = quantity;
  }

  var price = parseInt(document.getElementById('product-price').getAttribute('data-price')); // Ambil harga dari elemen data-price
  var subtotal = price * quantity;
  document.getElementById('subtotal').innerText = "Rp. " + subtotal.toLocaleString('id-ID');
}
