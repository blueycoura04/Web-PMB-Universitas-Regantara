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

/* ===================== SIMPAN DATA ===================== */
if(isset($_POST['submit'])){

    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $nisn = $_POST['nisn'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $jurusan_sekolah = $_POST['jurusan_sekolah'];
    $tahun_lulus = $_POST['tahun_lulus'];
    $nama_ayah = $_POST['nama_ayah'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $penghasilan_ortu = $_POST['penghasilan_ortu'];
    $fakultas = $_POST['fakultas'];
    $jurusan = $_POST['jurusan'];

    /* ===================== CEK DATA ===================== */
    if($data){

        mysqli_query($koneksi,"
            UPDATE pendaftaran SET
            nama_lengkap='$nama_lengkap',
            nik='$nik',
            nisn='$nisn',
            tempat_lahir='$tempat_lahir',
            tanggal_lahir='$tanggal_lahir',
            jenis_kelamin='$jenis_kelamin',
            agama='$agama',
            email='$email',
            no_hp='$no_hp',
            alamat='$alamat',
            asal_sekolah='$asal_sekolah',
            jurusan_sekolah='$jurusan_sekolah',
            tahun_lulus='$tahun_lulus',
            nama_ayah='$nama_ayah',
            pekerjaan_ayah='$pekerjaan_ayah',
            nama_ibu='$nama_ibu',
            pekerjaan_ibu='$pekerjaan_ibu',
            penghasilan_ortu='$penghasilan_ortu',
            fakultas='$fakultas',
            jurusan='$jurusan'
            WHERE id_user='$id_user'
        ");

    } else {

        /* 🔥 GENERATE NOMOR PENDAFTARAN */
        $no_pendaftaran = "PMB" . date("Y") . str_pad($id_user, 5, "0", STR_PAD_LEFT);

        mysqli_query($koneksi,"
            INSERT INTO pendaftaran (
                id_user,no_pendaftaran,nama_lengkap,nik,nisn,tempat_lahir,tanggal_lahir,
                jenis_kelamin,agama,email,no_hp,alamat,
                asal_sekolah,jurusan_sekolah,tahun_lulus,
                nama_ayah,pekerjaan_ayah,nama_ibu,pekerjaan_ibu,
                penghasilan_ortu,fakultas,jurusan,status
            ) VALUES (
                '$id_user','$no_pendaftaran','$nama_lengkap','$nik','$nisn','$tempat_lahir','$tanggal_lahir',
                '$jenis_kelamin','$agama','$email','$no_hp','$alamat',
                '$asal_sekolah','$jurusan_sekolah','$tahun_lulus',
                '$nama_ayah','$pekerjaan_ayah','$nama_ibu','$pekerjaan_ibu',
                '$penghasilan_ortu','$fakultas','$jurusan','pending'
            )
        ");
    }

    echo "<script>alert('Formulir berhasil disimpan');window.location='dashboard.php';</script>";
}

include 'template/header.php';
include 'template/navbar.php';

?>

<!-- ========================= CONTENT (TIDAK DIUBAH) ========================= -->
<div class="container py-4">

    <div class="mb-4">
        <h3 class="fw-bold">Formulir PMB Universitas</h3>
        <p class="text-muted">Lengkapi data pendaftaran dengan benar</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form method="post">

                <!-- DATA PRIBADI -->
                <h5 class="fw-bold text-primary mb-3">Data Pribadi</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control"
                        value="<?= $data['nama_lengkap'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control"
                        value="<?= $data['nik'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">NISN</label>
                        <input type="text" name="nisn" class="form-control"
                        value="<?= $data['nisn'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control"
                        value="<?= $data['tempat_lahir'] ?? '' ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                        value="<?= $data['tanggal_lahir'] ?? '' ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Agama</label>
                        <input type="text" name="agama" class="form-control"
                        value="<?= $data['agama'] ?? '' ?>">
                    </div>

                </div>

                <hr>

                <!-- KONTAK -->
                <h5 class="fw-bold text-success mb-3">Kontak</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                        value="<?= $data['email'] ?? '' ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp" class="form-control"
                        value="<?= $data['no_hp'] ?? '' ?>">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control"><?= $data['alamat'] ?? '' ?></textarea>
                    </div>

                </div>

                <hr>

                <!-- SEKOLAH -->
                <h5 class="fw-bold text-warning mb-3">Data Sekolah</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" class="form-control"
                        value="<?= $data['asal_sekolah'] ?? '' ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jurusan Sekolah</label>
                        <input type="text" name="jurusan_sekolah" class="form-control"
                        value="<?= $data['jurusan_sekolah'] ?? '' ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun Lulus</label>
                        <input type="number" name="tahun_lulus" class="form-control"
                        value="<?= $data['tahun_lulus'] ?? '' ?>">
                    </div>

                </div>

                <hr>

                <!-- ORANG TUA -->
                <h5 class="fw-bold text-danger mb-3">Data Orang Tua</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control"
                        value="<?= $data['nama_ayah'] ?? '' ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" class="form-control"
                        value="<?= $data['pekerjaan_ayah'] ?? '' ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control"
                        value="<?= $data['nama_ibu'] ?? '' ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" class="form-control"
                        value="<?= $data['pekerjaan_ibu'] ?? '' ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Penghasilan Orang Tua</label>
                        <input type="text" name="penghasilan_ortu" class="form-control"
                        value="<?= $data['penghasilan_ortu'] ?? '' ?>">
                    </div>

                </div>

                <hr>

                <!-- PILIHAN -->
                <h5 class="fw-bold text-primary mb-3">Pilihan Program Studi</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fakultas</label>
                        <input type="text" name="fakultas" class="form-control"
                        value="<?= $data['fakultas'] ?? '' ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control"
                        value="<?= $data['jurusan'] ?? '' ?>">
                    </div>

                </div>

                <button class="btn btn-primary w-100 mt-3" name="submit">
                    Simpan Formulir
                </button>

            </form>

        </div>
    </div>

</div>

<?php include 'template/footer.php'; ?>