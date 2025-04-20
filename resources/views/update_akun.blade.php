<!-- resources/views/update_akun.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/informasi_akun.css') }}">
    <link rel="icon" href="{{ asset('Assets/logo.png') }}">
    <title>Informasi Akun</title>
</head>
<body>

    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Selectro</span></div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="#"><i class='bx bxs-user'></i>Informasi Akun</a></li>
            <li><a href="#"><i class='bx bxs-receipt'></i>Riwayat Pembelian</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout"><i class='bx bx-log-out-circle'></i>Logout</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <main>
            <div class="header">
                <div class="left">
                    <h1>Informasi Akun</h1>
                </div>
            </div>

            <div class="account-info-container">
                <div class="account-details">
                    <div class="account-header">
                        <h2>Edit Profil</h2>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ url('/update_akun') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $user->username }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                        </div>
                        <div class="account-actions">
                            <button type="submit" class="edit-profile-btn">Update</button>
                            <button class="cancel-btn" style="background-color: lightcoral;"><a href="informasi_akun.php" onclick="return confirm('Perubahan belum disimpan, yakin ingin keluar?')">Batal</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <footer>
            <section>    
                <div class="credit"><a> © Kelompok 2 </a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <a> IF A Malam </a></div>
            </section>
        </footer>
    </div>
</body>
</html>