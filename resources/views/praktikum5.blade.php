<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login & Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-[#7DB6BF] to-[#C2D9DD] font-sans">
 

  <div id="container" class="relative w-[768px] max-w-full min-h-[480px] bg-white rounded-[10px] shadow-lg overflow-hidden transition-all duration-700 ease-in-out">

    <!-- Sign Up Form -->
    <div class="absolute top-0 h-full w-1/2 left-0 flex items-center justify-center px-10 transition-transform duration-700 ease-in-out z-[2]">
      <form action="#" class="bg-white w-full">
        <h1 class="text-2xl font-bold mb-6">Buat Akun</h1>
        <input type="text" placeholder="Name" class="block w-full mb-4 px-4 py-3 bg-gray-100 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
        <input type="email" placeholder="Email" class="block w-full mb-4 px-4 py-3 bg-gray-100 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
        <input type="password" placeholder="Password" class="block w-full mb-6 px-4 py-3 bg-gray-100 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded font-semibold hover:bg-blue-600 transition-colors">Registrasi</button>
      </form>
    </div>

    <!-- Sign In Form -->
    <div class="absolute top-0 h-full w-1/2 left-0 flex items-center justify-center px-10 transition-transform duration-700 ease-in-out z-[1] translate-x-full">
      <form action="#" class="bg-white w-full">
        <h1 class="text-2xl font-bold mb-6">Login</h1>
        <input type="text" placeholder="Username" class="block w-full mb-4 px-4 py-3 bg-gray-100 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
        <input type="password" placeholder="Password" class="block w-full mb-6 px-4 py-3 bg-gray-100 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
        <a href="#" class="text-blue-500 mb-6 inline-block text-sm">Lupa password?</a>
        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded font-semibold hover:bg-blue-600 transition-colors">Login</button>
      </form>
    </div>

    <!-- Overlay -->
    <div class="absolute top-0 left-1/2 w-1/2 h-full overflow-hidden transition-transform duration-700 ease-in-out z-[100] bg-gradient-to-r from-blue-500 to-blue-400 flex items-center justify-center flex-col text-white px-12 text-center">
      <h1 class="text-3xl font-bold mb-4">Selamat Datang Kembali!</h1>
      <p class="mb-6">Login untuk dapat menggunakan layanan yang ada pada website</p>
      <button id="login" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded font-semibold hover:bg-white hover:text-blue-500 transition-colors">LOG IN</button>
    </div>

    <div class="absolute top-0 left-0 w-1/2 h-full overflow-hidden transition-transform duration-700 ease-in-out z-[100] bg-gradient-to-r from-blue-500 to-blue-400 flex items-center justify-center flex-col text-white px-12 text-center translate-x-full">
      <h1 class="text-3xl font-bold mb-4">Halo Sobat!</h1>
      <p class="mb-6">Daftarkan akunmu agar dapat menggunakan layanan yang ada pada website</p>
      <button id="register" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded font-semibold hover:bg-white hover:text-blue-500 transition-colors">Daftar</button>
    </div>

  </div>

  <script>
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
      container.classList.add('active');
      localStorage.setItem('formState', 'register');
    });

    loginBtn.addEventListener('click', () => {
      container.classList.remove('active');
      localStorage.setItem('formState', 'login');
    });

    document.addEventListener('DOMContentLoaded', () => {
      const formState = localStorage.getItem('formState');
      if (formState === 'register') {
        container.classList.add('active');
      } else {
        container.classList.remove('active');
      }
    });

    // Handling transition
    const observer = new MutationObserver(() => {
      const signInForm = container.children[1];
      const signUpForm = container.children[0];
      const overlayLeft = container.children[3];
      const overlayRight = container.children[2];

      if (container.classList.contains('active')) {
        signInForm.classList.add('translate-x-full');
        signUpForm.classList.remove('translate-x-full');
        overlayLeft.classList.add('-translate-x-full');
        overlayRight.classList.remove('translate-x-full');
      } else {
        signInForm.classList.remove('translate-x-full');
        signUpForm.classList.add('translate-x-full');
        overlayLeft.classList.remove('-translate-x-full');
        overlayRight.classList.add('translate-x-full');
      }
    });

    observer.observe(container, { attributes: true });
  </script>

</body>
</html>
