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
