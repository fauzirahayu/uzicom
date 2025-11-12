<?php
include __DIR__ . '/../database.php';

if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $id_pembimbing = $_POST['id_pembimbing'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $no_porsi = $_POST['no_porsi'];

    if (empty($id_pembimbing) || empty($nama_lengkap) || empty($nik)) {
        echo "<script type='text/javascript'>alert('Semua field harus diisi!');window.location.href='../../contern/jamaahHaji/editJamaah.php?id=" . $id . "';</script>";
        exit();
    }

    // Cek jumlah jamaah yang dibimbing pembimbing ini dari semua tabel
    $cekJumlah = $conn->prepare("SELECT COUNT(*) as total FROM (
        SELECT id FROM jamaah_haji WHERE id_pembimbing = ? AND id != ?
        UNION ALL
        SELECT id FROM jamaah_2027 WHERE id_pembimbing = ?
        UNION ALL
        SELECT id FROM jamaah_2028 WHERE id_pembimbing = ?
        UNION ALL
        SELECT id FROM jamaah_2029 WHERE id_pembimbing = ?
    ) as all_jamaah");
    $cekJumlah->bind_param("iiiii", $id_pembimbing, $id, $id_pembimbing, $id_pembimbing, $id_pembimbing);
    $cekJumlah->execute();
    $cekJumlah->bind_result($jumlahJamaah);
    $cekJumlah->fetch();
    $cekJumlah->close();
    if ($jumlahJamaah >= 20) {
        echo '<script>alert("Pembimbing ini sudah membimbing 20 jamaah. Silakan pilih pembimbing lain."); window.location.href = "../../contern/jamaahHaji/editJamaah.php?id=' . $id . '";</script>';
        $conn->close();
        exit();
    } else {
        echo '<script>alert("Jumlah jamaah yang dibimbing pembimbing ini: ' . $jumlahJamaah . '");</script>';
    }



    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $no_paspor = $_POST['no_paspor'];
    $golongan_darah = $_POST['golongan_darah'];
    $penyakit_bawaan = $_POST['penyakit_bawaan'];
    $jadwal_berangkat = $_POST['jadwal_berangkat'];
    $status = $_POST['status'] ?? 'belum lunas'; // Default jika tidak ada
    // Hitung data_pulang otomatis 40 hari setelah jadwal_berangkat
    $data_pulang = null;
    if (!empty($jadwal_berangkat)) {
        $date = new DateTime($jadwal_berangkat);
        $date->modify('+40 days');
        $data_pulang = $date->format('Y-m-d');
    }

    // Handle foto
    $foto_lama = $_POST['foto_lama'];
    $foto_baru = $_FILES['foto']['name'];
    $tmp_foto = $_FILES['foto']['tmp_name'];

    if (!empty($foto_baru)) {
        $upload_dir = "../../uploads";
        $target_file = $upload_dir . '/' . basename($foto_baru);

        // Upload foto baru
        if (move_uploaded_file($tmp_foto, $target_file)) {
            $foto = $foto_baru;
        } else {
            echo "Upload foto gagal.";
            exit;
        }
    } else {
        $foto = $foto_lama; // Gunakan foto lama jika tidak upload baru
    }

    // Jika status belum lunas, ubah no_porsi menjadi "-"
    if ($status === 'belum lunas') {
        $no_porsi = '-';
    }

    // Validasi duplikat no_porsi hanya untuk status 'lunas'
    if ($status === 'lunas') {
        // Periksa apakah No Porsi sama dengan NIK (hanya jika no_porsi tidak "-")
        if ($no_porsi != '-' && $no_porsi == $nik) {
            echo '<script>alert("No Porsi tidak boleh sama dengan NIK. Silakan gunakan No Porsi yang berbeda."); window.location.href = "../../contern/jamaahHaji/editJamaah.php?id=' . $id . '";</script>';
            $conn->close();
            exit();
        }

        // Periksa apakah No Porsi sudah ada di semua tabel jamaah kecuali record ini sendiri (hanya jika no_porsi tidak "-")
        if ($no_porsi != '-') {
            $tables = ['jamaah_haji', 'jamaah_2027', 'jamaah_2028', 'jamaah_2029'];
            $totalNoPorsi = 0;
            foreach ($tables as $table) {
                $cekNoPorsi = $conn->prepare("SELECT COUNT(*) FROM $table WHERE no_porsi = ? AND id != ?");
                $cekNoPorsi->bind_param("si", $no_porsi, $id);
                $cekNoPorsi->execute();
                $cekNoPorsi->bind_result($noPorsiCount);
                $cekNoPorsi->fetch();
                $totalNoPorsi += $noPorsiCount;
                $cekNoPorsi->close();
            }
            if ($totalNoPorsi > 0) {
                echo '<script>alert("No Porsi sudah terdaftar di tahun lain. Silakan gunakan No Porsi yang berbeda."); window.location.href = "../../contern/jamaahHaji/editJamaah.php?id=' . $id . '";</script>';
                $conn->close();
                exit();
            }
        }
    }

    // Query update termasuk foto, data_pulang, dan status
    $sql = "UPDATE jamaah_haji SET
        id_pembimbing='$id_pembimbing',
        nama_lengkap='$nama_lengkap',
        nik='$nik',
        no_porsi='$no_porsi',
        jenis_kelamin='$jenis_kelamin',
        tanggal_lahir='$tanggal_lahir',
        alamat='$alamat',
        telepon='$telepon',
        no_paspor='$no_paspor',
        golongan_darah='$golongan_darah',
        penyakit_bawaan='$penyakit_bawaan',
        jadwal_berangkat='$jadwal_berangkat',
        data_pulang=" . ($data_pulang ? "'$data_pulang'" : "NULL") . ",
        foto='$foto',
        status='$status'
        WHERE id=$id";

    if ($conn->query($sql)) {
        header('Location: ../../contern/jamaahHaji/jamaah.php');
        exit;
    } else {
        echo "Gagal update data: " . $conn->error;
    }
} else {
    header('Location: ../../contern/jamaahHaji/jamaah.php');
    exit;
}
?>
