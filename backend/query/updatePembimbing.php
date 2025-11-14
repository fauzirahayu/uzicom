<?php
include __DIR__ . '/../database.php';

if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $nik = $_POST['nik'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $email = $_POST['email'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';

    // Validasi NIK dan Telepon tidak boleh negatif
    if ($nik < 0 || $telepon < 0) {
        echo "<script type='text/javascript'>alert('NIK dan Nomor Telepon tidak boleh negatif!');window.location.href='../../contern/jamaahHaji/editPembimbing.php?id=$id';</script>";
        exit();
    }

    // Validasi NIK tidak boleh sama dengan NIK pembimbing atau jamaah lain di semua tabel, kecuali NIK sendiri
    $tables = ['jamaah_haji', 'jamaah_2027', 'jamaah_2028', 'jamaah_2029', 'pembimbing_haji'];
    $totalNik = 0;
    foreach ($tables as $table) {
        $cekNik = $conn->prepare("SELECT COUNT(*) FROM $table WHERE nik = ? AND id != ?");
        $cekNik->bind_param("si", $nik, $id);
        $cekNik->execute();
        $cekNik->bind_result($nikCount);
        $cekNik->fetch();
        $totalNik += $nikCount;
        $cekNik->close();
    }
    if ($totalNik > 0) {
        echo '<script>alert("NIK sudah terdaftar. Silakan gunakan NIK yang berbeda."); window.location.href = "../../contern/jamaahHaji/editPembimbing.php?id=$id";</script>';
        $conn->close();
        exit();
    }

    // Handle foto update
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = basename($_FILES['foto']['name']);
        $temp_file = $_FILES['foto']['tmp_name'];
        $upload_dir = __DIR__ . "/../../uploads";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $foto = time() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "", $foto);
        if (!move_uploaded_file($temp_file, $upload_dir . '/' . $foto)) {
            echo "Gagal upload file.";
            exit;
        }
    }

    if ($foto) {
        $sql = "UPDATE pembimbing_haji SET nama_lengkap=?, nik=?, telepon=?, email=?, alamat=?, foto=?, keterangan=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $nama_lengkap, $nik, $telepon, $email, $alamat, $foto, $keterangan, $id);
    } else {
        $sql = "UPDATE pembimbing_haji SET nama_lengkap=?, nik=?, telepon=?, email=?, alamat=?, keterangan=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nama_lengkap, $nik, $telepon, $email, $alamat, $keterangan, $id);
    }

    if ($stmt->execute()) {
        header('Location: ../../contern/jamaahHaji/pembimbing.php');
        exit;
    } else {
        echo 'Data gagal diupdate: ' . $stmt->error;
    }
}
?>
