<?php

include '../config/koneksi.php';

if(isset($_POST['register'])){

    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $password = md5($_POST['password']);

    /* ================= FIX: $conn -> $koneksi ================= */
    $cek = mysqli_query($koneksi,"
        SELECT * FROM users
        WHERE email='$email'
    ");

    if(mysqli_num_rows($cek) > 0){

        $error = "Email sudah digunakan!";

    }else{

        mysqli_query($koneksi,"
            INSERT INTO users
            (
                nama,
                email,
                password,
                role
            )
            VALUES
            (
                '$nama',
                '$email',
                '$password',
                'mahasiswa'
            )
        ");

        $success = "Registrasi berhasil!";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Register PMB</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{

    background:
    linear-gradient(
    135deg,
    #1e3c72,
    #2a5298
    );

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

}

.register-card{

    border:none;

    border-radius:25px;

    overflow:hidden;

    box-shadow:0 10px 30px
    rgba(0,0,0,0.2);

}

.left-side{

    background:
    linear-gradient(
    rgba(0,0,0,0.4),
    rgba(0,0,0,0.4)
    ),
    url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1200');

    background-size:cover;

    background-position:center;

    color:white;

    padding:50px;

    height:100%;

}

.right-side{

    padding:50px;

    background:white;

}

.form-control{

    height:50px;

    border-radius:12px;

}

.btn-register{

    height:50px;

    border-radius:12px;

    background:#2a5298;

    border:none;

    font-weight:600;

}

.btn-register:hover{

    background:#1e3c72;

}

.logo{

    font-size:60px;

}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-10">

<div class="card register-card">

<div class="row g-0">

<!-- LEFT -->

<div class="col-md-6 d-none d-md-block">

<div class="left-side d-flex flex-column justify-content-center h-100">

<div class="logo mb-4">

🎓

</div>

<h2 class="fw-bold">

PMB Universitas

</h2>

<p class="mt-3">

Sistem Penerimaan Mahasiswa Baru
Universitas Tahun Akademik 2026/2027.

</p>

<hr class="border-light">

<p>

✔ Registrasi Online  
<br>

✔ Upload Berkas  
<br>

✔ Seleksi PMB  
<br>

✔ Pengumuman Kelulusan

</p>

</div>

</div>

<!-- RIGHT -->

<div class="col-md-6">

<div class="right-side">

<h3 class="fw-bold mb-2">

Buat Akun

</h3>

<p class="text-muted mb-4">

Silakan registrasi untuk melanjutkan
pendaftaran PMB.

</p>

<!-- ALERT -->

<?php if(isset($error)){ ?>

<div class="alert alert-danger">

<?= $error; ?>

</div>

<?php } ?>

<?php if(isset($success)){ ?>

<div class="alert alert-success">

<?= $success; ?>

<br><br>

<a href="login.php"
class="btn btn-success btn-sm">

Login Sekarang

</a>

</div>

<?php } ?>

<!-- FORM -->

<form method="POST">

<div class="mb-3">

<label class="form-label">

Nama Lengkap

</label>

<div class="input-group">

<span class="input-group-text">

<i class="bi bi-person-fill"></i>

</span>

<input type="text"
name="nama"
class="form-control"
placeholder="Masukkan nama lengkap"
required>

</div>

</div>

<div class="mb-3">

<label class="form-label">

Email

</label>

<div class="input-group">

<span class="input-group-text">

<i class="bi bi-envelope-fill"></i>

</span>

<input type="email"
name="email"
class="form-control"
placeholder="Masukkan email"
required>

</div>

</div>

<div class="mb-4">

<label class="form-label">

Password

</label>

<div class="input-group">

<span class="input-group-text">

<i class="bi bi-lock-fill"></i>

</span>

<input type="password"
name="password"
class="form-control"
placeholder="Masukkan password"
required>

</div>

</div>

<button name="register"
class="btn btn-register text-white w-100">

<i class="bi bi-person-plus-fill"></i>

Register

</button>

</form>

<!-- LOGIN -->

<div class="text-center mt-4">

Sudah punya akun?

<a href="login.php"
class="text-decoration-none fw-semibold">

Login

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>
