
<?php
require_once 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Perpustakaan</title>

    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
</head>
<body class="layout-fixed sidebar-expand-lg sidebar-mini">
<div class="app-wrapper">

    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <span class="navbar-brand">Perpustakaan</span>
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
                        <a href="index.php" class="nav-link active">
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="buku/" class="nav-link">
                            <p>Data Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="anggota/" class="nav-link">
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
                <h3>Dashboard</h3>
                <p>Selamat datang di Sistem Informasi Perpustakaan.</p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-bg-primary">
                            <div class="card-body">
                                <h5>Data Buku</h5>
                                <p>Kelola data buku perpustakaan.</p>
                                <a href="buku/" class="text-white">
                                    Buka Data Buku
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-bg-success">
                            <div class="card-body">
                                <h5>Data Anggota</h5>
                                <p>Kelola data anggota perpustakaan.</p>
                                <a href="anggota/" class="text-white">
                                    Buka Data Anggota
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="app-footer">
        <strong>Sistem Informasi Perpustakaan</strong>
    </footer>

</div>

<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
