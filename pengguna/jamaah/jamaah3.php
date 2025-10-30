<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Jamaah Haji 2028</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../../contern/css/jamaah.css" />
    <style>

    </style>
</head>

<body>
    <div class="header"><i class="bi bi-building"></i>Data Jamaah Haji 2028</div>
    <div class="container">
        <div class="actions mb-4">
            <form method="GET" class="d-flex position-relative" action="" onsubmit="showLoading()">
                <input type="text" class="form-control me-2" name="cari" placeholder="Cari nama/NIK jamaah..." value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
                <button type="submit" class="btn btn-success"><i class="bi bi-search"></i> Cari</button>
                <div id="loading-spinner">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="mt-2 text-success">Mencari data...</div>
                </div>
            </form>
        </div>


        <div class="row">
            <?php
            include '../../backend/query/read.php';
            $no = 1;
            $filter = '';
            if (isset($_GET['cari']) && $_GET['cari'] != '') {
                $cari = $conn->real_escape_string($_GET['cari']);
                $filter = " WHERE j.nama_lengkap LIKE '%$cari%' OR j.nik LIKE '%$cari%'";
            }
            $sql = "SELECT j.*, p.nama_lengkap AS nama_pembimbing FROM jamaah_2028 j LEFT JOIN pembimbing_haji p ON j.id_pembimbing = p.id" . $filter;
            $tampil = $conn->query($sql);
            while ($data = mysqli_fetch_assoc($tampil)) {
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-jamaah">
                        <div class="card-body text-start">
                            <div class="text-center mb-3">
                                <img src="../uploads/<?php echo htmlspecialchars($data['foto'] ?? ''); ?>" alt="Foto Jamaah" class="foto-jamaah">
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="card-icon"><i class="bi bi-person-fill"></i></span>
                                <span class="card-title"><?php echo htmlspecialchars($data['nama_lengkap'] ?? ''); ?></span>
                            </div>
                            <div class="card-text"><strong>NIK:</strong> <?php echo htmlspecialchars(substr($data['nik'] ?? '', 0, 1) . str_repeat('*', strlen($data['nik'] ?? '') - 2) . substr($data['nik'] ?? '', -1)); ?></div>
                            <div class="card-text"><strong>No Porsi:</strong> <?php echo isset($data['no_porsi']) && $data['no_porsi'] ? htmlspecialchars($data['no_porsi']) : '-'; ?></div>
                            <div class="card-text"><strong>Jenis Kelamin:</strong> <?php echo htmlspecialchars($data['jenis_kelamin'] ?? ''); ?></div>
                            <div class="card-text"><strong>Tanggal Lahir:</strong> <?php echo htmlspecialchars($data['tanggal_lahir'] ?? ''); ?></div>
                            <div class="card-text"><strong>Alamat:</strong> <?php echo htmlspecialchars($data['alamat'] ?? ''); ?></div>
                            <div class="card-text"><strong>Telepon:</strong> <?php echo htmlspecialchars(substr($data['telepon'] ?? '', 0, 1) . str_repeat('*', strlen($data['telepon'] ?? '') - 2) . substr($data['telepon'] ?? '', -1)); ?></div>
                            <div class="card-text"><strong>No Paspor:</strong> <?php echo htmlspecialchars($data['no_paspor'] ?? ''); ?></div>
                            <div class="card-text"><strong>Golongan Darah:</strong> <?php echo htmlspecialchars($data['golongan_darah'] ?? ''); ?></div>
                            <div class="card-text"><strong>Penyakit Bawaan:</strong> <?php echo htmlspecialchars($data['penyakit_bawaan'] ?? ''); ?></div>
                            <div class="card-text"><strong>Jadwal Berangkat:</strong> <?php echo htmlspecialchars($data['jadwal_berangkat'] ?? ''); ?></div>
                            <div class="card-text"><strong>Tanggal Pulang:</strong> <?php echo htmlspecialchars($data['data_pulang'] ?? ''); ?></div>
                            <div class="card-text"><strong>Pembimbing:</strong> <?php echo isset($data['nama_pembimbing']) && $data['nama_pembimbing'] ? htmlspecialchars($data['nama_pembimbing']) : '-'; ?></div>
                            <div class="card-text"><strong>Status:</strong> <?php echo htmlspecialchars($data['status'] ?? ''); ?></div>
                        </div>
                    </div>
                </div>
            <?php
                $no++;
            }
            ?>
        </div>

    </div>
    <script>
        function showLoading() {
            var spinner = document.getElementById('loading-spinner');
            spinner.classList.add('active');
        }
        window.onload = function() {
            var spinner = document.getElementById('loading-spinner');
            spinner.classList.remove('active');
        }
    </script>
</body>

</html>
