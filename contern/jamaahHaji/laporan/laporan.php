<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

// Handle download requests before any HTML output
if (isset($_GET['download'])) {
    $download = $_GET['download'];
    $tahun = (int)$_GET['tahun'];
    if ($tahun == 2026) {
        $table = 'jamaah_haji';
    } else {
        $table = 'jamaah_' . $tahun;
    }
    include '../../../backend/database.php';
    $sql = "SELECT j.*, p.nama_lengkap AS nama_pembimbing FROM $table j LEFT JOIN pembimbing_haji p ON j.id_pembimbing = p.id ORDER BY nama_lengkap";
    $result = $conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $conn->close();

    if ($download == 'pdf') {
        // Generate PDF using Dompdf
        require_once '../../../vendor/autoload.php';
        $dompdf = new Dompdf\Dompdf();
        $html = '<h1>Laporan Jamaah Haji Tahun ' . $tahun . '</h1>';
        $html .= '<table border="1" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>No Porsi</th>
                            <th>Jenis Kelamin</th>
                            <th>Jadwal Berangkat</th>
                            <th>Jadwal Kembali</th>
                            <th>Pembimbing</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($data as $row) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($row['nama_lengkap']) . '</td>
                        <td>' . $row['nik'] . '</td>
                        <td>' . $row['no_porsi'] . '</td>
                        <td>' . $row['jenis_kelamin'] . '</td>
                        <td>' . $row['jadwal_berangkat'] . '</td>
                        <td>' . $row['data_pulang'] . '</td>
                        <td>' . htmlspecialchars($row['nama_pembimbing'] ?? '') . '</td>
                      </tr>';
        }
        $html .= '</tbody></table>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan_jamaah_' . $tahun . '.pdf');
        exit();
    } elseif ($download == 'excel') {
        // Generate XLSX using PhpSpreadsheet
        require_once '../../../vendor/autoload.php';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set title
        $sheet->setCellValue('A1', 'Laporan Jamaah Haji Tahun ' . $tahun);
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set headers
        $headers = ['Nama Lengkap', 'NIK', 'No Porsi', 'Jenis Kelamin', 'Jadwal Berangkat', 'Jadwal Kembali', 'Pembimbing'];
        $sheet->fromArray($headers, NULL, 'A3');

        // Style headers
        $sheet->getStyle('A3:G3')->getFont()->setBold(true);
        $sheet->getStyle('A3:G3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Add data
        $rowIndex = 4;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowIndex, $row['nama_lengkap']);
            $sheet->setCellValue('B' . $rowIndex, $row['nik']);
            $sheet->setCellValue('C' . $rowIndex, $row['no_porsi']);
            $sheet->setCellValue('D' . $rowIndex, $row['jenis_kelamin']);
            $sheet->setCellValue('E' . $rowIndex, $row['jadwal_berangkat']);
            $sheet->setCellValue('F' . $rowIndex, $row['data_pulang']);
            $sheet->setCellValue('G' . $rowIndex, $row['nama_pembimbing'] ?? '');
            $sheet->getStyle('A' . $rowIndex . ':G' . $rowIndex)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $rowIndex++;
        }

        // Auto size columns
        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Output XLSX
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=laporan_jamaah_' . $tahun . '.xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Jamaah Haji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="jamaah.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleTahun() {
            var jenis = document.getElementById('jenis_laporan').value;
            var tahunDiv = document.getElementById('tahun_div');
            if (jenis === 'tahunan') {
                tahunDiv.style.display = 'block';
            } else {
                tahunDiv.style.display = 'none';
            }
        }
    </script>
    <style>
        body {
            background: url('https://images.pexels.com/photos/2291789/pexels-photo-2291789.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            color: #226d3d;
        }

        .header {
            background: rgba(255, 255, 255, 0.15);
            color: #388e3c;
            text-align: center;
            padding: 24px 0 10px 0;
            font-size: 2.5rem;
            margin-bottom: 30px;
            border-radius: 0 0 18px 18px;
            box-shadow: none;
        }

        .report-container {
            margin: 20px 0;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(34, 109, 61, 0.10);
            padding: 20px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid #e0e7c7;
        }
        .report-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #388e3c;
            padding-bottom: 10px;
        }
        .report-header h5 {
            font-weight: bold;
            margin: 0;
            color: #388e3c;
        }
        .report-header h6 {
            font-weight: bold;
            margin: 5px 0;
            color: #226d3d;
        }
        .report-header p {
            margin: 5px 0;
            color: #226d3d;
        }
        .report-footer {
            text-align: right;
            margin-top: 20px;
            border-top: 1px solid #e0e7c7;
            padding-top: 10px;
            color: #226d3d;
        }
        @media print {
            .card, .btn, .header, .actions {
                display: none;
            }
            .report-container {
                border: none;
                padding: 0;
                background: #fff;
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header"><i class="bi bi-bar-chart"></i>Laporan Jamaah Haji</div>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-calendar"></i> Laporan Jamaah Haji</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="mb-3">
                        <label for="jenis_laporan" class="form-label">Jenis Laporan</label>
                        <select class="form-select" id="jenis_laporan" name="jenis_laporan" required onchange="toggleTahun()">
                            <option value="">Pilih Jenis Laporan</option>
                            <option value="tahunan">Laporan Tahunan</option>
                        </select>
                    </div>
                    <div class="mb-3" id="tahun_div" style="display: none;">
                        <label for="tahun" class="form-label">Pilih Tahun</label>
                        <select class="form-select" id="tahun" name="tahun">
                            <option value="">Pilih Tahun</option>
                            <?php for ($y = 2026; $y <= 2029; $y++) { echo '<option value="' . $y . '">' . $y . '</option>'; } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info"><i class="bi bi-search"></i> Lihat Laporan</button>
                </form>
            </div>
        </div>

        <?php
        if (isset($_GET['jenis_laporan'])) {
            $jenis = $_GET['jenis_laporan'];
            include '../../../backend/database.php';

            if ($jenis == 'tahunan' && isset($_GET['tahun'])) {
                $tahun = (int)$_GET['tahun'];
                if ($tahun == 2026) {
                    $table = 'jamaah_haji';
                } else {
                    $table = 'jamaah_' . $tahun;
                }
                $checkTable = $conn->query("SHOW TABLES LIKE '$table'");
                if ($checkTable->num_rows > 0) {
                    $sql = "SELECT j.*, p.nama_lengkap AS nama_pembimbing FROM $table j LEFT JOIN pembimbing_haji p ON j.id_pembimbing = p.id ORDER BY nama_lengkap";
                    $result = $conn->query($sql);
                    $count = $result->num_rows;
                    echo "<h4>Laporan Jamaah Haji Tahun $tahun: $count orang</h4>";
                    if ($count > 0) {
                        echo '<div class="actions mb-3">
                                <button onclick="window.print()" class="btn btn-primary">Cetak Laporan</button>
                                <a href="?jenis_laporan=tahunan&tahun=' . $tahun . '&download=pdf" class="btn btn-danger">Download PDF</a>
                                <a href="?jenis_laporan=tahunan&tahun=' . $tahun . '&download=excel" class="btn btn-success">Download Excel</a>
                              </div>';
                        echo '<div class="report-container">
                                <div class="report-header">
                                    <h5>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h5>
                                    <h6>LAPORAN JAMAAH HAJI TAHUNAN</h6>
                                    <p>Tahun: ' . $tahun . '</p>
                                    <p>Jumlah Jamaah: ' . $count . ' orang</p>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <th>NIK</th>
                                            <th>No Porsi</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jadwal Berangkat</th>
                                            <th>Jadwal Kembali</th>
                                            <th>Pembimbing</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>' . htmlspecialchars($row['nama_lengkap']) . '</td>
                                    <td>' . $row['nik'] . '</td>
                                    <td>' . $row['no_porsi'] . '</td>
                                    <td>' . $row['jenis_kelamin'] . '</td>
                                    <td>' . $row['jadwal_berangkat'] . '</td>
                                    <td>' . $row['data_pulang'] . '</td>
                                    <td>' . htmlspecialchars($row['nama_pembimbing'] ?? '') . '</td>
                                  </tr>';
                        }
                        echo '</tbody></table>
                                <div class="report-footer">
                                    <p>Dicetak pada: ' . date('d/m/Y H:i:s') . '</p>
                                </div>
                            </div>';
                    } else {
                        echo '<p>Tidak ada data jamaah pada tahun tersebut.</p>';
                    }
                } else {
                    echo '<p>Tidak ada data jamaah pada tahun tersebut.</p>';
                }
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
