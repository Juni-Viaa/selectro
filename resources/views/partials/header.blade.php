<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    @vite(['resources/css/header.css'])
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-r from-[#7DB6BF] to-[#C2D9DD]">
        <div class="text-3xl font-bold text-black-600">
            <a href="beranda"><span>Selectro</span></a>
        </div>
        <form action="pencarian" method="GET" class="search-form">
            <div class="flex items-center rounded-5 bg-white">
                <div class="relative flex-grow-1 p-1">
                    <input type="text" name="keyword" placeholder="Cari produk..." required class="w-90 py-1 pl-2 pr-1 text-base focus:outline-none">
                    <button type="submit" class="bg-[#7db6bf] border-none text-white px-3 py-2 rounded-5 absolute right-0 top-0 h-full flex items-center justify-center cursor-pointer "><i class='bx bx-search'></i></button>
                </div>
            </div>
        </form>
        <div class="header-buttons flex items-center">
            <button class="bg-white border-none rounded-5 px-4 py-2 ml-2 font-bold cursor-pointer"><a href="keranjang"><span><i class='bx bxs-cart'></i> Keranjang</span></a></button>
            <button class="bg-white border-none rounded-5 px-4 py-2 ml-2 font-bold cursor-pointer"><a href="informasi_akun"><span><i class='bx bxs-user'></i> Akun Saya</span></a></button>
            <button class="bg-white border-none rounded-5 px-4 py-2 ml-2 font-bold cursor-pointer"><a href="logout"><span><i class='bx bx-log-out'></i> Logout</span></a></button>
        </div>
    </div>
</body>
</html>