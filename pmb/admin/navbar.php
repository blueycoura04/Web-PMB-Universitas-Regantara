<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.navbar{
    position: sticky;
    top: 0;
    z-index: 1050;
}
body{
    margin:0;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="/pmb/admin/dashboard.php">
            🎓 ADMIN PMB
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navAdmin">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/pmb/admin/dashboard.php">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/pmb/admin/pendaftar.php">Pendaftar</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/pmb/admin/seleksi.php">Seleksi</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/pmb/admin/pembayaran.php">Pembayaran</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/pmb/admin/laporan.php">Laporan</a>
                </li>

                <li class="nav-item ms-2">
                    <a class="btn btn-warning btn-sm" href="/pmb/auth/logout.php">
                        Logout
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>

<!-- ⚠️ INI WAJIB UNTUK TOGGLER -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>