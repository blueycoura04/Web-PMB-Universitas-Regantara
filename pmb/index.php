<?php
include 'template/header.php';
include 'template/navbar.php';
?>

<style>

/* ===== GLOBAL ===== */
body{
    background:#f6f8fc;
    font-family:system-ui, -apple-system, Segoe UI, Roboto;
}

/* ===== HERO ===== */
.hero{
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color:white;
    padding:100px 0;
    position:relative;
    overflow:hidden;
}

.hero::after,
.hero::before{
    content:"";
    position:absolute;
    border-radius:50%;
    background:rgba(255,255,255,0.08);
}

.hero::after{
    width:320px;
    height:320px;
    top:-120px;
    right:-120px;
}

.hero::before{
    width:220px;
    height:220px;
    bottom:-90px;
    left:-90px;
}

.hero h1{
    font-weight:800;
}

.hero p{
    opacity:0.85;
}

/* ===== SECTION ===== */
section{
    padding:65px 0;
}

/* ===== TITLE ===== */
.section-title{
    font-weight:800;
    color:#1e3c72;
}

.section-subtitle{
    color:#6c757d;
}

/* ===== CARD ===== */
.card-custom{
    border:none;
    border-radius:20px;
    background:#fff;
    box-shadow:0 8px 20px rgba(0,0,0,0.06);
    transition:0.25s ease;
    height:100%;
}

.card-custom:hover{
    transform:translateY(-6px);
    box-shadow:0 14px 30px rgba(0,0,0,0.12);
}

/* ICON */
.icon-box{
    width:64px;
    height:64px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 14px;
    background:#eef3ff;
}

/* ===== BADGE STYLE ===== */
.badge-soft{
    padding:8px 12px;
    border-radius:12px;
    font-weight:500;
}

/* ===== OSPEK ===== */
.ospek-card{
    border:none;
    border-radius:24px;
    background:linear-gradient(135deg,#ffffff,#f3f6ff);
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.ospek-title{
    font-weight:800;
    color:#1e3c72;
}

.small-note{
    font-size:14px;
    color:#6c757d;
}

</style>

<!-- HERO -->
<section class="hero">

    <div class="container text-center">

        <h1 class="display-5">
            🎓 PMB Universitas Regantara
        </h1>

        <p class="lead mt-3">
            Sistem Penerimaan Mahasiswa Baru yang transparan, cepat, dan terintegrasi.
        </p>

        <a href="auth/register.php" class="btn btn-light btn-lg mt-4 px-4">
            Mulai Pendaftaran
        </a>

        <div class="mt-3 small opacity-75">
            Tahun Akademik 2026 / 2027
        </div>

    </div>

</section>

<!-- ALUR PMB -->
<section class="container">

    <div class="text-center mb-5">

        <h2 class="section-title">Alur Pendaftaran PMB</h2>

        <p class="section-subtitle">
            Proses sederhana, transparan, dan bisa dipantau secara online
        </p>

    </div>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card card-custom p-4 text-center">
                <div class="icon-box">
                    <i class="bi bi-person-plus fs-3 text-primary"></i>
                </div>
                <h6 class="fw-bold">Registrasi Akun</h6>
                <p class="small-note">
                    Mahasiswa membuat akun PMB terlebih dahulu.
                </p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom p-4 text-center">
                <div class="icon-box">
                    <i class="bi bi-file-earmark-arrow-up fs-3 text-success"></i>
                </div>
                <h6 class="fw-bold">Upload Berkas</h6>
                <p class="small-note">
                    Upload dokumen seperti ijazah & rapor.
                </p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom p-4 text-center">
                <div class="icon-box">
                    <i class="bi bi-clipboard-check fs-3 text-warning"></i>
                </div>
                <h6 class="fw-bold">Seleksi Administrasi</h6>
                <p class="small-note">
                    Tim kampus melakukan verifikasi data.
                </p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom p-4 text-center">
                <div class="icon-box">
                    <i class="bi bi-cash-coin fs-3 text-danger"></i>
                </div>
                <h6 class="fw-bold">UKT & Registrasi</h6>
                <p class="small-note">
                    Pembayaran UKT dan status mahasiswa aktif.
                </p>
            </div>
        </div>

    </div>

</section>

<!-- OSPEK -->
<section class="container mb-5">

    <div class="card ospek-card p-5 text-center">

        <h2 class="ospek-title">
            🎓 OSPEK Mahasiswa Baru
        </h2>

        <p class="mt-3 text-muted">
            OSPEK (Orientasi Studi dan Pengenalan Kampus) adalah kegiatan wajib untuk mahasiswa baru
            agar memahami sistem akademik, lingkungan kampus, dan budaya universitas.
        </p>

        <div class="mt-4 d-flex justify-content-center gap-2 flex-wrap">

            <span class="badge bg-primary badge-soft">Friendly Environment</span>
            <span class="badge bg-success badge-soft">Academic System</span>
            <span class="badge bg-warning text-dark badge-soft">Student Life</span>
            <span class="badge bg-info text-dark badge-soft">Campus Tour</span>

        </div>

        <hr class="my-4">

        <p class="small-note mb-0">
            Universitas Regantara berkomitmen menciptakan mahasiswa yang disiplin, adaptif, dan berintegritas.
        </p>

    </div>

</section>

<?php include 'template/footer.php'; ?>
