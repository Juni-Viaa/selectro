{{-- resources/views/loginform.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Registrasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" href="{{ asset('Assets/logo.png') }}">
</head>
<body>
    <div class="container" id="container">
        <!-- Form Daftar -->
        <div class="form-container sign-up">
            <form action="{{ url('register') }}" method="POST">
                <h1>Buat Akun</h1>
                @if(session('success_register'))
                    <p style="color: green;">{{ session('success_register') }}</p>
                @endif
                @if(session('error_register'))
                    <p style="color: red;">{{ session('error_register') }}</p>
                @endif

                <input type="text" name="username" placeholder="Username" required value="{{ session('form_data.username') }}">
                <input type="email" name="email" placeholder="Email" required value="{{ session('form_data.email') }}">
                <input type="password" name="password" placeholder="Password" required value="{{ session('form_data.password') }}">
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required value="{{ session('form_data.confirm_password') }}">
                <input type="text" name="phone" placeholder="Telepon" required value="{{ session('form_data.phone') }}">
                <input type="text" name="address" placeholder="Alamat" required value="{{ session('form_data.address') }}">

                <button type="submit">Registrasi</button>
            </form>
        </div>

        <!-- Form Login -->
        <div class="form-container sign-in">
            <form action="{{ url('login') }}" method="POST">
                <h1>Login</h1>
                @if(session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif
                @if(session('error'))
                    <p style="color: red;">{{ session('error') }}</p>
                @endif

                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>

        <!-- Panel Toggle -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Selamat Datang Kembali</h1>
                    <p>Login untuk dapat menggunakan layanan yang ada pada website</p>
                    <button class="hidden" id="login">Log In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hai, Sobat!</h1>
                    <p>Daftarkan akunmu agar dapat menggunakan layanan yang ada pada website</p>
                    <button class="hidden" id="register">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
