<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css','resources/css/bootstrap.min.css'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="icon" href="{{ Vite::asset('resources/images/logo.png') }}">
    <title>Beranda</title>
</head>

<body class="bg-[#f9f9f9] min-h-screen flex flex-col overflow-x-hidden font-[Poppins,sans-serif]">

    <!-- Header -->
    @include ('partials.header')

    <!-- Banner -->
    <section>
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ Vite::asset('resources/images/img1.png') }}" class="absolute block w-auto h-72 rounded-5 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ Vite::asset('resources/images/img2.png') }}" class="absolute block w-auto h-72 rounded-5 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
    </section>

    <!-- Daftar Produk -->
    <section>
        <div class="product flex justify-center flex-wrap gap-[20px] py-[20px]">
            <div class="product-pict flex flex-col items-center justify-center w-[200px] p-[15px] bg-[#7DB6BF] rounded-[10px] shadow-md text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <a href="">
                    <img src="" alt="Produk" class="w-[100px] h-[100px] object-cover mb-[10px]">
                </a>
                <div class="product-info">
                    <h3 class="mb-[10px] text-[18px] text-[#333] font-semibold">Produk</h3>
                    <p class="mb-[15px] text-[16px] text-[#4a4a4a]">Rp ,00-</p>
                    <button class="order-button bg-[#4A0072] hover:bg-[#6A0072] text-white border-none px-[20px] py-[10px] text-[16px] font-bold rounded-3 cursor-pointer transition-all duration-300 shadow-md hover:-translate-y-1">
                        Pesan
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include ('partials.footer')

</body>
</html>
