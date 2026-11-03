
<?php
require_once 'koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pesan = '';

if (isset($_POST['daftar'])) {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_prepare(
        $conn,
        "SELECT id FROM users WHERE username = ?"
    );

    mysqli_stmt_bind_param($cek, "s", $username);
    mysqli_stmt_execute($cek);

    $hasil = mysqli_stmt_get_result($cek);

    if (mysqli_num_rows($hasil) > 0) {
        $pesan = "Username sudah digunakan!";
    } else {
        $query = mysqli_prepare(
            $conn,
            "INSERT INTO users (nama, username, password)
             VALUES (?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $query,
            "sss",
            $nama,
            $username,
            $password
        );

        if (mysqli_stmt_execute($query)) {
            header("Location: login.php");
            exit;
        } else {
            $pesan = "Registrasi gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Perpustakaan</title>
</head>
<body>

<h2>Registrasi Akun</h2>

<p><?php echo htmlspecialchars($pesan); ?></p>

<form method="POST">
    <label>Nama Lengkap</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="daftar">Daftar</button>
</form>

<p>Sudah punya akun?
    <a href="login.php">Login</a>
</p>

</body>
</html>
