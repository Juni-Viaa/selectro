<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    @vite(['resources/css/beranda.css', 'resources/css/bootstrap.min.css'])
    <link rel="icon" href="{{ Vite::asset('resources/images/logo.png') }}">
    <title>Beranda</title>
</head>

<body>
    <!-- Header -->
    @include ('partials.header')

    <!-- Banner -->
    <section>
        <div class="banner">
            <div><img src="{{ Vite::asset('resources/images/img1.png') }}" alt="Iklan 1"></div>
            <div><img src="{{ Vite::asset('resources/images/img2.png') }}" alt="Iklan 2"></div>
        </div>
    </section>
    <!-- Daftar Produk -->
    <section>
        <div class="product">
                <div class="product-pict">
                    <a href="">
                        <img src="" alt="Produk">
                    </a>
                    <div class="product-info">
                        <h3>Produk</h3>
                        <p>Rp ,00-</p>
                        <button class="order-button">
                            Pesan
                        </button>
                    </div>
                </div>
        </div>
    </section>

    <!-- Footer -->
    @include ('partials.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".banner").slick({
                dots: true,
                infinite: true, 
                slidesToShow: 1, 
                slidesToScroll: 1, 
                autoplay: true, 
                autoplaySpeed: 2000, 
                arrows: false, 
                fade: true, 
                cssEase: 'linear' 
            });
        });
    </script>
</body>
</html>
