
<?php
require_once '../koneksi.php';

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $no_hp = trim($_POST['no_hp'] ?? '');
    $tanggal_daftar = $_POST['tanggal_daftar'] ?? '';

    if ($nama === '' || $alamat === '' || $no_hp === '' || $tanggal_daftar === '') {
        $pesan = 'Semua kolom harus diisi.';
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO anggota (nama, alamat, no_hp, tanggal_daftar)
             VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt, "ssss",
            $nama, $alamat, $no_hp, $tanggal_daftar
        );

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header('Location: index.php');
            exit;
        } else {
            $pesan = 'Gagal menyimpan data anggota.';
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">
</head>
<body class="p-4">
<div class="container">
    <h3>Tambah Anggota</h3>

    <?php if ($pesan !== ''): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($pesan); ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama Anggota</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Daftar</label>
            <input type="date" name="tanggal_daftar" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Anggota</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
