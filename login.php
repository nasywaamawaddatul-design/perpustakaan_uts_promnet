
<?php
require_once 'koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pesan = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_prepare(
        $conn,
        "SELECT * FROM users WHERE username = ?"
    );

    mysqli_stmt_bind_param($query, "s", $username);
    mysqli_stmt_execute($query);

    $hasil = mysqli_stmt_get_result($query);
    $user = mysqli_fetch_assoc($hasil);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];

        header("Location: index.php");
        exit;
    } else {
        $pesan = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Perpustakaan</title>
</head>
<body>

<h2>Login Perpustakaan</h2>

<p><?php echo htmlspecialchars($pesan); ?></p>

<form method="POST">
    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

<p>Belum punya akun?
    <a href="registrasi.php">Registrasi</a>
</p>

</body>
</html>
