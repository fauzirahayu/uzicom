<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jamaah_haji/backend/database.php';
if (!isset($_GET['id'])) {
    echo '<div class="container mt-4"><div class="alert alert-danger">ID Jamaah tidak ditemukan.</div></div>';
    exit;
}
$id = intval($_GET['id']);
$query = $conn->query("SELECT * FROM jamaah_haji WHERE id = $id");
$row = $query->fetch_assoc();
if (!$row) {
    echo '<div class="container mt-4"><div class="alert alert-warning">Data Jamaah tidak ditemukan.</div></div>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jamaah Haji</title>
    <link rel="stylesheet" href="../../jamaahHaji/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <style>
        .detail-card {
            max-width: 500px;
            margin: 2rem auto;
            box-shadow: 0 2px 12px #226d3d22;
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card detail-card">
            <div class="card-body">
                <h3 class="card-title mb-3"><i class="bi bi-person-circle"></i> <?= !empty($row['nama']) ? htmlspecialchars($row['nama']) : '<span class="text-danger">(Nama tidak tersedia)</span>' ?> </h3>
                <p><strong>Alamat:</strong> <?= isset($row['alamat']) ? htmlspecialchars($row['alamat']) : '<span class="text-danger">(Alamat tidak tersedia)</span>' ?></p>
                <p><strong>Telepon:</strong> <a href="javascript:void(0)" onclick="sendWhatsAppWithPDF('<?= preg_replace('/[^0-9]/', '', $row['telepon'] ?? '') ?>', '<?= addslashes($row['nama'] ?? '') ?>', '<?= $id ?>', '<?= date('Y', strtotime($row['jadwal_berangkat'] ?? '')) ?>')" title="Kirim PDF via WhatsApp"><?= isset($row['telepon']) ? htmlspecialchars($row['telepon']) : '<span class="text-danger">(Telepon tidak tersedia)</span>' ?> <i class="bi bi-whatsapp text-success"></i></a></p>
                <p><strong>Status:</strong> <?= isset($row['status']) ? htmlspecialchars($row['status']) : '<span class="text-danger">(Status tidak tersedia)</span>' ?></p>
                <p><strong>Jadwal Berangkat:</strong> <?= isset($row['jadwal_berangkat']) ? htmlspecialchars($row['jadwal_berangkat']) : '<span class="text-danger">(Jadwal tidak tersedia)</span>' ?></p>
                <a href="laporan.php?tahun=<?= isset($row['jadwal_berangkat']) ? date('Y', strtotime($row['jadwal_berangkat'])) : '' ?>" class="btn btn-success mt-3"><i class="bi bi-arrow-left"></i> Kembali ke Laporan</a>
            </div>
        </div>
  </div>
    <script>
        function sendWhatsAppWithPDF(phone, name, id, year) {
            // Download PDF terlebih dahulu
            var link = document.createElement('a');
            link.href = '../../backend/query/generateBuktiBooking.php?id=' + id + '&tahun=' + year;
            link.download = 'bukti_booking_haji_' + name.toLowerCase().replace(/\s+/g, '_') + '_' + year + '.pdf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Setelah download, buka WhatsApp dengan pesan konfirmasi
            setTimeout(function() {
                var message = 'Halo ' + name + ', selamat Anda telah terdaftar di web kami yang bekerja sama dengan Kemenag. Untuk melihat data Anda, silakan kunjungi web kami di: https://jamaah-haji.local';
                var whatsappUrl = 'https://wa.me/' + phone + '?text=' + encodeURIComponent(message);
                window.open(whatsappUrl, '_blank');
            }, 1000); // Delay 1 detik untuk memastikan download selesai
        }
    </script>
</body>
</html>
