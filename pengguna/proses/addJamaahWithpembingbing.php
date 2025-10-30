<?php
include __DIR__ . '/../../backend/database.php';

if (isset($_POST['simpan'])) {
    // Ambil pembimbing secara acak yang belum mencapai batas 20 jamaah
    $sqlPembimbing = "SELECT id FROM pembimbing_haji WHERE (SELECT COUNT(*) FROM jamaah_haji WHERE id_pembimbing = pembimbing_haji.id) < 20 ORDER BY RAND() LIMIT 1";
    $resultPembimbing = $conn->query($sqlPembimbing);
    if ($resultPembimbing->num_rows > 0) {
        $rowPembimbing = $resultPembimbing->fetch_assoc();
        $id_pembimbing = $rowPembimbing['id'];
    } else {
        echo '<script>alert("Tidak ada pembimbing yang tersedia. Semua pembimbing sudah mencapai batas maksimal."); window.location.href = "../daftar_jamaah.php";</script>';
        $conn->close();
        exit();
    }
    // Cek jumlah jamaah haji
    $result = $conn->query("SELECT COUNT(*) as total FROM jamaah_haji");
    $row = $result->fetch_assoc();
    if ($row['total'] >= 50) {
        echo '<script>alert("Jumlah jamaah haji sudah mencapai batas maksimal 50 orang."); window.location.href = "../jamaah2026.php";</script>';
        exit;
    }

    // Sanitize input data
    $nama_lengkap = htmlspecialchars(trim($_POST['nama_lengkap'] ?? ''));
    $nik = htmlspecialchars(trim($_POST['nik'] ?? ''));
    $no_porsi = htmlspecialchars(trim($_POST['no_porsi'] ?? ''));

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
        echo '<script>alert("NIK sudah terdaftar di tahun lain. Silakan gunakan NIK yang berbeda."); window.location.href = "../daftar_jamaah.php";</script>';
        $conn->close();
        exit();
    }

    // Periksa apakah No Porsi sama dengan NIK
    if ($no_porsi == $nik) {
        echo '<script>alert("No Porsi tidak boleh sama dengan NIK. Silakan gunakan No Porsi yang berbeda."); window.location.href = "../daftar_jamaah.php";</script>';
        $conn->close();
        exit();
    }

    // Periksa apakah No Porsi sudah ada di semua tabel jamaah
    $totalNoPorsi = 0;
    foreach ($tables as $table) {
        $cekNoPorsi = $conn->prepare("SELECT COUNT(*) FROM $table WHERE no_porsi = ?");
        $cekNoPorsi->bind_param("s", $no_porsi);
        $cekNoPorsi->execute();
        $cekNoPorsi->bind_result($noPorsiCount);
        $cekNoPorsi->fetch();
        $totalNoPorsi += $noPorsiCount;
        $cekNoPorsi->close();
    }
    if ($totalNoPorsi > 0) {
        echo '<script>alert("No Porsi sudah terdaftar di tahun lain. Silakan gunakan No Porsi yang berbeda."); window.location.href = "../daftar_jamaah.php";</script>';
        $conn->close();
        exit();
    }

    $jenis_kelamin = htmlspecialchars(trim($_POST['jenis_kelamin'] ?? ''));
    $tanggal_lahir = htmlspecialchars(trim($_POST['tanggal_lahir'] ?? ''));
    $alamat = htmlspecialchars(trim($_POST['alamat'] ?? ''));
    $telepon = htmlspecialchars(trim($_POST['telepon'] ?? ''));
    $no_paspor = htmlspecialchars(trim($_POST['no_paspor'] ?? ''));
    $golongan_darah = htmlspecialchars(trim($_POST['golongan_darah'] ?? ''));
    $penyakit_bawaan = htmlspecialchars(trim($_POST['penyakit_bawaan'] ?? ''));
    $jadwal_berangkat = htmlspecialchars(trim($_POST['jadwal_berangkat'] ?? ''));
    if (empty($jadwal_berangkat)) {
        $jadwal_berangkat = null;
    }
    $data_pulang = null;
    if (!empty($jadwal_berangkat)) {
        $date = new DateTime($jadwal_berangkat);
        $date->modify('+40 days');
        $data_pulang = $date->format('Y-m-d');
    }
    $status = htmlspecialchars(trim($_POST['status'] ?? ''));

    $name_file = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Validasi file upload
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB

        $file_type = $_FILES['foto']['type'];
        $file_size = $_FILES['foto']['size'];

        if (!in_array($file_type, $allowed_types)) {
            echo '<script>alert("Tipe file tidak diizinkan. Hanya JPG, PNG, dan GIF yang diperbolehkan."); window.location.href = "../daftar_jamaah.php";</script>';
            exit;
        }

        if ($file_size > $max_size) {
            echo '<script>alert("Ukuran file terlalu besar. Maksimal 2MB."); window.location.href = "../daftar_jamaah.php";</script>';
            exit;
        }

        $original_name = basename($_FILES['foto']['name']);
        $temp_file = $_FILES['foto']['tmp_name'];
        $upload_dir = __DIR__ . "/../../uploads";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Generate unique filename
        $file_extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $name_file = time() . "_" . uniqid() . "." . $file_extension;

        if (!move_uploaded_file($temp_file, $upload_dir . '/' . $name_file)) {
            echo '<script>alert("Gagal upload file."); window.location.href = "../daftar_jamaah.php";</script>';
            exit;
        }
    }

    // Ambil id_pengguna dari session jika ada
    session_start();
    $id_pengguna = isset($_SESSION['id']) ? $_SESSION['id'] : null;

    $stmt = $conn->prepare("INSERT INTO jamaah_haji (
        id_pembimbing, nama_lengkap, nik, no_porsi, jenis_kelamin, tanggal_lahir, alamat, telepon, no_paspor, golongan_darah, penyakit_bawaan, jadwal_berangkat, data_pulang, foto, status, id_pengguna
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssssssssssi",
        $id_pembimbing, $nama_lengkap, $nik, $no_porsi, $jenis_kelamin, $tanggal_lahir, $alamat, $telepon,
        $no_paspor, $golongan_darah, $penyakit_bawaan, $jadwal_berangkat, $data_pulang, $name_file, $status, $id_pengguna
    );
    if ($stmt->execute()) {
        header('Location: ../jamaah/jamaah.php');
        exit;
    } else {
        echo 'Data gagal disimpan: ' . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
