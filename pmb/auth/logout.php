<?php

session_start();

/* HAPUS SEMUA SESSION */
$_SESSION = [];

/* HAPUS SESSION DI SERVER */
session_destroy();

/* OPTIONAL: HAPUS COOKIE SESSION (lebih bersih) */
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

/* REDIRECT KE HALAMAN UTAMA */
header("Location: ../index.php");
exit;

?>