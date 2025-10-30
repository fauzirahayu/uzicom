<?php
include __DIR__ . "/../database.php";

if (isset($_POST['simpan'])) {
    $id_pembimbing = $_POST['id_pembimbing'] ?? null;
    if ($id_pembimbing) {
        // Cek jumlah jamaah yang dibimbing pembimbing ini
        $cekJumlah = $conn->prepare("SELECT COUNT(*) FROM jamaah_haji WHERE id_pembimbing = ?");
        $cekJumlah->bind_param("i", $id_pembimbing);
        $cekJumlah->execute();
        $cekJumlah->bind_result($jumlahJamaah);
        $cekJumlah->fetch();
        $cekJumlah->close();
        if ($jumlahJamaah >= 20) {
            echo '<script>alert("Pembimbing ini sudah membimbing 20 jamaah. Silakan pilih pembimbing lain."); window.location.href = "../../contern/jamaahHaji/index.php";</script>';
            $conn->close();
            exit();
        }
    }
    // Cek jumlah jamaah haji
    $result = $conn->query("SELECT COUNT(*) as total FROM jamaah_haji");
    $row = $result->fetch_assoc();
    if ($row['total'] >= 50) {
        echo '<script>alert("Jumlah jamaah haji sudah mencapai batas maksimal 50 orang."); window.location.href = "../../contern/jamaahHaji/jamaah.php";</script>';
        exit;
    }
    // Ambil data dari form
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $nik = $_POST['nik'] ?? '';
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
    // Hitung data_pulang otomatis 40 hari setelah jadwal_berangkat
    $data_pulang = null;
    if (!empty($jadwal_berangkat)) {
        $date = new DateTime($jadwal_berangkat);
        $date->modify('+40 days');
        $data_pulang = $date->format('Y-m-d');
    }
    $status = $_POST['status'] ?? '';

    // Upload foto
    $name_file = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $name_file = basename($_FILES['foto']['name']);
        $temp_file = $_FILES['foto']['tmp_name'];
        $upload_dir = __DIR__ . "/../../uploads";
        // Buat folder jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        // Amankan nama file
        $name_file = time() . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "", $name_file);
        // Pindahkan file
        if (!move_uploaded_file($temp_file, $upload_dir . '/' . $name_file)) {
            echo "Gagal upload file.";
            exit;
        }
    }

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO jamaah_haji (
        id_pembimbing, nama_lengkap, nik, jenis_kelamin, tanggal_lahir, alamat, telepon, no_paspor, golongan_darah, penyakit_bawaan, jadwal_berangkat, data_pulang, foto, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssss",
        $id_pembimbing, $nama_lengkap, $nik, $jenis_kelamin, $tanggal_lahir, $alamat, $telepon,
        $no_paspor, $golongan_darah, $penyakit_bawaan, $jadwal_berangkat, $data_pulang, $name_file, $status
    );

    if ($stmt->execute()) {
        header('Location: ../../contern/jamaahHaji/jamaah.php');
        exit;
    } else {
        echo 'Data gagal disimpan: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
