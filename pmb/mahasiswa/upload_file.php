<?php
include '../config/session.php';
include '../config/koneksi.php';

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$folder = "uploads/";

if(!is_dir($folder)){
    mkdir($folder, 0777, true);
}

/* ================= FUNCTION UPLOAD ================= */
function uploadFile($name,$prefix,$id_user,$folder){

    if(!isset($_FILES[$name]) || $_FILES[$name]['error'] != 0){
        return null;
    }

    $ext = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
    $filename = $prefix."_".$id_user."_".time().".".$ext;

    if(move_uploaded_file($_FILES[$name]['tmp_name'], $folder.$filename)){
        return $filename;
    }

    return null;
}

/* ================= AMBIL DATA ================= */
$q = mysqli_query($koneksi,"SELECT * FROM pendaftaran WHERE id_user='$id_user'");
$data = mysqli_fetch_assoc($q);

/* ================= PROSES UPLOAD ================= */
if(isset($_POST['upload'])){

    $foto   = uploadFile('foto','foto',$id_user,$folder);
    $ijazah = uploadFile('ijazah','ijazah',$id_user,$folder);
    $rapor  = uploadFile('rapor','rapor',$id_user,$folder);

    $old = mysqli_fetch_assoc(
        mysqli_query($koneksi,"SELECT foto, ijazah, rapor FROM pendaftaran WHERE id_user='$id_user'")
    );

    $fotoFinal   = $foto   ?: ($old['foto'] ?? '');
    $ijazahFinal = $ijazah ?: ($old['ijazah'] ?? '');
    $raporFinal  = $rapor  ?: ($old['rapor'] ?? '');

    $status = (!empty($fotoFinal) && !empty($ijazahFinal) && !empty($raporFinal))
        ? 'upload_lengkap'
        : 'upload';

    if($data){

        $query = "
        UPDATE pendaftaran SET
            foto='$fotoFinal',
            ijazah='$ijazahFinal',
            rapor='$raporFinal',
            status='$status'
        WHERE id_user='$id_user'
        ";

    } else {

        $query = "
        INSERT INTO pendaftaran
        (id_user, foto, ijazah, rapor, status)
        VALUES
        ('$id_user','$fotoFinal','$ijazahFinal','$raporFinal','$status')
        ";
    }

    if(mysqli_query($koneksi,$query)){
        echo "<script>alert('Upload sukses');window.location='dashboard.php';</script>";
        exit;
    } else {
        die("DB ERROR: ".mysqli_error($koneksi));
    }
}

include 'template/header.php';
include 'template/navbar.php';
?>

<!-- ================= FIX BOOTSTRAP (WAJIB JIKA HEADER KAMU TIDAK ADA) ================= -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- ================= BOOTSTRAP UI ================= -->
<div class="container py-5">

    <!-- HEADER -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">Upload Berkas PMB</h2>
        <p class="text-muted">
            Silakan unggah dokumen sesuai ketentuan kampus
        </p>
    </div>

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <!-- CARD FORM -->
            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-4">

                    <form method="post" enctype="multipart/form-data">

                        <!-- FOTO -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                📸 Foto Diri
                            </label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>

                        <!-- IJAZAH -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                📄 Ijazah
                            </label>
                            <input type="file" name="ijazah" class="form-control">
                        </div>

                        <!-- RAPOR -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                📘 Rapor
                            </label>
                            <input type="file" name="rapor" class="form-control">
                        </div>

                        <!-- INFO -->
                        <div class="alert alert-info small">
                            Pastikan file jelas, tidak blur, dan sesuai ketentuan PMB.
                        </div>

                        <!-- BUTTON -->
                        <button class="btn btn-primary w-100 py-2 fw-semibold rounded-3" name="upload">
                            Upload Berkas
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'template/footer.php'; ?>