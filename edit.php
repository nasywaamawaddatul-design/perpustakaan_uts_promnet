
<?php
require_once '../koneksi.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit('ID buku tidak valid.');
}

$stmt = mysqli_prepare($conn, "SELECT * FROM buku WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$buku = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$buku) {
    exit('Buku tidak ditemukan.');
}

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $penulis = trim($_POST['penulis'] ?? '');
    $penerbit = trim($_POST['penerbit'] ?? '');
    $tahun = (int) ($_POST['tahun_terbit'] ?? 0);
    $stok = (int) ($_POST['stok'] ?? -1);

    if ($judul === '' || $penulis === '' || $penerbit === '') {
        $pesan = 'Semua kolom harus diisi.';
    } elseif ($tahun < 1901 || $tahun > 2155 || $stok < 0) {
        $pesan = 'Tahun terbit atau stok tidak valid.';
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "UPDATE buku
             SET judul = ?, penulis = ?, penerbit = ?,
                 tahun_terbit = ?, stok = ?
             WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sssiii",
            $judul,
            $penulis,
            $penerbit,
            $tahun,
            $stok,
            $id
        );

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header('Location: index.php');
            exit;
        } else {
            $pesan = 'Gagal memperbarui data buku.';
            mysqli_stmt_close($stmt);
        }
    }

    $buku['judul'] = $judul;
    $buku['penulis'] = $penulis;
    $buku['penerbit'] = $penerbit;
    $buku['tahun_terbit'] = $tahun;
    $buku['stok'] = $stok;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">
</head>
<body class="p-4">
<div class="container">
    <h3>Edit Buku</h3>

    <?php if ($pesan !== ''): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($pesan); ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="judul" class="form-control"
                value="<?= htmlspecialchars($buku['judul']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" name="penulis" class="form-control"
                value="<?= htmlspecialchars($buku['penulis']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="penerbit" class="form-control"
                value="<?= htmlspecialchars($buku['penerbit']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control"
                min="1901" max="2155"
                value="<?= htmlspecialchars((string)$buku['tahun_terbit']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control"
                min="0" value="<?= htmlspecialchars((string)$buku['stok']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
