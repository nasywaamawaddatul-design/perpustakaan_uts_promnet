
<?php

require_once '../koneksi.php';

$cari = trim($_GET['cari'] ?? '');

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM buku
     WHERE judul LIKE ? OR penulis LIKE ?
     ORDER BY id DESC"
);

$kata = "%{$cari}%";
mysqli_stmt_bind_param($stmt, "ss", $kata, $kata);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Buku</title>
    <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">
</head>
<body class="layout-fixed sidebar-expand-lg sidebar-mini">
<div class="app-wrapper">

    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <span class="navbar-brand">Sistem Informasi Perpustakaan</span>
        </div>
    </nav>

    <aside class="app-sidebar bg-dark shadow">
        <div class="sidebar-brand">
            <span class="brand-text text-white">Perpustakaan</span>
        </div>
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link">
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">
                            <p>Data Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../anggota/" class="nav-link">
                            <p>Data Anggota</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <main class="app-main">
        <div class="app-content">
            <div class="container-fluid py-3">
                <h3>Data Buku</h3>
                <p>Daftar buku perpustakaan.</p>
                <a href="tambah.php" class="btn btn-primary mb-3">
                 + Tambah Buku
                </a>
                
<form method="get" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="cari"
            class="form-control"
            placeholder="Cari judul atau penulis buku..."
            value="<?= htmlspecialchars($cari); ?>"
        >
        <button type="submit" class="btn btn-primary">
            Cari
        </button>
        <a href="index.php" class="btn btn-secondary">
            Reset
        </a>
    </div>
</form>

                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php while ($buku = mysqli_fetch_assoc($query)) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($buku['judul']); ?></td>
                                    <td><?= htmlspecialchars($buku['penulis']); ?></td>
                                    <td><?= htmlspecialchars($buku['penerbit']); ?></td>
                                    <td><?= htmlspecialchars($buku['tahun_terbit']); ?></td>
                                    <td><?= htmlspecialchars($buku['stok']); ?></td>
                                   <td>
                                        <a href="edit.php?id=<?= (int)$buku['id']; ?>"
                                          class="btn btn-warning btn-sm">Edit</a>

                                         <a href="hapus.php?id=<?= (int)$buku['id']; ?>"
                                         class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                         Hapus
                                         </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>

</div>
<script src="../adminlte/plugins/jquery/jquery.min.js"></script>
<script src="../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
