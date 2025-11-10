<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}
include '../backend/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../contern/css/sideMenu.css" />
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center"><i class="bi bi-person"></i> Pengguna</h4>
        <a href="daftar_pengguna.php" target="ContenFrame"><i class="bi bi-house-door-fill"></i>Home</a>
        <a href="profil.php" target="ContenFrame"><i class="bi bi-person-circle"></i>Profil</a>
        <a href="penbingbing.php" target="ContenFrame"><i class="bi bi-person-badge"></i>Tour Guide</a>
        <a href="../cara_daftar_haji.php" target="ContenFrame"><i class="bi bi-newspaper"></i>Gimana Cara Daftar Haji ?</a>
        <a href="berita/berita.php" target="ContenFrame"><i class="bi bi-newspaper"></i>Berita</a>
        <a href="status/index.php" target="ContenFrame"><i class="bi bi-calendar-check"></i>Status</a>
        
        <a href="../backend/query/logout.php" style="position: absolute; bottom: 30px; left: 25px; width: 200px;">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </a>
    </div>

    <div class="conten">
        <div class="">
        </div>
        <div class="content">
            <iframe src="daftar_pengguna.php" name="ContenFrame" frameborder="0"></iframe>
        </div>
    </div>
</body>

</html>
