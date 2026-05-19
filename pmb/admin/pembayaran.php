<?php
include '../config/session.php';
include '../config/koneksi.php';

if($_SESSION['role']!='admin'){
    header("Location: ../auth/login.php");
    exit;
}

/* =========================
   DATA MAHASISWA LULUS SELEKSI
========================= */
$data = mysqli_query($koneksi,"
    SELECT * FROM pendaftaran 
    WHERE status='diterima'
");

include 'template/header.php';
include 'template/navbar.php';
?>

<div class="container py-4">

    <h3 class="fw-bold mb-3">💳 Verifikasi Pembayaran UKT</h3>
    <p class="text-muted">Daftar mahasiswa yang sudah diterima dan menunggu pembayaran registrasi</p>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>No Pendaftaran</th>
                            <th>Jurusan</th>
                            <th>Status Pendaftaran</th>
                            <th>Status Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while($d=mysqli_fetch_assoc($data)){ ?>

                        <tr>
                            <td class="fw-semibold">
                                <?= $d['nama_lengkap'] ?>
                            </td>

                            <td>
                                <span class="badge bg-dark">
                                    <?= $d['no_pendaftaran'] ?>
                                </span>
                            </td>

                            <td><?= $d['jurusan'] ?></td>

                            <td>
                                <span class="badge bg-success">
                                    DITERIMA
                                </span>
                            </td>

                            <td>
                                <?php if($d['status_pembayaran']=='lunas'){ ?>
                                    <span class="badge bg-success">LUNAS</span>
                                <?php } elseif($d['status_pembayaran']=='pending'){ ?>
                                    <span class="badge bg-warning text-dark">MENUNGGU</span>
                                <?php } else { ?>
                                    <span class="badge bg-danger">BELUM BAYAR</span>
                                <?php } ?>
                            </td>

                            <td>
                                <a href="pembayaran_detail.php?id=<?= $d['id_pendaftaran'] ?>"
                                   class="btn btn-sm btn-primary">
                                    Detail
                                </a>
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