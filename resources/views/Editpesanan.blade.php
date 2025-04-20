<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Pesanan</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Optional: Flowbite if needed -->
    <!-- <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script> -->
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <aside class="w-64 bg-gray-800 text-white flex flex-col p-5">
            <div class="flex items-center space-x-2 mb-8">
                <i class='bx bx-code-alt text-2xl'></i>
                <span class="text-xl font-semibold">Selectro</span>
            </div>
            <nav class="flex flex-col space-y-2 text-sm">
                <a href="#" class="hover:bg-gray-700 px-3 py-2 rounded flex items-center">
                    <i class='bx bxs-dashboard mr-2'></i>Dashboard
                </a>
                <a href="#" class="hover:bg-gray-700 px-3 py-2 rounded flex items-center">
                    <i class='bx bx-store-alt mr-2'></i>Produk
                </a>
                <a href="#" class="bg-gray-700 px-3 py-2 rounded flex items-center font-semibold">
                    <i class='bx bx-analyse mr-2'></i>Pesanan
                </a>
                <a href="#" class="hover:bg-gray-700 px-3 py-2 rounded flex items-center">
                    <i class='bx bx-message-square-dots mr-2'></i>Laporan
                </a>
            </nav>
            <div class="mt-auto pt-6 border-t border-gray-700">
                <a href="#" class="flex items-center text-sm hover:bg-gray-700 px-3 py-2 rounded">
                    <i class='bx bx-log-out-circle mr-2'></i>Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10">
            <h1 class="text-3xl font-bold mb-6">Edit Pesanan</h1>

            <form method="POST" action="#">
                <div class="bg-white p-6 rounded shadow space-y-4">

                    <div>
                        <label for="nama_pembeli" class="block text-sm font-medium">Nama Pembeli</label>
                        <input type="text" id="nama_pembeli" name="nama_pembeli" value="" class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-medium">Alamat</label>
                        <textarea id="alamat" name="alamat" disabled class="w-full border border-gray-300 rounded px-3 py-2 mt-1">alamat</textarea>
                    </div>

                    <div>
                        <label for="total_bayar" class="block text-sm font-medium">Total Bayar</label>
                        <input type="text" id="total_bayar" name="total_bayar" value="Rp" disabled class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
                    </div>

                    <div>
                        <label for="status_pembelian" class="block text-sm font-medium">Status Pembelian</label>
                        <select id="status_pembelian" name="status_pembelian" class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
                            <option value="pending">Pending</option>
                            <option value="on delivery">On Delivery</option>
                            <option value="paid">Paid</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_pembelian" class="block text-sm font-medium">Tanggal Pembelian</label>
                        <input type="text" id="tanggal_pembelian" name="tanggal_pembelian" value="" disabled class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Bukti Pembayaran</label>
                        <img src="uploads/" alt="Bukti Pembayaran" class="mt-2 w-32 h-auto border border-gray-300 rounded">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Update</button>
                    </div>
                </div>
            </form>
        </main>
    </div>

</body>

</html>
