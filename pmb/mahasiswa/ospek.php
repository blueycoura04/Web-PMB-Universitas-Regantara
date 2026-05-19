<?php

include '../config/session.php';
include '../config/koneksi.php';

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

/* ===================== AMBIL DATA ===================== */
$q = mysqli_query($koneksi,"SELECT * FROM pendaftaran WHERE id_user='$id_user' LIMIT 1");
$data = mysqli_fetch_assoc($q);

/* ===================== SAFE CHECK ===================== */
$status = strtolower(trim($data['status'] ?? ''));
$bayar  = strtolower(trim($data['status_pembayaran'] ?? ''));
$bukti  = $data['bukti_pembayaran'] ?? '';

/* ===================== LOGIC OSPEK (REAL KAMPUS) ===================== */
$boleh_ospek = (
    $status === 'diterima' &&
    $bayar === 'lunas' &&
    !empty($bukti)
);

include 'template/header.php';
include 'template/navbar.php';

?>

<div class="container py-5">

    <div class="text-center mb-4">
        <h3 class="fw-bold">OSPEK MAHASISWA BARU</h3>
        <p class="text-muted">Orientasi Studi dan Pengenalan Kampus</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- ===================== STATUS CARD ===================== -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body text-center p-4">

                    <?php if(!$data){ ?>

                        <div class="alert alert-secondary">
                            📭 Anda belum terdaftar
                        </div>

                    <?php } elseif($status !== 'diterima'){ ?>

                        <div class="alert alert-warning">
                            ⏳ OSPEK belum tersedia
                        </div>

                        <p class="text-muted">
                            Status Anda: <b><?= $status ?: 'belum' ?></b>
                        </p>

                    <?php } elseif($bayar !== 'lunas'){ ?>

                        <div class="alert alert-info">
                            💰 Menunggu pembayaran UKT</div>

                        <p class="text-muted">
                            Status UKT: <b><?= $bayar ?: 'belum' ?></b>
                        </p>

                    <?php } elseif(empty($bukti)){ ?>

                        <div class="alert alert-warning">
                            📄 Menunggu verifikasi bukti pembayaran
                        </div>

                        <p class="text-muted">
                            Bukti pembayaran belum diverifikasi admin
                        </p>

                    <?php } else { ?>

                        <div class="alert alert-success">
                            🎉 SELAMAT ANDA MAHASISWA BARU
                        </div>

                    <?php } ?>

                </div>
            </div>

            <!-- ===================== OSPEK CONTENT ===================== -->
            <?php if($boleh_ospek){ ?>

                <div class="card shadow border-0 rounded-4 p-4">

                    <h5 class="fw-bold mb-3">📌 Jadwal OSPEK</h5>

                    <ul class="list-group mb-3">
                        <li class="list-group-item">10 - 12 Agustus 2026</li>
                        <li class="list-group-item">08.00 - 15.00 WIB</li>
                        <li class="list-group-item">Aula Kampus Utama</li>
                    </ul>

                    <h5 class="fw-bold">📌 Kegiatan OSPEK</h5>

                    <ul class="list-group">
                        <li class="list-group-item">✔ Pengenalan Kampus</li>
                        <li class="list-group-item">✔ Sistem Akademik</li>
                        <li class="list-group-item">✔ Etika Mahasiswa</li>
                        <li class="list-group-item">✔ Organisasi Mahasiswa</li>
                        <li class="list-group-item">✔ Tour Kampus</li>
                    </ul>

                </div>

            <?php } else { ?>

                <div class="alert alert-light text-center border">
                    OSPEK akan terbuka jika:
                    <br>
                    <b>Diterima + UKT Lunas + Bukti Diverifikasi</b>
                </div>

            <?php } ?>

        </div>
    </div>

</div>

<?php include 'template/footer.php'; ?>