
<?php

// Memulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Memeriksa apakah pengguna sudah login
function sudahLogin() {
    return isset($_SESSION['user_id']);
}

// Membatasi halaman agar hanya bisa dibuka setelah login
function wajibLogin() {
    if (!sudahLogin()) {
        header("Location: login.php");
        exit;
    }
}

// Mengarahkan pengguna ke halaman dashboard
function keDashboard() {
    header("Location: index.php");
    exit;
}
