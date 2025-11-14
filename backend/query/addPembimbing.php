<?php
include __DIR__ . '/../database.php';

if (isset($_POST['tambah'])) {
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $nik = $_POST['nik'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $email = $_POST['email'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';

    // Validasi NIK dan Telepon tidak boleh negatif
    if ($nik < 0 || $telepon < 0) {
        echo "<script type='text/javascript'>alert('NIK dan Nomor Telepon tidak boleh negatif!');window.location.href='../../contern/jamaahHaji/tambahPembimbing.php';</script>";
        exit();
    }

    // Validasi NIK tidak boleh sama dengan NIK pembimbing atau jamaah lain di semua tabel
    $tables = ['jamaah_haji', 'jamaah_2027', 'jamaah_2028', 'jamaah_2029', 'pembimbing_haji'];
    $totalNik = 0;
    foreach ($tables as $table) {
        $cekNik = $conn->prepare("SELECT COUNT(*) FROM $table WHERE nik = ?");
        $cekNik->bind_param("s", $nik);
        $cekNik->execute();
        $cekNik->bind_result($nikCount);
        $cekNik->fetch();
        $totalNik += $nikCount;
        $cekNik->close();
    }
    if ($totalNik > 0) {
        echo '<script>alert("NIK sudah terdaftar. Silakan gunakan NIK yang berbeda."); window.location.href = "../../contern/jamaahHaji/tambahPembimbing.php";</script>';
        $conn->close();
        exit();
    }

    // Upload foto
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

    $stmt = $conn->prepare("INSERT INTO pembimbing_haji (
        nama_lengkap, nik, telepon, email, alamat, foto, keterangan
    ) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss",
        $nama_lengkap, $nik, $telepon, $email, $alamat, $name_file, $keterangan
    );

    if ($stmt->execute()) {
        header('Location: ../../contern/jamaahHaji/pembimbing.php');
        exit;
    } else {
        echo 'Data gagal disimpan: ' . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
