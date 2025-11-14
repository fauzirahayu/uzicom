<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Jamaah Haji 2028</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-form" id="formCard">
                    <h3 class="form-title"><i class="bi bi-person-plus-fill"></i> Tambah Data Jamaah Haji 2028</h3>
                    <form action="../../backend/query/addJamaahWithpembingbing3.php" method="POST" enctype="multipart/form-data">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="id_pembimbing" class="form-label">Pembimbing</label>
                                <select class="form-select" id="id_pembimbing" name="id_pembimbing">
                                    <option value="" selected disabled>Pilih Pembimbing</option>
                                    <?php
                                    include '../../backend/database.php';
                                    $sqlPembimbing = "SELECT p.id, p.nama_lengkap FROM pembimbing_haji p LEFT JOIN jamaah_2028 j ON p.id = j.id_pembimbing GROUP BY p.id HAVING COUNT(j.id_pembimbing) < 20";
                                    $resultPembimbing = $conn->query($sqlPembimbing);
                                    while ($rowPembimbing = $resultPembimbing->fetch_assoc()) {
                                        echo '<option value="' . $rowPembimbing['id'] . '">' . htmlspecialchars($rowPembimbing['nama_lengkap']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nik" min="0" required>
                            </div>
                            <div class="col-md-6">
                                <label for="no_porsi" class="form-label">No Porsi</label>
                                <input type="text" class="form-control" id="no_porsi" name="no_porsi" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                            <div class="col-md-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="number" class="form-control" id="telepon" name="telepon" required>
                            </div>
                            <div class="col-md-6">
                                <label for="no_paspor" class="form-label">No Paspor</label>
                                <input type="text" class="form-control" id="no_paspor" name="no_paspor">
                            </div>
                            <div class="col-md-6">
                                <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                <input type="text" class="form-control" id="golongan_darah" name="golongan_darah">
                            </div>
                            <div class="col-md-6">
                                <label for="penyakit_bawaan" class="form-label">Penyakit Bawaan</label>
                                <input type="text" class="form-control" id="penyakit_bawaan" name="penyakit_bawaan">
                            </div>
                            <div class="col-md-6">
                                <label for="jadwal_berangkat" class="form-label">Jadwal Berangkat</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <select class="form-select" id="bulan" name="bulan" required>
                                            <option value="" disabled selected>Pilih Bulan</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-select" id="tanggal" name="tanggal" required>
                                            <option value="" disabled selected>Pilih Tanggal</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="jadwal_berangkat" name="jadwal_berangkat">
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum lunas">Belum lunas</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="foto" class="form-label">Foto Jamaah</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                                <img id="preview" class="img-preview" style="display:none;" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary" name="simpan">
                                <i class="bi bi-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('bulan').addEventListener('change', function() {
            const bulan = this.value;
            const tanggalSelect = document.getElementById('tanggal');
            tanggalSelect.innerHTML = '<option value="" disabled selected>Pilih Tanggal</option>';

            if (bulan) {
                const daysInMonth = new Date(2028, bulan, 0).getDate();
                for (let day = 1; day <= daysInMonth; day++) {
                    const option = document.createElement('option');
                    option.value = day.toString().padStart(2, '0');
                    option.textContent = day;
                    tanggalSelect.appendChild(option);
                }
            }
        });

        document.getElementById('tanggal').addEventListener('change', function() {
            const bulan = document.getElementById('bulan').value;
            const tanggal = this.value;
            const jadwalBerangkat = document.getElementById('jadwal_berangkat');

            if (bulan && tanggal) {
                jadwalBerangkat.value = `2028-${bulan}-${tanggal}`;
            }
        });

        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('formCard').classList.add('slide-in');
            }, 100);
        });
    </script>
</body>
</html>
