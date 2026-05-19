<?php

include '../config/session.php';
include '../config/koneksi.php';

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

/* =========================
   AMBIL DATA PENDAFTARAN
========================= */
$q = mysqli_query($koneksi,"SELECT * FROM pendaftaran WHERE id_user='$id_user'");
$data = mysqli_fetch_assoc($q);

/* =========================
   SAFE MODE ANTI ERROR NULL
========================= */
$status = $data['status'] ?? '';

/* =========================
   LOCK FORMULIR
========================= */
$is_locked = !empty($status);

$progress = 0;
$label = "Belum Daftar";

/* =========================
   PROGRESS LOGIC REAL PMB
========================= */
if(empty($status)){
    $progress = 0;
    $label = "Belum Daftar";
}
elseif($status == 'formulir'){
    $progress = 20;
    $label = "Formulir Terisi";
}
elseif($status == 'upload'){
    $progress = 40;
    $label = "Berkas Diunggah";
}
elseif($status == 'upload_lengkap'){
    $progress = 60;
    $label = "Berkas Lengkap";
}
elseif($status == 'seleksi'){
    $progress = 75;
    $label = "Tahap Seleksi";
}
elseif($status == 'diterima'){
    $progress = 100;
    $label = "Selesai Seleksi";
}
elseif($status == 'ditolak'){
    $progress = 100;
    $label = "Selesai Seleksi";
}
else{
    $progress = 10;
    $label = "Proses Awal";
}

include 'template/header.php';
include 'template/navbar.php';

?>

<style>

.content{
    padding:40px 20px;
    min-height:100vh;
    background:#f5f7fb;
}

.card-custom{
    border:none;
    border-radius:20px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.menu-card{
    transition:0.3s;
}

.menu-card:hover{
    transform:translateY(-5px);
}

@media(max-width:768px){
    .content{
        padding:20px 10px;
    }
}

</style>

<div class="content">

<?php if($page == 'dashboard'){ ?>

<!-- HEADER -->
<div class="mb-4">

    <h2 class="fw-bold">Dashboard Mahasiswa</h2>

    <p class="text-muted">
        Selamat datang, <b><?= $_SESSION['nama']; ?></b><br>
        Silakan mulai pendaftaran PMB Anda
    </p>

</div>

<!-- STATUS (TETAP ADA TAPI TANPA STATUS LULUS) -->
<div class="card card-custom p-4 text-center">

    <div class="mb-3">
        <i class="bi bi-person-plus fs-1 text-primary"></i>
    </div>

    <h4 class="fw-bold">
        <?= empty($status) ? "Anda Belum Melakukan Pendaftaran" : "Status Pendaftaran Anda: $label" ?>
    </h4>

    <p class="text-muted">
        Silakan lengkapi formulir untuk mengikuti seleksi PMB.
    </p>

</div>

<!-- PROGRESS -->
<div class="card card-custom p-4 mt-4">

    <div class="d-flex justify-content-between">
        <h5 class="fw-bold">Progress Pendaftaran</h5>
        <span class="fw-bold text-muted"><?= $progress ?>%</span>
    </div>

    <div class="progress mt-3" style="height:25px;">
        <div class="progress-bar" style="width:<?= $progress ?>%;">
            <?= $progress ?>%
        </div>
    </div>

    <div class="row text-center mt-4">

        <div class="col">
            <i class="bi bi-check-circle<?= $progress >= 0 ? '-fill text-primary' : ' text-secondary' ?> fs-3"></i>
            <p class="small mt-2">Registrasi</p>
        </div>

        <div class="col">
            <i class="bi bi-check-circle<?= $progress >= 20 ? '-fill text-primary' : ' text-secondary' ?> fs-3"></i>
            <p class="small mt-2">Formulir</p>
        </div>

        <div class="col">
            <i class="bi bi-check-circle<?= $progress >= 40 ? '-fill text-primary' : ' text-secondary' ?> fs-3"></i>
            <p class="small mt-2">Upload</p>
        </div>

        <div class="col">
            <i class="bi bi-check-circle<?= $progress >= 75 ? '-fill text-primary' : ' text-secondary' ?> fs-3"></i>
            <p class="small mt-2">Seleksi</p>
        </div>

        <div class="col">
            <i class="bi bi-check-circle<?= $progress >= 100 ? '-fill text-success' : ' text-secondary' ?> fs-3"></i>
            <p class="small mt-2">Selesai</p>
        </div>

    </div>

</div>

<!-- MENU -->
<div class="mt-5">

    <h4 class="fw-bold mb-4">Menu Pendaftaran</h4>

    <div class="row g-4">

        <div class="col-md-4">

            <?php if(!$is_locked){ ?>
                <a href="formulir.php" class="text-decoration-none">
            <?php } else { ?>
                <a href="formulir.php?mode=view" class="text-decoration-none">
            <?php } ?>

                <div class="card card-custom menu-card text-center p-4">

                    <i class="bi bi-pencil-square fs-1 text-primary"></i>

                    <h6 class="mt-3 text-dark">
                        <?= !$is_locked ? 'Formulir' : 'Lihat Formulir' ?>
                    </h6>

                    <?php if($is_locked){ ?>
                        <small class="text-danger">🔒 Terkunci</small>
                    <?php } ?>

                </div>
            </a>

        </div>

        <div class="col-md-4">
            <a href="upload_file.php" class="text-decoration-none">
                <div class="card card-custom menu-card text-center p-4">
                    <i class="bi bi-upload fs-1 text-success"></i>
                    <h6 class="mt-3 text-dark">Upload Berkas</h6>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="pengumuman.php" class="text-decoration-none">
                <div class="card card-custom menu-card text-center p-4">
                    <i class="bi bi-megaphone-fill fs-1 text-danger"></i>
                    <h6 class="mt-3 text-dark">Pengumuman</h6>
                </div>
            </a>
        </div>

    </div>

</div>

<?php } ?>

</div>

<?php include 'template/footer.php'; ?>