<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembimbing Haji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../css/pembimbing.css" />
</head>
<body>
    <div class="header"><i class="bi bi-person-badge"></i> Data Pembimbing Haji</div>
    <a href="tambahPembimbing.php" class="floating-add-btn" title="Tambah Pembimbing">
        <i class="bi bi-plus-circle"></i>
    </a>
    <div class="container">
        <div class="row">
            <?php
            include '../../backend/database.php';
            $sql = "SELECT * FROM pembimbing_haji";
            $tampil = $conn->query($sql);
            while ($data = mysqli_fetch_assoc($tampil)) {
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-pembimbing">
                        <div class="card-body text-start">
                            <div class="text-center mb-3">
                                <img src="../../uploads/<?php echo $data['foto']; ?>" alt="Foto Pembimbing" class="foto-pembimbing">
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="card-icon"><i class="bi bi-person-fill"></i></span>
                                <span class="card-title"><?php echo $data['nama_lengkap']; ?></span>
                            </div>
                            <div class="card-text"><strong>NIK:</strong> <?php echo $data['nik']; ?></div>
                            <div class="card-text"><strong>Telepon:</strong> <a href="whatsapp://send?phone=<?php echo preg_replace('/[^0-9]/', '', $data['telepon']); ?>&text=Halo%20Pembimbing%20Haji%2C%20ini%20dari%20tim%20kami.%20Mohon%20konfirmasi%20kehadiran%20Anda%20dalam%20waktu%2024%20jam%20atau%20data%20akan%20dihapus%20dari%20sistem." title="Hubungi via WhatsApp"><?php echo $data['telepon']; ?> <i class="bi bi-whatsapp text-success"></i></a></div>
                            <div class="card-text"><strong>Email:</strong> <?php echo $data['email']; ?></div>
                            <div class="card-text"><strong>Alamat:</strong> <?php echo $data['alamat']; ?></div>
                            
                            <?php
                            // Hitung jumlah jamaah yang dibimbing
                            $id_pembimbing = $data['id'];
                            $sql_count_2026 = "SELECT COUNT(*) as total FROM jamaah_haji WHERE id_pembimbing = $id_pembimbing";
                            $result_2026 = $conn->query($sql_count_2026);
                            $count_2026 = $result_2026->fetch_assoc()['total'];

                            $sql_count_2027 = "SELECT COUNT(*) as total FROM jamaah_2027 WHERE id_pembimbing = $id_pembimbing";
                            $result_2027 = $conn->query($sql_count_2027);
                            $count_2027 = $result_2027->fetch_assoc()['total'];

                            $sql_count_2028 = "SELECT COUNT(*) as total FROM jamaah_2028 WHERE id_pembimbing = $id_pembimbing";
                            $result_2028 = $conn->query($sql_count_2028);
                            $count_2028 = $result_2028->fetch_assoc()['total'];

                            $sql_count_2029 = "SELECT COUNT(*) as total FROM jamaah_2029 WHERE id_pembimbing = $id_pembimbing";
                            $result_2029 = $conn->query($sql_count_2029);
                            $count_2029 = $result_2029->fetch_assoc()['total'];

                            $total_jamaah = $count_2026 + $count_2027 + $count_2028 + $count_2029;
                            ?>
                            <div class="card-text"><strong>Total Jamaah Dibimbing:</strong> <?php echo $total_jamaah; ?> orang</div>
                            <div class="card-text small">
                                <strong>Detail:</strong> 2026: <?php echo $count_2026; ?>, 2027: <?php echo $count_2027; ?>, 2028: <?php echo $count_2028; ?>, 2029: <?php echo $count_2029; ?>
                            </div>
                            <div class="card-text"><strong>Keterangan:</strong> <?php echo $data['keterangan']; ?></div>
                        </div>
                        <div class="card-footer">
                            <a href='editPembimbing.php?id=<?php echo $data['id']; ?>' class="edit-btn"><i class="bi bi-pencil"></i></a>
                            <a href='../../backend/query/hapusPembimbing.php?id=<?php echo $data['id']; ?>' class="hapus-btn"
                                onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</body>
</html>
