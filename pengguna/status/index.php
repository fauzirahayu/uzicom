<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}

include '../../backend/database.php';

// Ambil NIK pengguna dari session
$user_id = $_SESSION['id'];
$sql_user = "SELECT nik FROM pengguna WHERE id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows == 0) {
    echo "Data pengguna tidak ditemukan.";
    exit();
}

$user = $result_user->fetch_assoc();
$nik = $user['nik'];
$stmt_user->close();

// Cari data jamaah berdasarkan NIK di semua tabel
$tables = ['jamaah_haji', 'jamaah_2027', 'jamaah_2028', 'jamaah_2029'];
$jamaah_data = null;
$tahun_ditemukan = null;

foreach ($tables as $table) {
    $sql_jamaah = "SELECT *, '$table' as table_name FROM $table WHERE nik = ?";
    $stmt_jamaah = $conn->prepare($sql_jamaah);
    $stmt_jamaah->bind_param("s", $nik);
    $stmt_jamaah->execute();
    $result_jamaah = $stmt_jamaah->get_result();

    if ($result_jamaah->num_rows > 0) {
        $jamaah_data = $result_jamaah->fetch_assoc();
        $tahun_ditemukan = str_replace('jamaah_', '', $table);
        if ($tahun_ditemukan == 'haji') {
            $tahun_ditemukan = '2026';
        }
        $stmt_jamaah->close();
        break;
    }
    $stmt_jamaah->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran Haji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .status-container { max-width: 800px; margin: 50px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        .status-header { text-align: center; margin-bottom: 30px; }
        .status-card { border: none; border-radius: 10px; margin-bottom: 20px; }
        .status-icon { font-size: 3rem; margin-bottom: 15px; }
        .btn-custom { background-color: #226d3d; border-color: #226d3d; }
        .btn-custom:hover { background-color: #1a5a32; border-color: #1a5a32; }
    </style>
</head>
<body>
    <div class="container">
        <div class="status-container">
            <div class="status-header">
                <h2><i class="bi bi-calendar-check text-success"></i> Status Pendaftaran Haji</h2>
                <p class="text-muted">Informasi status pendaftaran Anda</p>
            </div>

            <?php if ($jamaah_data): ?>
                <div class="card status-card">
                    <div class="card-body text-center">
                        <div class="status-icon text-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h4 class="card-title text-success">Pendaftaran Berhasil</h4>
                        <p class="card-text">Selamat! Anda telah terdaftar sebagai Jamaah Haji tahun <?php echo $tahun_ditemukan; ?>.</p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <strong>Nama:</strong> <?php echo htmlspecialchars($jamaah_data['nama_lengkap']); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>NIK:</strong> <?php echo htmlspecialchars($jamaah_data['nik']); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>No Porsi:</strong> <?php echo htmlspecialchars($jamaah_data['no_porsi']); ?>
                            </div>
                            <div class="col-md-6">
                                <strong>Status:</strong> <?php echo htmlspecialchars($jamaah_data['status'] ?? 'Aktif'); ?>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="../../backend/query/generateBuktiBooking.php?id=<?php echo $jamaah_data['id']; ?>&tahun=<?php echo $tahun_ditemukan; ?>" class="btn btn-custom btn-lg" target="_blank">
                                <i class="bi bi-download"></i> Download Bukti Booking
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="card status-card">
                    <div class="card-body text-center">
                        <div class="status-icon text-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <h4 class="card-title text-warning">Belum Terdaftar</h4>
                        <p class="card-text">Anda belum terdaftar sebagai Jamaah Haji. Silakan hubungi admin untuk informasi lebih lanjut.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
