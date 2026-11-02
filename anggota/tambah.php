
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
    } elseif (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        $pesan = 'Foto anggota wajib diunggah.';
    } else {
        $tmp = $_FILES['foto']['tmp_name'];
        $info = getimagesize($tmp);

        if ($info === false) {
            $pesan = 'File harus berupa gambar.';
        } else {
            $mime = $info['mime'];
            $ekstensi = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp'
            ];

            if (!isset($ekstensi[$mime])) {
                $pesan = 'Format foto harus JPG, PNG, atau WEBP.';
            } else {
                $namaFoto = uniqid('anggota_') . '.' . $ekstensi[$mime];
                $tujuan = 'foto/' . $namaFoto;

                if (move_uploaded_file($tmp, $tujuan)) {
                    $stmt = mysqli_prepare(
                        $conn,
                        "INSERT INTO anggota (nama, alamat, no_hp, tanggal_daftar, foto)
                         VALUES (?, ?, ?, ?, ?)"
                    );

                    mysqli_stmt_bind_param(
                        $stmt, "sssss",
                        $nama, $alamat, $no_hp, $tanggal_daftar, $namaFoto
                    );

                    if (mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_close($stmt);
                        header('Location: index.php');
                        exit;
                    } else {
                        $pesan = 'Gagal menyimpan data anggota.';
                        unlink($tujuan);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    $pesan = 'Gagal mengunggah foto.';
                }
            }
        }
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

    <form method="post" enctype="multipart/form-data">
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
            <label class="form-label">Foto Anggota</label>
             <input type="file" name="foto" class="form-control" accept="image/*" required>
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
