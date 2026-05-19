<?php
include '../config/koneksi.php';
include '../config/session.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

if(!isset($_GET['id'])){
    echo "<script>alert('ID tidak ditemukan');window.location='pendaftar.php';</script>";
    exit;
}

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT * FROM pendaftaran WHERE id_pendaftaran='$id'
"));

if(!$data){
    echo "<script>alert('Data tidak ditemukan');window.location='pendaftar.php';</script>";
    exit;
}

include 'template/header.php';
include 'template/navbar.php';
?>

<div class="container py-4">

    <div class="card p-4 shadow-sm">

        <h4><?= $data['nama_lengkap'] ?></h4>
        <p class="text-muted"><?= $data['email'] ?></p>

        <hr>

        <p><b>NISN:</b> <?= $data['nisn'] ?></p>
        <p><b>NIK:</b> <?= $data['nik'] ?></p>
        <p><b>Jurusan:</b> <?= $data['jurusan'] ?></p>

        <hr>

        <div class="mt-4">

            <!-- 🔥 INI YANG BENAR -->
            <a href="verifikasi_berkas.php?id=<?= $data['id_pendaftaran'] ?>" class="btn btn-primary">
                Verifikasi Berkas
            </a>

            <a href="pendaftar.php" class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>

</div>

<?php include 'template/footer.php'; ?>