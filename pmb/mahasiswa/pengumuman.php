<?php
include '../config/koneksi.php';
include '../config/session.php';

include 'template/header.php';
include 'template/navbar.php';

$id_user = $_SESSION['id_user'];

/* ===================== AMBIL DATA USER ===================== */
$q = mysqli_query($koneksi, "
    SELECT * FROM pendaftaran 
    WHERE id_user='$id_user' 
    LIMIT 1
");

$data = mysqli_fetch_assoc($q);

/* ===================== VALIDASI DATA ===================== */
if(!$data){
?>

<div class="container py-5 text-center">
    <div class="card shadow-sm border-0 p-5 rounded-4">

        <h3 class="fw-bold text-danger">Data Tidak Ditemukan</h3>
        <p class="text-muted mt-2">
            Anda belum melakukan pendaftaran.
        </p>

        <a href="formulir.php" class="btn btn-primary mt-3">
            Isi Formulir
        </a>

    </div>
</div>

<?php
include 'template/footer.php';
exit;
}

/* ===================== CEK STATUS SELEKSI ===================== */
$status = $data['status'];

if($status == 'pending' || $status == 'formulir' || $status == 'upload'){
?>

<div class="container py-5 text-center">

    <div class="card shadow-sm border-0 p-5 rounded-4">

        <h3 class="fw-bold text-warning">Pengumuman Belum Tersedia</h3>

        <p class="text-muted mt-2">
            Data Anda masih dalam proses seleksi oleh admin.
        </p>

        <a href="dashboard.php" class="btn btn-primary mt-3">
            Kembali ke Dashboard
        </a>

    </div>

</div>

<?php
include 'template/footer.php';
exit;
}

?>

<!-- ===================== HASIL PENGUMUMAN ===================== -->
<div class="container py-5">

    <div class="text-center mb-4">
        <h2 class="fw-bold">Pengumuman Hasil Seleksi</h2>
        <p class="text-muted">Penerimaan Mahasiswa Baru</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center p-5">

                    <?php if($status == 'diterima'){ ?>

                        <h3 class="fw-bold text-success">🎉 SELAMAT!</h3>
                        <p class="text-muted">Anda dinyatakan <b>LULUS</b> seleksi PMB.</p>

                        <a href="pembayaran.php" class="btn btn-success w-100 mt-3">
                            Lanjut UKT
                        </a>

                    <?php } elseif($status == 'ditolak'){ ?>

                        <h3 class="fw-bold text-danger">MAAF</h3>
                        <p class="text-muted">Anda <b>tidak lolos</b> seleksi PMB.</p>

                    <?php } ?>

                </div>
            </div>

            <!-- DATA -->
            <div class="card mt-4 border-0 shadow-sm rounded-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">Data Pendaftar</h5>

                    <table class="table table-borderless">
                        <tr>
                            <th>Nama</th>
                            <td><?= $data['nama_lengkap'] ?></td>
                        </tr>
                        <tr>
                            <th>NISN</th>
                            <td><?= $data['nisn'] ?></td>
                        </tr>
                        <tr>
                            <th>No Pendaftaran</th>
                            <td><?= $data['no_pendaftaran'] ?></td>
                        </tr>
                        <tr>
                            <th>Fakultas</th>
                            <td><?= $data['fakultas'] ?></td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td><?= $data['jurusan'] ?></td>
                        </tr>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'template/footer.php'; ?>