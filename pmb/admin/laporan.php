<?php
include '../config/koneksi.php';
include '../config/session.php';

$data = mysqli_query($koneksi,"
    SELECT * FROM pendaftaran 
    WHERE status IN ('diterima','ditolak')
    ORDER BY id_pendaftaran DESC
");

include 'template/header.php';
include 'template/navbar.php';
?>

<div class="container py-4">

    <div class="mb-3">
        <h3 class="fw-bold">Pengumuman PMB</h3>
        <p class="text-muted">Hasil seleksi penerimaan mahasiswa baru</p>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($d = mysqli_fetch_assoc($data)) { ?>

                    <tr>
                        <td><?= $d['no_pendaftaran'] ?></td>
                        <td><?= $d['nama_lengkap'] ?></td>
                        <td><?= $d['jurusan'] ?></td>

                        <td>
                            <?php if($d['status'] == 'diterima'){ ?>
                                <span class="badge bg-success">DITERIMA</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">TIDAK LULUS</span>
                            <?php } ?>
                        </td>

                        <td>
                            <a href="detail_pengumuman.php?id=<?= $d['id_pendaftaran'] ?>" 
                               class="btn btn-primary btn-sm">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include 'template/footer.php'; ?>