<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

?>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top shadow-sm">

<div class="container">

    <!-- LOGO -->
    <a class="navbar-brand fw-bold" href="/pmb/index.php">
        🎓 PMB Universitas Regantara
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler" type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav ms-auto align-items-lg-center">

        <!-- =========================
             BELUM LOGIN
        ========================== -->

        <?php if(!isset($_SESSION['id_user'])){ ?>

            <li class="nav-item">
                <a class="nav-link" href="/pmb/index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/pmb/index.php#alur">Alur PMB</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/pmb/index.php#jadwal">Jadwal</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/pmb/index.php#fakultas">Fakultas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/pmb/index.php#kontak">Kontak</a>
            </li>

            <li class="nav-item ms-3">
                <a class="btn btn-outline-light px-4" href="/pmb/auth/login.php">
                    Login
                </a>
            </li>

            <li class="nav-item ms-2">
                <a class="btn btn-warning px-4 fw-semibold" href="/pmb/auth/register.php">
                    Daftar
                </a>
            </li>

        <?php } else { ?>

            <!-- DASHBOARD -->
            <li class="nav-item">
                <a class="nav-link" href="/pmb/mahasiswa/dashboard.php">
                    Dashboard
                </a>
            </li>

            <!-- PENDAFTARAN -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown">
                    Pendaftaran
                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="/pmb/mahasiswa/formulir.php">
                            📄 Formulir
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="/pmb/mahasiswa/upload_file.php">
                            📤 Upload Berkas
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="/pmb/mahasiswa/pembayaran.php">
                            💳 Pembayaran
                        </a>
                    </li>

                </ul>
            </li>

            <!-- INFORMASI -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown">
                    Informasi
                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <!-- NEW MENU -->
                    <li>
                        <a class="dropdown-item" href="/pmb/mahasiswa/alur.php">
                            🧭 Alur Pendaftaran
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item" href="/pmb/mahasiswa/pengumuman.php">
                            📣 Pengumuman
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="/pmb/mahasiswa/ospek.php">
                            🎓 OSPEK
                        </a>
                    </li>

                </ul>
            </li>

            <!-- LOGOUT (STANDALONE) -->
            <li class="nav-item ms-lg-3">
                <a class="btn btn-danger px-3 fw-semibold"
                    href="/pmb/auth/logout.php">

                    <i class="bi bi-box-arrow-right"></i>
                    Logout

                </a>
            </li>

        <?php } ?>

        </ul>

    </div>

</div>

</nav>