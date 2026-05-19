<?php
include 'template/header.php';
include 'template/navbar.php';
?>

<style>

.hero{
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color:white;
    padding:80px 0;
}

.card-custom{
    border:none;
    border-radius:16px;
    box-shadow:0 6px 20px rgba(0,0,0,0.08);
    transition:0.3s;
}

.card-custom:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

section{
    padding:40px 0;
}

</style>

<!-- HERO -->
<section class="hero">

    <div class="container text-center">

        <h1 class="display-5 fw-bold">
            Penerimaan Mahasiswa Baru
        </h1>

        <p class="lead mt-3">
            Sistem Pendaftaran Online Universitas - Terintegrasi, Cepat, dan Transparan
        </p>

        <a href="auth/register.php" class="btn btn-light btn-lg mt-3 px-4">
            Daftar Sekarang
        </a>

    </div>

</section>

<!-- ALUR PMB -->
<section class="container">

    <div class="text-center mb-5">

        <h2 class="fw-bold">Alur Pendaftaran PMB</h2>

        <p class="text-muted">
            Ikuti tahapan seleksi penerimaan mahasiswa baru
        </p>

    </div>

    <div class="row g-4">

        <div class="col-md-3">

            <div class="card card-custom p-4 text-center h-100">

                <i class="bi bi-pencil-square fs-1 text-primary"></i>

                <h5 class="mt-3 fw-semibold">Pendaftaran Online</h5>

                <p class="text-muted">
                    Mengisi formulir pendaftaran secara online melalui sistem PMB.
                </p>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-custom p-4 text-center h-100">

                <i class="bi bi-file-earmark-check fs-1 text-success"></i>

                <h5 class="mt-3 fw-semibold">Verifikasi Berkas</h5>

                <p class="text-muted">
                    Panitia melakukan pemeriksaan dokumen dan data pendaftar.
                </p>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-custom p-4 text-center h-100">

                <i class="bi bi-megaphone fs-1 text-warning"></i>

                <h5 class="mt-3 fw-semibold">Pengumuman Hasil</h5>

                <p class="text-muted">
                    Hasil seleksi diumumkan secara resmi melalui sistem.
                </p>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-custom p-4 text-center h-100">

                <i class="bi bi-credit-card fs-1 text-danger"></i>

                <h5 class="mt-3 fw-semibold">Registrasi Ulang</h5>

                <p class="text-muted">
                    Pembayaran UKT dan aktivasi status mahasiswa baru.
                </p>

            </div>

        </div>

    </div>

</section>

<!-- OSPEK -->
<section class="container mb-5">

    <div class="card card-custom p-5 text-center">

        <h2 class="fw-bold">🎓 Orientasi Studi Mahasiswa Baru</h2>

        <p class="text-muted mt-3">
            Setelah proses registrasi ulang selesai, mahasiswa wajib mengikuti kegiatan OSPEK
            sebagai pengenalan lingkungan kampus dan sistem akademik.
        </p>

        <hr class="my-4">

        <p class="mb-0 text-muted">
            Universitas berkomitmen membentuk mahasiswa yang disiplin, adaptif, dan berintegritas.
        </p>

    </div>

</section>

<?php include 'template/footer.php'; ?>