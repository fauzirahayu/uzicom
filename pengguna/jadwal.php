  <?php
include __DIR__ . '/../backend/query/read.php';

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Jamaah Haji</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../contern/dasboard/index.css" />
  <style>

  </style>
</head>

<body>
  <div class="conten">
    <span style="font-size:2rem; color:#226d3d;"><i class="bi bi-moon-stars"></i></span>
    <h2>Jamaah Haji</h2>
    <p>Halo selamat datang di informasi Jamaah Haji!
    </p>
    <div class="d-flex justify-content-center flex-wrap">
      <a href="jamaah/jamaah.php" style="text-decoration:none; color:inherit;" class="stat-card">
        <i class="bi bi-people-fill"></i>
        <h5>Jamaah 2026</h5>
        <p><?= $jumlahJamaah ?> - 50 orang</p>
      </a>
      <a href="jamaah/jamaah2.php" style="text-decoration:none; color:inherit;" class="stat-card">
        <i class="bi bi-people-fill"></i>
        <h5>Jamaah 2027</h5>
        <p><?= $jumlahJamaah2027 ?> - 70 orang</p>
      </a>
      <a href="jamaah/jamaah3.php" style="text-decoration:none; color:inherit;" class="stat-card">
        <i class="bi bi-people-fill"></i>
        <h5>Jamaah 2028</h5>
        <p><?= $jumlahJamaah2028 ?> - 30 orang</p>
      </a>
      <a href="jamaah/jamaah4.php" style="text-decoration:none; color:inherit;" class="stat-card">
        <i class="bi bi-people-fill"></i>
        <h5>Jamaah 2029</h5>
        <p><?= $jumlahJamaah2029 ?> - 80 orang</p>
      </a>
    </div>
  </div>
</body>
</html>
