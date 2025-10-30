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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Jamaah Haji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../css/jamaah.css" />
    <style>

    </style>
</head>

<body>
    <div class="header"><i class="bi bi-building"></i>Data Jamaah Haji</div>
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

        <a href="tambahjamaah2027.php" class="floating-add-btn" title="Tambah Data Jamaah">
            <i class="bi bi-plus-circle"></i>
        </a>
        <div class="row">
            <?php
            include '../../backend/query/read.php';
            $no = 1;
            $filter = '';
            if (isset($_GET['cari']) && $_GET['cari'] != '') {
                $cari = $conn->real_escape_string($_GET['cari']);
                $filter = " WHERE nama_lengkap LIKE '%$cari%' OR nik LIKE '%$cari%'";
            }
            $sql = "SELECT j.*, p.nama_lengkap AS nama_pembimbing FROM jamaah_2027 j LEFT JOIN pembimbing_haji p ON j.id_pembimbing = p.id" . $filter;
            $tampil = $conn->query($sql);
            while ($data = mysqli_fetch_assoc($tampil)) {
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-jamaah">
                        <div class="card-body text-start">
                            <div class="text-center mb-3">
                                <img src="../../uploads/<?php echo $data['foto']; ?>" alt="Foto Jamaah" class="foto-jamaah">
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="card-icon"><i class="bi bi-person-fill"></i></span>
                                <span class="card-title"><?php echo $data['nama_lengkap']; ?></span>
                            </div>
                            <div class="card-text"><strong>NIK:</strong> <?php echo $data['nik']; ?></div>
                            <div class="card-text"><strong>No Porsi:</strong> <?php echo $data['no_porsi']; ?></div>
                            <div class="card-text"><strong>Jenis Kelamin:</strong> <?php echo $data['jenis_kelamin']; ?></div>
                            <div class="card-text"><strong>Tanggal Lahir:</strong> <?php echo $data['tanggal_lahir']; ?></div>
                            <div class="card-text"><strong>Alamat:</strong> <?php echo $data['alamat']; ?></div>
                            <div class="card-text"><strong>Telepon:</strong> <a href="javascript:void(0)" onclick="sendWhatsAppWithPDF('<?php echo preg_replace('/[^0-9]/', '', $data['telepon']); ?>', '<?php echo addslashes($data['nama_lengkap']); ?>', '<?php echo $data['id']; ?>', '2027')" title="Kirim PDF via WhatsApp"><?php echo $data['telepon']; ?> <i class="bi bi-whatsapp text-success"></i></a></div>
                            <div class="card-text"><strong>No Paspor:</strong> <?php echo $data['no_paspor']; ?></div>
                            <div class="card-text"><strong>Golongan Darah:</strong> <?php echo $data['golongan_darah']; ?></div>
                            <div class="card-text"><strong>Penyakit Bawaan:</strong> <?php echo $data['penyakit_bawaan']; ?></div>
                            <div class="card-text"><strong>Jadwal Berangkat:</strong> <?php echo $data['jadwal_berangkat']; ?></div>
                            <div class="card-text"><strong>Tanggal Pulang:</strong> <?php echo $data['data_pulang']; ?></div>
                            <div class="card-text"><strong>Pembimbing:</strong> <?php echo isset($data['nama_pembimbing']) && $data['nama_pembimbing'] ? htmlspecialchars($data['nama_pembimbing']) : '-'; ?></div>
                            <div class="card-text"><strong>Status:</strong> <?php echo $data['status']; ?></div>
                        </div>
                        <div class="card-footer">
                            <a href='editJamaah2027.php?id=<?php echo $data['id']; ?>' class="edit-btn"><i class="bi bi-pencil"></i></a>
                            <a href='../../backend/query/hapus2027.php?id=<?php echo $data['id']; ?>' class="hapus-btn"
                                onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>
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