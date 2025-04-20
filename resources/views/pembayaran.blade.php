<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/keranjang.css') }}">
    <link rel="icon" href="{{ asset('Assets/logo.png') }}">
    <title>Pembayaran</title>
</head>
<body>

    <!-- Header -->
    @include('partials.header')
    <!-- Akhir dari Header -->

    <main>
        <h1>Pembayaran</h1>
        <div class="container">
            <!-- Produk yang akan dibayar -->
            <div class="product-list">
            <form action="#" method="POST" enctype="multipart/form-data">
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
                        @php
                            $total_harga = 0;
                            // Contoh dummy data, nanti bisa diganti dengan data dari controller
                            $items = [
                                [
                                    'nama_produk' => 'Produk A',
                                    'harga_produk' => 50000,
                                    'jumlah' => 2,
                                    'gambar_produk' => 'produk_a.jpg'
                                ],
                                [
                                    'nama_produk' => 'Produk B',
                                    'harga_produk' => 100000,
                                    'jumlah' => 1,
                                    'gambar_produk' => 'produk_b.jpg'
                                ]
                            ];
                        @endphp
                        @foreach($items as $item)
                            @php
                                $total = $item['harga_produk'] * $item['jumlah'];
                                $total_harga += $total;
                                $gambar_path = public_path('admin/uploads/' . $item['gambar_produk']);
                            @endphp
                            <tr>
                                <td>
                                    @if(file_exists($gambar_path))
                                        <img src="{{ asset('admin/uploads/' . $item['gambar_produk']) }}" alt="{{ $item['nama_produk'] }}" width="100">
                                    @else
                                        <img src="{{ asset('admin/uploads/default.jpg') }}" alt="Gambar tidak tersedia" width="100">
                                    @endif
                                </td>
                                <td>{{ $item['nama_produk'] }}</td>
                                <td>Rp {{ number_format($item['harga_produk'], 0, ',', '.') }}</td>
                                <td>{{ $item['jumlah'] }}</td>
                                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            </div>

            <!-- Ringkasan Pembelian (Samping Kanan) -->
            <div class="checkout-summary">
                <h3>Ringkasan Pembelian</h3>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <p>Total Harga: Rp {{ number_format($total_harga, 0, ',', '.') }}</p>
                    <input type="hidden" name="selected_products" value="1,2">
                    <button type="submit" class="btn btn-primary"><a>Bayar Sekarang</a></button>
                </form>
                <br>
                <a href="#" class="btn btn-secondary">Kembali ke Keranjang</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('partials.footer')
    <!-- Akhir dari Footer -->

</body>
</html>
