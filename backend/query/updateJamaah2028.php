
<?php
include __DIR__ . '/../database.php';

if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $id_pembimbing = $_POST['id_pembimbing'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $no_porsi = $_POST['no_porsi'];

    // Periksa apakah NIK sudah ada di semua tabel jamaah kecuali record ini sendiri
    $tables = ['jamaah_haji', 'jamaah_2027', 'jamaah_2028', 'jamaah_2029'];
    $totalNIK = 0;
    foreach ($tables as $table) {
        $cekNIK = $conn->prepare("SELECT COUNT(*) FROM $table WHERE nik = ? AND id != ?");
        $cekNIK->bind_param("si", $nik, $id);
        $cekNIK->execute();
        $cekNIK->bind_result($nikCount);
        $cekNIK->fetch();
        $totalNIK += $nikCount;
        $cekNIK->close();
    }
    if ($totalNIK > 0) {
        echo '<script>alert("NIK sudah terdaftar di tahun lain. Silakan gunakan NIK yang berbeda."); window.location.href = "../../contern/jamaahHaji/editJamaah2028.php?id=' . $id . '";</script>';
        $conn->close();
        exit();
    }

    // Periksa apakah No Porsi sama dengan NIK
    if ($no_porsi == $nik) {
        echo '<script>alert("No Porsi tidak boleh sama dengan NIK. Silakan gunakan No Porsi yang berbeda."); window.location.href = "../../contern/jamaahHaji/editJamaah2028.php?id=' . $id . '";</script>';
        $conn->close();
        exit();
    }

    // Periksa apakah No Porsi sudah ada di semua tabel jamaah kecuali record ini sendiri
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
        echo '<script>alert("No Porsi sudah terdaftar di tahun lain. Silakan gunakan No Porsi yang berbeda."); window.location.href = "../../contern/jamaahHaji/editJamaah2028.php?id=' . $id . '";</script>';
        $conn->close();
        exit();
    }

    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $no_paspor = $_POST['no_paspor'];
    $golongan_darah = $_POST['golongan_darah'];
    $penyakit_bawaan = $_POST['penyakit_bawaan'];
    $status = $_POST['status'];
    $jadwal_berangkat = $_POST['jadwal_berangkat'];
    if (empty($jadwal_berangkat)) {
        $jadwal_berangkat_sql = "NULL";
    } else {
        $jadwal_berangkat_sql = "'" . $conn->real_escape_string($jadwal_berangkat) . "'";
    }
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

    // Query update termasuk foto dan data_pulang
    $sql = "UPDATE jamaah_2028 SET
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
        status='$status',
        jadwal_berangkat=$jadwal_berangkat_sql,
        data_pulang=" . ($data_pulang ? "'$data_pulang'" : "NULL") . ",
        foto='$foto'
        WHERE id=$id";

    if ($conn->query($sql)) {
        header('Location: ../../contern/jamaahHaji/jamaah2028.php');
        exit;
    } else {
        echo "Gagal update data: " . $conn->error;
    }
} else {
    header('Location: ../../contern/jamaahHaji/jamaah2028.php');
    exit;
}
?>
