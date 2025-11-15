<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembimbing Haji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../contern/css/pembimbing.css" />
</head>
<body>
    <div class="header"><i class="bi bi-person-badge"></i> Data Pembimbing Haji</div>
    <div class="container">
        <div class="row">
            <?php
            include '../backend/database.php';
            $sql = "SELECT * FROM pembimbing_haji";
            $tampil = $conn->query($sql);
            while ($data = mysqli_fetch_assoc($tampil)) {
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-pembimbing">
                        <div class="card-body text-start">
                            <div class="text-center mb-3">
                                <img src="../uploads/<?php echo htmlspecialchars($data['foto'] ?? ''); ?>" alt="Foto Pembimbing" class="foto-pembimbing">
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="card-icon"><i class="bi bi-person-fill"></i></span>
                                <span class="card-title"><?php echo htmlspecialchars($data['nama_lengkap'] ?? ''); ?></span>
                            </div>
                            <div class="card-text"><strong>Telepon:</strong> <?php echo htmlspecialchars($data['telepon'] ?? '' ); ?></div>
                            <div class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($data['email'] ?? ''); ?></div>
                            <div class="card-text"><strong>Alamat:</strong> <?php echo htmlspecialchars($data['alamat'] ?? ''); ?></div>
                            <div class="card-text"><strong>Keterangan:</strong> <?php echo htmlspecialchars($data['keterangan'] ?? ''); ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
