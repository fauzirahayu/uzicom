<?php
include __DIR__ . '/../../backend/database.php';

if (isset($_POST['simpan'])) {
    // Ambil pembimbing secara acak yang belum mencapai batas 20 jamaah
    $sqlPembimbing = "SELECT id FROM pembimbing_haji WHERE (SELECT COUNT(*) FROM jamaah_2029 WHERE id_pembimbing = pembimbing_haji.id) < 20 ORDER BY RAND() LIMIT 1";
    $resultPembimbing = $conn->query($sqlPembimbing);
    if ($resultPembimbing->num_rows > 0) {
        $rowPembimbing = $resultPembimbing->fetch_assoc();
        $id_pembimbing = $rowPembimbing['id'];
    } else {
        echo '<script>alert("Tidak ada pembimbing yang tersedia. Semua pembimbing sudah mencapai batas maksimal."); window.location.href = "../daftar_jamaah4.php";</script>';
        $conn->close();
        exit();
    }
    // Cek jumlah jamaah haji
    $result = $conn->query("SELECT COUNT(*) as total FROM jamaah_2029");
    $row = $result->fetch_assoc();
    if ($row['total'] >= 50) {
        echo '<script>alert("Jumlah jamaah haji sudah mencapai batas maksimal 50 orang."); window.location.href = "../jamaah2029.php";</script>';
        exit;
    }

    // ...existing code jamaah...
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $nik = $_POST['nik'] ?? '';

    // Periksa apakah NIK sudah ada di semua tabel jamaah
    $tables = ['jamaah_haji', 'jamaah_2027', 'jamaah_2028', 'jamaah_2029'];
    $totalNIK = 0;
    foreach ($tables as $table) {
        $cekNIK = $conn->prepare("SELECT COUNT(*) FROM $table WHERE nik = ?");
        $cekNIK->bind_param("s", $nik);
        $cekNIK->execute();
        $cekNIK->bind_result($nikCount);
        $cekNIK->fetch();
        $totalNIK += $nikCount;
        $cekNIK->close();
    }
    if ($totalNIK > 0) {
        echo '<script>alert("NIK sudah terdaftar di tahun lain. Silakan gunakan NIK yang berbeda."); window.location.href = "../daftar_jamaah4.php";</script>';
        $conn->close();
        exit();
    }

    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $no_paspor = $_POST['no_paspor'] ?? '';
    $golongan_darah = $_POST['golongan_darah'] ?? '';
    $penyakit_bawaan = $_POST['penyakit_bawaan'] ?? '';
    $jadwal_berangkat = $_POST['jadwal_berangkat'] ?? '';
    if (empty($jadwal_berangkat)) {
        $jadwal_berangkat = null;
    }
    $data_pulang = null;
    if (!empty($jadwal_berangkat)) {
        $date = new DateTime($jadwal_berangkat);
        $date->modify('+40 days');
        $data_pulang = $date->format('Y-m-d');
    }
    $status = $_POST['status'] ?? '';
    $name_file = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $name_file = basename($_FILES['foto']['name']);
        $temp_file = $_FILES['foto']['tmp_name'];
        $upload_dir = __DIR__ . "/../../uploads";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $name_file = time() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "", $name_file);
        if (!move_uploaded_file($temp_file, $upload_dir . '/' . $name_file)) {
            echo "Gagal upload file.";
            exit;
        }
    }
    $stmt = $conn->prepare("INSERT INTO jamaah_2029 (
        id_pembimbing, nama_lengkap, nik, jenis_kelamin, tanggal_lahir, alamat, telepon, no_paspor, golongan_darah, penyakit_bawaan, jadwal_berangkat, data_pulang, foto, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssssssss",
        $id_pembimbing, $nama_lengkap, $nik, $jenis_kelamin, $tanggal_lahir, $alamat, $telepon,
        $no_paspor, $golongan_darah, $penyakit_bawaan, $jadwal_berangkat, $data_pulang, $name_file, $status
    );
    if ($stmt->execute()) {
        header('Location: ../jamaah/jamaah4.php');
        exit;
    } else {
        echo 'Data gagal disimpan: ' . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
