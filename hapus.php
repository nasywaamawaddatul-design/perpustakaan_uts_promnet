
<?php
require_once '../koneksi.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM anggota WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header('Location: index.php');
    exit;
}

mysqli_stmt_close($stmt);
die("Gagal menghapus data anggota.");
?>
