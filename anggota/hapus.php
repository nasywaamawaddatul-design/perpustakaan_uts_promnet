
<?php
require_once '../koneksi.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

// Ambil nama foto anggota
$stmt = mysqli_prepare($conn, "SELECT foto FROM anggota WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$anggota = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$anggota) {
    header('Location: index.php');
    exit;
}

// Hapus data anggota
$stmt = mysqli_prepare($conn, "DELETE FROM anggota WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);

    // Hapus file foto jika tersedia
    if (!empty($anggota['foto'])) {
        $fileFoto = 'foto/' . $anggota['foto'];

        if (is_file($fileFoto)) {
            unlink($fileFoto);
        }
    }

    header('Location: index.php');
    exit;
}

mysqli_stmt_close($stmt);
die("Gagal menghapus data anggota.");
?>
