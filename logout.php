
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menghapus seluruh data session
session_unset();

// Menghancurkan session
session_destroy();

// Kembali ke halaman login
header("Location: login.php");
exit;
?>
