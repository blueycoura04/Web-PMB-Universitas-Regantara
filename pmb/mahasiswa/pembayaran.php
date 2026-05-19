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

$belum_daftar = !$data;

/* ===================== SAFE VARIABLE ===================== */
$status_pembayaran = $data['status_pembayaran'] ?? 'belum';
$status_pendaftaran = $data['status'] ?? '';

/* ===================== BLOCK: HARUS DITERIMA ===================== */
if(!$belum_daftar && $status_pendaftaran != 'diterima'){
    echo "<script>
        alert('Pembayaran UKT hanya bisa dilakukan setelah Anda DINYATAKAN DITERIMA');
        window.location='dashboard.php';
    </script>";
    exit;
}

/* ===================== PROSES UPLOAD UKT ===================== */
if(isset($_POST['bayar'])){

    if($belum_daftar){
        echo "<script>alert('Anda belum daftar');window.location='formulir.php';</script>";
        exit;
    }

    if($status_pendaftaran != 'diterima'){
        echo "<script>alert('Anda belum diterima');window.location='dashboard.php';</script>";
        exit;
    }

    $folder = "uploads/";

    if(!is_dir($folder)){
        mkdir($folder, 0777, true);
    }

    if(!empty($_FILES['bukti']['name'])){

        $ext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
        $nama_file = "ukt_".$id_user."_".time().".".$ext;

        if(move_uploaded_file($_FILES['bukti']['tmp_name'], $folder.$nama_file)){

            mysqli_query($koneksi,"
                UPDATE pendaftaran SET
                    bukti_pembayaran='$nama_file',
                    status_pembayaran='menunggu'
                WHERE id_user='$id_user'
            ");
        }
    }

    echo "<script>
        alert('Bukti UKT berhasil dikirim, menunggu verifikasi admin');
        window.location='dashboard.php';
    </script>";
}
?>

<?php include 'template/header.php'; ?>
<?php include 'template/navbar.php'; ?>

<div class="container py-5">

    <h3 class="fw-bold mb-2">Pembayaran UKT</h3>
    <p class="text-muted">Upload bukti pembayaran registrasi ulang (UKT)</p>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- INFO UKT -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold">Informasi UKT</h5>

                    <div class="alert alert-warning mt-3">
                        💰 Nominal UKT: <b>Rp 2.500.000</b>
                    </div>

                </div>
            </div>

            <!-- STATUS UKT -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold">Status UKT</h5>

                    <?php if($belum_daftar){ ?>

                        <span class="badge bg-secondary">Belum Daftar</span>

                    <?php } elseif($status_pembayaran == 'belum'){ ?>

                        <span class="badge bg-danger">Belum Bayar UKT</span>

                    <?php } elseif($status_pembayaran == 'menunggu'){ ?>

                        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>

                    <?php } elseif($status_pembayaran == 'lunas'){ ?>

                        <span class="badge bg-success">UKT LUNAS</span>

                    <?php } elseif($status_pembayaran == 'ditolak'){ ?>

                        <span class="badge bg-danger">Pembayaran Ditolak</span>

                    <?php } else { ?>

                        <span class="badge bg-secondary">Status Tidak Diketahui</span>

                    <?php } ?>

                </div>
            </div>

            <!-- FORM UPLOAD -->
            <div class="card shadow border-0">
                <div class="card-body p-4">

                    <?php if($belum_daftar){ ?>

                        <div class="alert alert-info">
                            Anda belum melakukan pendaftaran.
                        </div>

                    <?php } elseif($status_pendaftaran != 'diterima'){ ?>

                        <div class="alert alert-warning">
                            Pembayaran UKT hanya aktif setelah Anda <b>DITERIMA</b>.
                        </div>

                    <?php } else { ?>

                        <form method="post" enctype="multipart/form-data">

                            <label class="form-label fw-semibold">
                                Upload Bukti Pembayaran UKT
                            </label>

                            <input type="file" name="bukti" class="form-control mb-3" required>

                            <button type="submit" name="bayar" class="btn btn-success w-100">
                                Upload Bukti UKT
                            </button>

                        </form>

                    <?php } ?>

                </div>
            </div>

        </div>
    </div>

</div>

<?php include 'template/footer.php'; ?>