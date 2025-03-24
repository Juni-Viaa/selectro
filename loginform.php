<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="Assets/logo.png">
    <title>Daftar | Registrasi</title>
</head>

<body>
    <div class="container" id="container">
        <!-- Form Daftar -->
        <div class="form-container sign-up">
            <form action="register.php" method="POST">
                <h1>Buat Akun</h1>
                <?php
                if (isset($_SESSION['success_register'])) {
                    echo "<p style='color: green;'>" . htmlspecialchars($_SESSION['success_register']) . "</p>";
                    unset($_SESSION['success_register']);
                }
                if (isset($_SESSION['error_register'])) {
                    echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['error_register']) . "</p>";
                    unset($_SESSION['error_register']);
                }
                ?>
                <input type="text" name="username" placeholder="Username" required value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>">
                <input type="email" name="email" placeholder="Email" required value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>">
                <input type="password" name="password" placeholder="Password" required value="<?php echo isset($_SESSION['form_data']['password']) ? htmlspecialchars($_SESSION['form_data']['password']) : ''; ?>"> 
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required value="<?php echo isset($_SESSION['form_data']['confirm_password']) ? htmlspecialchars($_SESSION['form_data']['confirm_password']) : ''; ?>">
                <input type="text" name="phone" placeholder="Telepon" required value="<?php echo isset($_SESSION['form_data']['phone']) ? htmlspecialchars($_SESSION['form_data']['phone']) : ''; ?>">
                <input type="text" name="address" placeholder="Alamat" required value="<?php echo isset($_SESSION['form_data']['address']) ? htmlspecialchars($_SESSION['form_data']['address']) : ''; ?>">

                <button type="submit">Registrasi</button>
            </form>
        </div>

        <!-- Form Login -->
        <div class="form-container sign-in">
            <form action="login.php" method="POST">
                <h1>Login</h1>
                <?php
                if (isset($_SESSION['success'])) {
                    echo "<p style='color: green;'>" . htmlspecialchars($_SESSION['success']) . "</p>";
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['error'])) {
                    echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
                    unset($_SESSION['error']);
                }
                ?>
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

    <script src="js/login.js"></script>
</body>

</html>