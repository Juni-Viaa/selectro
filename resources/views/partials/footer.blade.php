<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css']) <!-- Hapus footer.css jika sudah tidak dipakai -->
</head>
<body>
    <footer class="bg-gradient-to-r from-[#7DB6BF] to-[#C2D9DD] p-[20px] text-white text-center">
        <div class="max-w-[600px] mx-auto">
            <div class="text-[18px] text-[#333] mb-[15px]">
                <h3 class="text-[18px] text-[#333] mb-[15px]">Hubungi Kami</h3>
                <ul class="list-none p-0">
                    <li class="mb-[10px] flex justify-center items-center gap-[10px]">
                        <img src="{{ Vite::asset('resources/images/carbon_map.png') }}" alt="Maps" class="h-[20px] w-[20px]">
                        <a href="#" class="text-[#333] text-[14px] flex items-center gap-[10px] hover:text-white">
                            Batam
                        </a>
                    </li>
                    <li class="mb-[10px] flex justify-center items-center gap-[10px]">
                        <img src="{{ Vite::asset('resources/images/f7_phone.png') }}" alt="WhatsApp" class="h-[20px] w-[20px]">
                        <a href="#" class="text-[#333] text-[14px] flex items-center gap-[10px] hover:text-white">
                            082143003406
                        </a>
                    </li>
                    <li class="mb-[10px] flex justify-center items-center gap-[10px]">
                        <img src="{{ Vite::asset('resources/images/carbon_email.png') }}" alt="Email" class="h-[20px] w-[20px]">
                        <a href="#" class="text-[#333] text-[14px] flex items-center gap-[10px] hover:text-white">
                            selectro@gmail.com
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
