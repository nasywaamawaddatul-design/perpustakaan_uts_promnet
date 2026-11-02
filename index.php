
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f4f7fc;
            font-family: Arial, sans-serif;
        }

        .app-header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
        }

        .navbar-brand {
            font-weight: bold;
            color: #2563eb;
        }

        .app-sidebar {
            background: linear-gradient(180deg, #172554, #1e40af) !important;
        }

        .sidebar-brand {
            padding: 20px 15px;
            font-size: 20px;
            font-weight: bold;
        }

        .nav-link {
            color: #dbeafe !important;
            border-radius: 8px;
            margin: 4px 10px;
        }

        .nav-link.active,
        .nav-link:hover {
            background: #3b82f6 !important;
            color: white !important;
        }

        .welcome-box {
            background: linear-gradient(120deg, #2563eb, #60a5fa);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
        }

        .welcome-box h2 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .dashboard-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(15, 23, 42, 0.08);
            transition: transform 0.2s;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
        }

        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: white;
            margin-bottom: 18px;
        }

        .book-icon {
            background: #2563eb;
        }

        .member-icon {
            background: #059669;
        }

        .dashboard-card h5 {
            font-weight: bold;
            color: #1e293b;
        }

        .dashboard-card p {
            color: #64748b;
        }

        .dashboard-link {
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
            margin-top: 8px;
        }

        .app-footer {
            background: white;
            color: #64748b;
            border-top: 1px solid #e5e7eb;
            padding: 15px;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-mini">
<div class="app-wrapper">

    <nav class="app-header navbar navbar-expand">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="bi bi-book-half"></i> Perpustakaan
            </span>
            <span class="text-secondary">Sistem Informasi Perpustakaan</span>
        </div>
    </nav>

    <aside class="app-sidebar shadow">
        <div class="sidebar-brand">
            <span class="text-white">
                <i class="bi bi-book-half"></i> Perpustakaan
            </span>
        </div>

        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="buku/" class="nav-link">
                            <i class="nav-icon bi bi-journal-bookmark"></i>
                            <p>Data Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="anggota/" class="nav-link">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Data Anggota</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <main class="app-main">
        <div class="app-content">
            <div class="container-fluid py-4">

                <div class="welcome-box">
                    <h2><i class="bi bi-house-door"></i> Selamat Datang!</h2>
                    <p class="mb-0">
                        Selamat datang di Sistem Informasi Perpustakaan.
                        Kelola data buku dan anggota dengan mudah melalui dashboard ini.
                    </p>
                </div>

                <h4 class="mb-3 font-weight-bold">Menu Utama</h4>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card dashboard-card h-100">
                            <div class="card-body p-4">
                                <div class="icon-box book-icon">
                                    <i class="bi bi-journal-bookmark"></i>
                                </div>
                                <h5>Data Buku</h5>
                                <p>
                                    Lihat dan kelola koleksi buku yang tersedia
                                    di perpustakaan.
                                </p>
                                <a href="buku/" class="dashboard-link text-primary">
                                    Buka Data Buku
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card dashboard-card h-100">
                            <div class="card-body p-4">
                                <div class="icon-box member-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5>Data Anggota</h5>
                                <p>
                                    Lihat dan kelola informasi anggota
                                    perpustakaan.
                                </p>
                                <a href="anggota/" class="dashboard-link text-success">
                                    Buka Data Anggota
                                    <i class="bi bi-arrow-right"></i>
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
        <span class="float-end">Dashboard</span>
    </footer>

</div>

<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
