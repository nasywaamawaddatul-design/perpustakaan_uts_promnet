
<?php
require_once '../koneksi.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];
$pesan = '';

$stmt = mysqli_prepare($conn, "SELECT * FROM anggota WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$anggota = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$anggota) {
    header('Location: index.php');
    exit;
}

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
            "UPDATE anggota
             SET nama = ?, alamat = ?, no_hp = ?, tanggal_daftar = ?
             WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt, "ssssi",
            $nama, $alamat, $no_hp, $tanggal_daftar, $id
        );

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header('Location: index.php');
            exit;
        } else {
            $pesan = 'Gagal mengubah data anggota.';
            mysqli_stmt_close($stmt);
        }
    }

    $anggota['nama'] = $nama;
    $anggota['alamat'] = $alamat;
    $anggota['no_hp'] = $no_hp;
    $anggota['tanggal_daftar'] = $tanggal_daftar;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">
</head>
<body class="p-4">
<div class="container">
    <h3>Edit Anggota</h3>

    <?php if ($pesan !== ''): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($pesan); ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama Anggota</label>
            <input type="text" name="nama" class="form-control"
                   value="<?= htmlspecialchars($anggota['nama']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required><?= htmlspecialchars($anggota['alamat']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" name="no_hp" class="form-control"
                   value="<?= htmlspecialchars($anggota['no_hp']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Daftar</label>
            <input type="date" name="tanggal_daftar" class="form-control"
                   value="<?= htmlspecialchars($anggota['tanggal_daftar']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
