// Ambil elemen yang dibutuhkan
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

// Fungsi untuk menyimpan status tampilan di localStorage
function setFormState(state) {
    localStorage.setItem('formState', state);
}

// Event Listener untuk tombol "Sign Up"
registerBtn.addEventListener('click', () => {
    container.classList.add("active");
    setFormState('register'); // Simpan status "register"
});

// Event Listener untuk tombol "Sign In"
loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
    setFormState('login'); // Simpan status "login"
});

// Memuat status saat halaman di-refresh
document.addEventListener('DOMContentLoaded', () => {
    const formState = localStorage.getItem('formState');
    if (formState === 'register') {
        container.classList.add("active");
    } else {
        container.classList.remove("active");
    }

    // Pemberitahuan otomatis menghilang
    const notifications = document.querySelectorAll('.notification');
    notifications.forEach(notification => {
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('container');
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');

    if (action === 'register') {
        container.classList.add("active");
    }
});
