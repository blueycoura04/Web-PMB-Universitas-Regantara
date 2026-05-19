<?php
include '../config/koneksi.php';
include '../config/session.php';

if($_SESSION['role']!='admin'){
    header("Location: ../auth/login.php");
    exit;
}

/* =====================
   UPDATE STATUS BERKAS
===================== */
if(isset($_GET['lengkap'])){

    $id = $_GET['lengkap'];

    mysqli_query($koneksi,"
        UPDATE pendaftaran 
        SET status_berkas='lengkap' 
        WHERE id_pendaftaran='$id'
    ");

    echo "<script>alert('Berkas lengkap');window.location='verifikasi_berkas.php';</script>";
    exit;
}

if(isset($_GET['tidak'])){

    $id = $_GET['tidak'];

    mysqli_query($koneksi,"
        UPDATE pendaftaran 
        SET status_berkas='tidak_lengkap' 
        WHERE id_pendaftaran='$id'
    ");

    echo "<script>alert('Berkas tidak lengkap');window.location='verifikasi_berkas.php';</script>";
    exit;
}

/* =====================
   AMBIL DATA
===================== */
$data = mysqli_query($koneksi,"
    SELECT * FROM pendaftaran
    WHERE foto IS NOT NULL OR ijazah IS NOT NULL OR rapor IS NOT NULL
");

include 'template/header.php';
include 'template/navbar.php';
?>

<div class="container py-4">

    <h3 class="fw-bold mb-4">Verifikasi Berkas PMB</h3>

    <table class="table table-bordered table-striped">

        <tr>
            <th>Nama</th>
            <th>Foto</th>
            <th>Ijazah</th>
            <th>Rapor</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php while($d = mysqli_fetch_assoc($data)){ ?>

        <tr>
            <td><?= $d['nama_lengkap'] ?></td>

            <td>
                <?php if($d['foto']){ ?>
                    <span class="badge bg-success">Ada</span>
                <?php } else { ?>
                    <span class="badge bg-danger">Kosong</span>
                <?php } ?>
            </td>

            <td>
                <?php if($d['ijazah']){ ?>
                    <span class="badge bg-success">Ada</span>
                <?php } else { ?>
                    <span class="badge bg-danger">Kosong</span>
                <?php } ?>
            </td>

            <td>
                <?php if($d['rapor']){ ?>
                    <span class="badge bg-success">Ada</span>
                <?php } else { ?>
                    <span class="badge bg-danger">Kosong</span>
                <?php } ?>
            </td>

            <td>
                <span class="badge bg-info">
                    <?= $d['status_berkas'] ?? 'belum' ?>
                </span>
            </td>

            <td>
                <a href="?lengkap=<?= $d['id_pendaftaran'] ?>" class="btn btn-success btn-sm">
                    Lengkap
                </a>

                <a href="?tidak=<?= $d['id_pendaftaran'] ?>" class="btn btn-danger btn-sm">
                    Tidak Lengkap
                </a>
            </td>

        </tr>

        <?php } ?>

    </table>

</div>

<?php include 'template/footer.php'; ?>