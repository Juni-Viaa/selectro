<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    @vite(['resources/css/header.css'])
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="beranda"><span>Selectro</span></a>
        </div>
        <form action="pencarian" method="GET" class="search-form">
            <div class="search-container">
                <div class="search-bar">
                    <input type="text" name="keyword" placeholder="Cari produk..." required>
                    <button type="submit" class="search-button"><i class='bx bx-search'></i></button>
                </div>
            </div>
        </form>
        <div class="header-buttons">
            <button><a href="keranjang"><span><i class='bx bxs-cart'></i> Keranjang</span></a></button>
            <button><a href="informasi_akun"><span><i class='bx bxs-user'></i> Akun Saya</span></a></button>
            <button><a href="logout"><span><i class='bx bx-log-out'></i> Logout</span></a></button>
        </div>
    </header>
</body>
</html>