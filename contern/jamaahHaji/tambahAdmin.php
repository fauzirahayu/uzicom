<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../css/tambahAdmin.css" />
    <style>

    </style>
</head>
<body>
    <div class="card-form">
        <h3 class="form-title"><i class="bi bi-person-badge"></i> Tambah Admin</h3>
        <form action="../../backend/query/prosesAddAdmin.php" method="POST">
            <div class="mb-3">
                <label for="namaAdmin" class="form-label">Nama</label>
                <input type="text" class="form-control" id="namaAdmin" name="namaAdmin" required />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <button type="submit" class="btn btn-primary w-100" name="tambah">
                <i class="bi bi-check-circle"></i> Tambah Admin
            </button>
        </form>
    </div>
</body>
</html>
