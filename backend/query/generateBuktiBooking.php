n<?php
require_once '../../vendor/autoload.php';
include '../database.php';

if (!isset($_GET['id']) || !isset($_GET['tahun'])) {
    echo 'ID Jamaah atau Tahun tidak ditemukan.';
    exit;
}

$id = intval($_GET['id']);
$tahun = intval($_GET['tahun']);

if ($tahun == 2026) {
    $table = 'jamaah_haji';
} else {
    $table = 'jamaah_' . $tahun;
}

$sql = "SELECT j.*, p.nama_lengkap AS nama_pembimbing, p.telepon AS telepon_pembimbing, p.foto AS foto_pembimbing
        FROM $table j
        LEFT JOIN pembimbing_haji p ON j.id_pembimbing = p.id
        WHERE j.id = $id";

$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo 'Data Jamaah tidak ditemukan.';
    exit;
}

$row = $result->fetch_assoc();
$conn->close();

// Generate PDF using Dompdf
$dompdf = new Dompdf\Dompdf();
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->set_option('isRemoteEnabled', true);
$dompdf->set_option('defaultFont', 'Arial');

$html = '
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Booking Haji</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 10px; font-size: 12px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header h2 { margin: 3px 0; font-size: 14px; }
        .header p { margin: 3px 0; }
        .content { margin-bottom: 10px; }
        .content table { width: 100%; border-collapse: collapse; font-size: 11px; }
        .content table th, .content table td { border: 1px solid #000; padding: 4px; text-align: left; }
        .content table th { background-color: #f0f0f0; }
        .footer { text-align: right; margin-top: 10px; border-top: 1px solid #000; padding-top: 5px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h1>
        <h2>BUKTI BOOKING HAJI</h2>
        <p>Tahun: ' . $tahun . '</p>
    </div>
    <div class="content">
        <table>
            <tr>
                <th colspan="2">Data Jamaah</th>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>' . htmlspecialchars($row['nama_lengkap']) . '</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>' . htmlspecialchars($row['nik']) . '</td>
            </tr>
            <tr>
                <td>No Porsi</td>
                <td>' . htmlspecialchars($row['no_porsi']) . '</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>' . htmlspecialchars($row['jenis_kelamin']) . '</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>' . htmlspecialchars($row['tanggal_lahir']) . '</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>' . htmlspecialchars($row['alamat']) . '</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>' . htmlspecialchars($row['telepon']) . '</td>
            </tr>
            <tr>
                <td>No Paspor</td>
                <td>' . htmlspecialchars($row['no_paspor']) . '</td>
            </tr>
            <tr>
                <td>Golongan Darah</td>
                <td>' . htmlspecialchars($row['golongan_darah']) . '</td>
            </tr>
            <tr>
                <td>Penyakit Bawaan</td>
                <td>' . htmlspecialchars($row['penyakit_bawaan']) . '</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>' . htmlspecialchars($row['status']) . '</td>
            </tr>
            <tr>
                <th colspan="2">Data Perjalanan</th>
            </tr>
            <tr>
                <td>Jadwal Berangkat</td>
                <td>' . htmlspecialchars($row['jadwal_berangkat']) . '</td>
            </tr>
            <tr>
                <td>Jadwal Kembali</td>
                <td>' . htmlspecialchars($row['data_pulang']) . '</td>
            </tr>
            <tr>
                <th colspan="2">Data Pembimbing</th>
            </tr>
            <tr>
                <td>Nama Pembimbing</td>
                <td>' . htmlspecialchars($row['nama_pembimbing'] ?? 'Tidak ada') . '</td>
            </tr>
            <tr>
                <td>Telepon Pembimbing</td>
                <td>' . htmlspecialchars($row['telepon_pembimbing'] ?? 'Tidak ada') . '</td>
            </tr>
        </table>
        <div style="margin-top: 20px; display: table; width: 100%;">
            <div style="display: table-cell; width: 50%; text-align: center; vertical-align: top;">
                <h3>Foto Jamaah</h3>';
if (!empty($row['foto'])) {
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/uzicom/uploads/' . $row['foto'];
    if (file_exists($imagePath)) {
        $imageData = base64_encode(file_get_contents($imagePath));
        $src = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
        $html .= '<img src="' . $src . '" alt="Foto Jamaah" style="width: 120px; height: 120px; border-radius: 50%; border: 1px solid #000; object-fit: cover;">';
    } else {
        $html .= '<p>Foto tidak ditemukan</p>';
    }
} else {
    $html .= '<p>Tidak ada foto</p>';
}
$html .= '
            </div>
            <div style="display: table-cell; width: 50%; text-align: center; vertical-align: top;">
                <h3>Foto Pembimbing (KBIH)</h3>';
if (!empty($row['foto_pembimbing'])) {
    $imagePathPembimbing = $_SERVER['DOCUMENT_ROOT'] . '/uzicom/uploads/' . $row['foto_pembimbing'];
    if (file_exists($imagePathPembimbing)) {
        $imageDataPembimbing = base64_encode(file_get_contents($imagePathPembimbing));
        $srcPembimbing = 'data:image/' . pathinfo($imagePathPembimbing, PATHINFO_EXTENSION) . ';base64,' . $imageDataPembimbing;
        $html .= '<img src="' . $srcPembimbing . '" alt="Foto Pembimbing" style="width: 120px; height: 120px; border-radius: 50%; border: 1px solid #000; object-fit: cover;">';
    } else {
        $html .= '<p>Foto tidak ditemukan</p>';
    }
} else {
    $html .= '<p>Tidak ada foto</p>';
}
$html .= '
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Dicetak pada: ' . date('d/m/Y H:i:s') . '</p>
        <p>Sistem Manajemen Jamaah Haji</p>
    </div>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output PDF
$filename = 'bukti_booking_haji_' . $row['nama_lengkap'] . '_' . $tahun . '.pdf';
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '"');
echo $dompdf->output();
exit;
?>
