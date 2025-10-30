<?php
include __DIR__ . '/../../backend/query/read.php';

// Hitung jumlah jamaah per tahun
$jumlah2026 = $conn->query("SELECT COUNT(*) as jml FROM jamaah_haji WHERE YEAR(jadwal_berangkat) = 2026")->fetch_assoc()['jml'];
$jumlah2027 = $conn->query("SELECT COUNT(*) as jml FROM jamaah_haji WHERE YEAR(jadwal_berangkat) = 2027")->fetch_assoc()['jml'];
$jumlah2028 = $conn->query("SELECT COUNT(*) as jml FROM jamaah_haji WHERE YEAR(jadwal_berangkat) = 2028")->fetch_assoc()['jml'];
$jumlah2029 = $conn->query("SELECT COUNT(*) as jml FROM jamaah_haji WHERE YEAR(jadwal_berangkat) = 2029")->fetch_assoc()['jml'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Jamaah Haji</title>
    <link rel="stylesheet" href="../../jamaahHaji/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../dasboard/index.css" />
    <style>

    </style>
</head>

<body>
    <div class="conten">
        <span style="font-size:2rem; color:#226d3d;"><i class="bi bi-moon-stars"></i></span>
        <h2>Laporan Jamaah Haji</h2>
        <p>Rekap jumlah jamaah per tahun keberangkatan:</p>
        <div class="d-flex justify-content-center flex-wrap">
            <a href="?tahun=2026" style="text-decoration:none; color:inherit;" class="stat-card">
                <i class="bi bi-people-fill"></i>
                <h5>Jamaah 2026</h5>
                <p><?= $jumlah2026 ?> orang</p>
            </a>
            <a href="?tahun=2027" style="text-decoration:none; color:inherit;" class="stat-card">
                <i class="bi bi-people-fill"></i>
                <h5>Jamaah 2027</h5>
                <p><?= $jumlah2027 ?> orang</p>
            </a>
            <a href="?tahun=2028" style="text-decoration:none; color:inherit;" class="stat-card">
                <i class="bi bi-people-fill"></i>
                <h5>Jamaah 2028</h5>
                <p><?= $jumlah2028 ?> orang</p>
            </a>
            <a href="?tahun=2029" style="text-decoration:none; color:inherit;" class="stat-card">
                <i class="bi bi-people-fill"></i>
                <h5>Jamaah 2029</h5>
                <p><?= $jumlah2029 ?> orang</p>
            </a>
        </div>
        <?php
        if (isset($_GET['tahun'])) {
            $tahun = intval($_GET['tahun']);
            echo "<hr><h4>Detail Jamaah Tahun $tahun</h4>";
            $q = $conn->query("SELECT * FROM jamaah_haji WHERE YEAR(jadwal_berangkat) = $tahun");
            echo '<div class="row">';
            while ($row = $q->fetch_assoc()) {
                echo '<div class="col-md-4 mb-3">';
                echo '<div class="card card-jamaah" onclick="window.location.href=\'detailJamaah.php?id=' . $row['id'] . '\'">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title"><i class="bi bi-person-circle"></i> ' . htmlspecialchars($row['nama_lengkap']) . '</h5>';
                echo '<p class="card-text mb-1"><strong>Alamat:</strong> ' . htmlspecialchars($row['alamat']) . '</p>';
                echo '<p class="card-text mb-1"><strong>Telepon:</strong> ' . htmlspecialchars($row['telepon']) . '</p>';
                echo '<p class="card-text"><strong>Status:</strong> ' . htmlspecialchars($row['status']) . '</p>';
                echo '</div></div></div>';
            }
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
