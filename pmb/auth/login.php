<?php

session_start();
include '../config/koneksi.php';

$error = "";

if(isset($_POST['login'])){

    // FIX: $conn -> $koneksi (TIDAK MENGUBAH UI)
    $email = mysqli_real_escape_string(
        $koneksi,
        $_POST['email']
    );

    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi,"
        SELECT * FROM users
        WHERE email='$email'
        AND password='$password'
        LIMIT 1
    ");

    $data = mysqli_fetch_assoc($query);

    if($data){

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama']    = $data['nama'];
        $_SESSION['role']    = $data['role'];

        if($data['role'] == 'admin'){
            header("Location: ../admin/dashboard.php");
            exit;
        } else {
            header("Location: ../mahasiswa/dashboard.php");
            exit;
        }

    } else {

        $error = "
        <div class='alert alert-danger alert-dismissible fade show'>

            Email atau password salah

            <button type='button'
            class='btn-close'
            data-bs-dismiss='alert'>
            </button>

        </div>
        ";

    }

}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login PMB</title>

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
    rgba(0,0,0,0.55),
    rgba(0,0,0,0.55)
    ),

    url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1600');

    background-size:cover;
    background-position:center;

    min-height:100vh;

    display:flex;
    align-items:center;
    justify-content:center;
}

.login-card{

    border:none;

    border-radius:25px;

    overflow:hidden;

    box-shadow:0 10px 30px
    rgba(0,0,0,0.2);

}

.left-side{

    background:
    linear-gradient(
    135deg,
    #1e3c72,
    #2a5298
    );

    color:white;

    padding:50px;

    height:100%;
}

.left-side h2{

    font-weight:700;

}

.right-side{

    background:white;

    padding:50px;

}

.form-control{

    height:50px;

    border-radius:12px;

}

.btn-login{

    background:#2a5298;

    color:white;

    border-radius:12px;

    height:50px;

    font-weight:600;

}

.btn-login:hover{

    background:#1e3c72;
    color:white;

}

.logo-circle{

    width:80px;
    height:80px;

    border-radius:50%;

    background:white;

    color:#2a5298;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:35px;

    margin-bottom:20px;
}

.text-small{

    font-size:14px;
    color:#777;

}

</style>

</head>
<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-10">

<div class="card login-card">

<div class="row g-0">

<!-- LEFT -->
<div class="col-md-5 d-none d-md-block">

<div class="left-side d-flex flex-column justify-content-center h-100">

<div class="logo-circle">

<i class="bi bi-mortarboard-fill"></i>

</div>

<h2>
PMB Universitas
</h2>

<p class="mt-3">

Sistem Penerimaan Mahasiswa Baru Online.

Silakan login untuk melanjutkan proses pendaftaran.

</p>

<hr class="border-light">

<div class="mt-3">

<p>
✅ Pendaftaran Online
</p>

<p>
✅ Pengumuman Hasil
</p>

<p>
✅ Daftar Ulang
</p>

<p>
✅ Informasi OSPEK
</p>

</div>

</div>

</div>

<!-- RIGHT -->
<div class="col-md-7">

<div class="right-side">

<div class="text-center mb-4">

<h3 class="fw-bold">

Login Account

</h3>

<p class="text-small">

Masuk menggunakan akun PMB Anda

</p>

</div>

<?= $error; ?>

<form method="POST">

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

<button type="submit"
name="login"
class="btn btn-login w-100">

<i class="bi bi-box-arrow-in-right"></i>

Login Sekarang

</button>

</form>

<div class="text-center mt-4">

<p class="text-small">

Belum punya akun?

<a href="register.php"
class="text-decoration-none fw-semibold">

Daftar sekarang

</a>

</p>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>