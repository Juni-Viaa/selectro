<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/footer.css'])
</head>
<body>
    <footer class="footer">
        <div class="footer-container">
            <div class="customer-service">
                <h3>Hubungi Kami</h3>
                <ul>
                    <li><a href="#"><img src="{{ Vite::asset('resources/images/carbon_map.png') }}" alt="Maps"> Batam</a></li>
                    <li><a href="#"><img src="{{ Vite::asset('resources/images/f7_phone.png') }}" alt="WhatsApp"> 082143003406</a></li>
                    <li><a href="#"><img src="{{ Vite::asset('resources/images/carbon_email.png') }}" alt="Email"> selectro@gmail.com</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>
