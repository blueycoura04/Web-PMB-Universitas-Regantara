<?php

include '../config/session.php';
include '../config/koneksi.php';

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$q = mysqli_query($koneksi,"SELECT * FROM pendaftaran WHERE id_user='$id_user'");
$data = mysqli_fetch_assoc($q);

include 'template/header.php';
include 'template/navbar.php';

?>

<!-- ===================== CONTENT ===================== -->
<div class="container py-5">

    <div class="mb-4 text-center">
        <h3 class="fw-bold">Pengumuman Hasil Seleksi PMB</h3>
        <p class="text-muted">Status kelulusan mahasiswa baru</p>
    </div>

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <!-- STATUS CARD -->
            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5 text-center">

                    <!-- STATUS ICON -->
                    <?php if(!isset($data['status']) || $data['status'] == 'pending'){ ?>

                        <div class="mb-3">
                            <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                                MENUNGGU SELEKSI
                            </span>
                        </div>

                        <h4 class="fw-bold text-dark">Proses Seleksi Belum Selesai</h4>
                        <p class="text-muted mt-2">
                            Silakan tunggu hasil seleksi dari pihak universitas.
                        </p>

                        <div class="alert alert-info mt-4">
                            📌 Sistem sedang memverifikasi data dan dokumen Anda
                        </div>

                    <?php } elseif($data['status'] == 'diterima'){ ?>

                        <div class="mb-3">
                            <span class="badge bg-success fs-6 px-3 py-2">
                                SELAMAT ANDA LULUS
                            </span>
                        </div>

                        <h4 class="fw-bold text-success">Anda Dinyatakan Diterima 🎉</h4>

                        <p class="text-muted mt-2">
                            Selamat! Anda telah diterima sebagai calon mahasiswa baru.
                        </p>

                        <div class="alert alert-success mt-4">
                            ✔ Lanjutkan ke tahap pembayaran daftar ulang
                        </div>

                        <a href="pembayaran.php" class="btn btn-success mt-3 w-100">
                            Lanjut Pembayaran
                        </a>

                    <?php } elseif($data['status'] == 'ditolak'){ ?>

                        <div class="mb-3">
                            <span class="badge bg-danger fs-6 px-3 py-2">
                                TIDAK LULUS
                            </span>
                        </div>

                        <h4 class="fw-bold text-danger">Mohon Maaf, Anda Tidak Lulus</h4>

                        <p class="text-muted mt-2">
                            Anda belum memenuhi kriteria seleksi PMB.
                        </p>

                        <div class="alert alert-danger mt-4">
                            ❌ Silakan coba pada periode pendaftaran berikutnya
                        </div>

                    <?php } ?>

                </div>

            </div>

            <!-- INFO DETAIL -->
            <div class="card border-0 shadow-sm rounded-4 mt-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">Data Pendaftar</h5>

                    <table class="table table-borderless">

                        <tr>
                            <th>Nama</th>
                            <td>: <?= $data['nama_lengkap'] ?? '-' ?></td>
                        </tr>

                        <tr>
                            <th>Fakultas</th>
                            <td>: <?= $data['fakultas'] ?? '-' ?></td>
                        </tr>

                        <tr>
                            <th>Jurusan</th>
                            <td>: <?= $data['jurusan'] ?? '-' ?></td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                : 
                                <span class="badge 
                                <?php 
                                    if($data['status']=='diterima') echo 'bg-success';
                                    elseif($data['status']=='ditolak') echo 'bg-danger';
                                    else echo 'bg-warning text-dark';
                                ?>">
                                    <?= strtoupper($data['status'] ?? 'PENDING') ?>
                                </span>
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'template/footer.php'; ?>