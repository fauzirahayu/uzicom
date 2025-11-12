<?php
include __DIR__ . '/../database.php';

if (isset($_POST['simpan'])) {
    $id_pembimbing = $_POST['id_pembimbing'] ?? null;
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $nik = $_POST['nik'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $no_paspor = $_POST['no_paspor'] ?? '';

    if (empty($id_pembimbing) || empty($nama_lengkap) || empty($nik) || empty($jenis_kelamin) || empty($tanggal_lahir) || empty($alamat) || empty($telepon) || empty($no_paspor)) {
        echo "<script type='text/javascript'>alert('Semua field harus diisi!');window.location.href='../../contern/jamaahHaji/tambahJamaah2028.php';</script>";
        exit();
    }

    // Cek jumlah jamaah yang dibimbing pembimbing ini dari semua tabel
    $cekJumlah = $conn->prepare("SELECT COUNT(*) as total FROM (
        SELECT id FROM jamaah_haji WHERE id_pembimbing = ?
        UNION ALL
        SELECT id FROM jamaah_2027 WHERE id_pembimbing = ?
        UNION ALL
        SELECT id FROM jamaah_2028 WHERE id_pembimbing = ?
        UNION ALL
        SELECT id FROM jamaah_2029 WHERE id_pembimbing = ?
    ) as all_jamaah");
    $cekJumlah->bind_param("iiii", $id_pembimbing, $id_pembimbing, $id_pembimbing, $id_pembimbing);
    $cekJumlah->execute();
    $cekJumlah->bind_result($jumlahJamaah);
    $cekJumlah->fetch();
    $cekJumlah->close();
    if ($jumlahJamaah >= 20) {
        echo '<script>alert("Pembimbing ini sudah membimbing 20 jamaah. Silakan pilih pembimbing lain."); window.location.href = "../../contern/jamaahHaji/tambahJamaah2028.php";</script>';
        $conn->close();
        exit();
    } else {
        echo '<script>alert("Jumlah jamaah yang dibimbing pembimbing ini: ' . $jumlahJamaah . '");</script>';
    }
        // Cek jumlah jamaah haji
    $result = $conn->query("SELECT COUNT(*) as total FROM jamaah_2028");
    $row = $result->fetch_assoc();
    if ($row['total'] >= 30) {
        echo '<script>alert("Jumlah jamaah haji sudah mencapai batas maksimal 50 orang."); window.location.href = "../../contern/jamaahHaji/jamaah2028.php";</script>';
        exit;
    }
    // ...existing code jamaah...
    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $nik = $_POST['nik'] ?? '';
    $no_porsi = $_POST['no_porsi'] ?? '';
    $status = $_POST['status'] ?? 'belum lunas';

    // Jika status belum lunas, ubah no_porsi menjadi "-"
    if ($status === 'belum lunas') {
        $no_porsi = '-';
    }

    // Validasi duplikat no_porsi hanya untuk status 'lunas'
    if ($status === 'lunas') {
        // Periksa apakah No Porsi sama dengan NIK (hanya jika no_porsi tidak "-")
        if ($no_porsi != '-' && $no_porsi == $nik) {
            echo '<script>alert("No Porsi tidak boleh sama dengan NIK. Silakan gunakan No Porsi yang berbeda."); window.location.href = "../../contern/jamaahHaji/tambahJamaah2028.php";</script>';
            $conn->close();
            exit();
        }

        // Periksa apakah No Porsi sudah ada di semua tabel jamaah (hanya jika no_porsi tidak "-")
        if ($no_porsi != '-') {
            $tables = ['jamaah_haji', 'jamaah_2027', 'jamaah_2028', 'jamaah_2029'];
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
                echo '<script>alert("No Porsi sudah terdaftar di tahun lain. Silakan gunakan No Porsi yang berbeda."); window.location.href = "../../contern/jamaahHaji/tambahJamaah2028.php";</script>';
                $conn->close();
                exit();
            }
        }
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
    $stmt = $conn->prepare("INSERT INTO jamaah_2028 (
        id_pembimbing, nama_lengkap, nik, no_porsi, jenis_kelamin, tanggal_lahir, alamat, telepon, no_paspor, golongan_darah, penyakit_bawaan, jadwal_berangkat, data_pulang, foto, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssssssss",
        $id_pembimbing, $nama_lengkap, $nik, $no_porsi, $jenis_kelamin, $tanggal_lahir, $alamat, $telepon,
        $no_paspor, $golongan_darah, $penyakit_bawaan, $jadwal_berangkat, $data_pulang, $name_file, $status
    );
    if ($stmt->execute()) {
        header('Location: ../../contern/jamaahHaji/jamaah2028.php');
        exit;
    } else {
        echo 'Data gagal disimpan: ' . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
