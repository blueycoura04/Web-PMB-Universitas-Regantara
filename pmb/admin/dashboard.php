<?php

include '../config/session.php';
include '../config/koneksi.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

/* STATISTIK */
$total = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as t FROM pendaftaran"))['t'];
$pending = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as t FROM pendaftaran WHERE status='pending'"))['t'];
$diterima = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as t FROM pendaftaran WHERE status='diterima'"))['t'];
$ditolak = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as t FROM pendaftaran WHERE status='ditolak'"))['t'];

include 'template/header.php';
include 'template/navbar.php';
?>

<style>

/* ================= RESET LAYOUT ================= */
body{
    margin:0;
    background:#f5f6fa;
}

/* ❗ INI PENTING: hilangkan efek sidebar geser */
.content{
    padding:20px;
    margin-left:0 !important;
}

/* ================= STAT CARD ================= */
.stat-card{
    background:#fff;
    border-radius:14px;
    padding:14px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
    height:100%;
    transition:.2s;
}

.stat-card:hover{
    transform:translateY(-2px);
}

.stat-card small{
    font-size:12px;
    color:#6c757d;
}

.stat-card h4{
    margin:0;
    font-weight:700;
}

/* ================= ALUR PMB ================= */
.step-wrapper{
    overflow-x:auto;
    padding-bottom:10px;
}

.stepper{
    display:flex;
    align-items:center;
    min-width:max-content;
}

.step{
    text-align:center;
    width:110px;
    flex-shrink:0;
}

.circle{
    width:42px;
    height:42px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 6px;
    font-weight:600;
    color:#fff;
    font-size:14px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

.step-label{
    font-size:11px;
    color:#555;
    font-weight:500;
}

.line{
    width:35px;
    height:2px;
    background:#dee2e6;
    flex-shrink:0;
}

</style>

<div class="content">

    <!-- HEADER -->
    <div class="mb-3">
        <h4 class="fw-bold mb-0">Dashboard Admin PMB</h4>
        <small class="text-muted">Monitoring sistem penerimaan mahasiswa baru</small>
    </div>

    <!-- ================= STATISTIC ================= -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <small>Total</small>
                <h4 class="text-primary"><?= $total ?></h4>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <small>Pending</small>
                <h4 class="text-warning"><?= $pending ?></h4>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <small>Diterima</small>
                <h4 class="text-success"><?= $diterima ?></h4>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <small>Ditolak</small>
                <h4 class="text-danger"><?= $ditolak ?></h4>
            </div>
        </div>

    </div>

    <!-- ================= ALUR PMB ================= -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">

            <h6 class="fw-bold mb-3">📌 Alur PMB</h6>

            <div class="step-wrapper">

                <div class="stepper">

                    <div class="step">
                        <div class="circle bg-secondary">1</div>
                        <div class="step-label">Register</div>
                    </div>

                    <div class="line"></div>

                    <div class="step">
                        <div class="circle bg-secondary">2</div>
                        <div class="step-label">Login</div>
                    </div>

                    <div class="line"></div>

                    <div class="step">
                        <div class="circle bg-primary">3</div>
                        <div class="step-label">Form</div>
                    </div>

                    <div class="line"></div>

                    <div class="step">
                        <div class="circle bg-info text-dark">4</div>
                        <div class="step-label">Upload</div>
                    </div>

                    <div class="line"></div>

                    <div class="step">
                        <div class="circle bg-warning text-dark">5</div>
                        <div class="step-label">Seleksi</div>
                    </div>

                    <div class="line"></div>

                    <div class="step">
                        <div class="circle bg-success">6</div>
                        <div class="step-label">Hasil</div>
                    </div>

                    <div class="line"></div>

                    <div class="step">
                        <div class="circle bg-success">7</div>
                        <div class="step-label">Bayar</div>
                    </div>

                    <div class="line"></div>

                    <div class="step">
                        <div class="circle bg-dark">8</div>
                        <div class="step-label">Aktif</div>
                    </div>

                    <div class="line"></div>

                    <div class="step">
                        <div class="circle bg-dark">9</div>
                        <div class="step-label">OSPEK</div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

<?php include 'template/footer.php'; ?>