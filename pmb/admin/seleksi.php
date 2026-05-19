<?php
include '../config/koneksi.php';
include '../config/session.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

/* =========================
   PROSES TERIMA / TOLAK
========================= */
if(isset($_GET['terima'])){
    $id = $_GET['terima'];

    $cek = mysqli_fetch_assoc(mysqli_query($koneksi,
        "SELECT * FROM pendaftaran WHERE id_pendaftaran='$id'"
    ));

    if($cek['status_berkas'] != 'lengkap'){
        echo "<script>alert('Tidak bisa diterima, berkas belum lengkap');window.location='seleksi.php';</script>";
        exit;
    }

    mysqli_query($koneksi,
        "UPDATE pendaftaran SET status='diterima' WHERE id_pendaftaran='$id'"
    );

    echo "<script>alert('Mahasiswa diterima');window.location='seleksi.php';</script>";
    exit;
}

if(isset($_GET['tolak'])){
    $id = $_GET['tolak'];

    mysqli_query($koneksi,
        "UPDATE pendaftaran SET status='ditolak' WHERE id_pendaftaran='$id'"
    );

    echo "<script>alert('Mahasiswa ditolak');window.location='seleksi.php';</script>";
    exit;
}

/* =========================
   AMBIL DATA
========================= */
$data = mysqli_query($koneksi,
    "SELECT * FROM pendaftaran ORDER BY created_at DESC"
);

include 'template/header.php';
include 'template/navbar.php';
?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold">Seleksi PMB</h3>
        <p class="text-muted">Penentuan kelulusan calon mahasiswa</p>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Berkas</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php while($d = mysqli_fetch_assoc($data)){ ?>

                        <!-- STATUS BADGE -->
                        <?php
                            $status = $d['status'];

                            $badge = "secondary";
                            if($status == "diterima") $badge = "success";
                            elseif($status == "ditolak") $badge = "danger";
                            elseif($status == "seleksi") $badge = "warning text-dark";
                            else $badge = "secondary";
                        ?>

                        <tr>
                            <td class="fw-semibold"><?= $d['nama_lengkap'] ?></td>
                            <td><?= $d['nisn'] ?></td>

                            <!-- BERKAS -->
                            <td>
                                <?php if($d['status_berkas'] == 'lengkap'){ ?>
                                    <span class="badge bg-success">Lengkap</span>
                                <?php } elseif($d['status_berkas'] == 'tidak_lengkap'){ ?>
                                    <span class="badge bg-danger">Tidak Lengkap</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning text-dark">Belum Dicek</span>
                                <?php } ?>
                            </td>

                            <!-- PEMBAYARAN -->
                            <td>
                                <?php if($d['status_pembayaran'] == 'lunas'){ ?>
                                    <span class="badge bg-success">Lunas</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Belum</span>
                                <?php } ?>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <span class="badge bg-<?= $badge ?>">
                                    <?= strtoupper($status) ?>
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td>

                                <a href="detail.php?id=<?= $d['id_pendaftaran'] ?>"
                                   class="btn btn-primary btn-sm">
                                    Detail
                                </a>

                                <?php if($status != 'diterima'){ ?>

                                    <a href="?terima=<?= $d['id_pendaftaran'] ?>"
                                       class="btn btn-success btn-sm"
                                       onclick="return confirm('Terima mahasiswa ini?')">
                                        Terima
                                    </a>

                                    <a href="?tolak=<?= $d['id_pendaftaran'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Tolak mahasiswa ini?')">
                                        Tolak
                                    </a>

                                <?php } else { ?>
                                    <span class="text-success small">✔ Selesai</span>
                                <?php } ?>

                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?php include 'template/footer.php'; ?>